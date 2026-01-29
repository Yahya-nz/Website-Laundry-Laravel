<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Customer;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function index()
    {
        $invoices = Invoice::with(['order', 'customer'])->latest()->paginate(20);
        return view('invoices.index', compact('invoices'));
    }

    public function create($orderId = null)
    {
        $order = $orderId ? Order::findOrFail($orderId) : null;
        $customers = Customer::all();
        return view('invoices.create', compact('order', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'customer_id' => 'nullable|exists:customers,id',
            'customer_name' => 'required|string',
            'customer_whatsapp' => 'nullable|string',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $validated['discount'] = $validated['discount'] ?? 0;
        $validated['tax'] = $validated['tax'] ?? 0;
        $validated['total'] = $validated['subtotal'] - $validated['discount'] + $validated['tax'];

        $invoice = Invoice::create($validated);

        if ($request->has('send_whatsapp') && $request->send_whatsapp && $validated['customer_whatsapp']) {
            $this->whatsappService->sendInvoice($invoice);
        }

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Invoice berhasil dibuat!');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['order', 'customer']);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();
        $order = $invoice->order;
        return view('invoices.edit', compact('invoice', 'customers', 'order'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_whatsapp' => 'nullable|string',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $validated['discount'] = $validated['discount'] ?? 0;
        $validated['tax'] = $validated['tax'] ?? 0;
        $validated['total'] = $validated['subtotal'] - $validated['discount'] + $validated['tax'];

        if ($validated['status'] === 'paid' && $invoice->status !== 'paid') {
            $validated['paid_at'] = now();
        }

        $invoice->update($validated);

        return redirect()->route('invoices.show', $invoice)
            ->with('success', 'Invoice berhasil diupdate!');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice berhasil dihapus!');
    }

    public function sendWhatsApp(Invoice $invoice)
    {
        try {
            $this->whatsappService->sendInvoice($invoice);
            return back()->with('success', 'Invoice berhasil dikirim via WhatsApp!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim invoice: ' . $e->getMessage());
        }
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load(['order', 'customer']);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }
}
