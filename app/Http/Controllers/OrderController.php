<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tampilkan semua data order
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Halaman form tambah order
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Simpan data order baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'layanan'        => 'required|string|max:255',
            'berat'          => 'nullable|numeric|min:0',
            'total_harga'    => 'required|numeric|min:0',
            'status'         => 'required|string',
            'process_status' => 'required|string'
        ]);

        Order::create($data);

        return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat!');
    }

    /**
     * Halaman edit order
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Update data order
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $data = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'layanan'        => 'required|string|max:255',
            'berat'          => 'nullable|numeric|min:0',
            'total_harga'    => 'required|numeric|min:0',
            'status'         => 'required|string',
            'process_status' => 'required|string'
        ]);

        $order->update($data);

        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui!');
    }

    /**
     * Hapus data order
     */
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus!');
    }

    /**
     * Tracking status cucian
     */
    public function tracking($id)
    {
        $order = Order::findOrFail($id);

        $progress = match ($order->process_status) {
            'penerimaan'  => 20,
            'pencucian'   => 40,
            'pengeringan' => 60,
            'setrika'     => 80,
            'selesai'     => 100,
            default       => 0,
        };

        return view('orders.tracking', compact('order', 'progress'));
    }

    /**
     * Notifikasi cucian selesai
     */
    public function notifyDone($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'notified_done' => true
        ]);

        return back()->with('success', 'Notifikasi selesai cucian berhasil dikirim!');
    }

    /**
     * Notifikasi estimasi pengambilan
     */
    public function notifyPickup($id)
    {
        $order = Order::findOrFail($id);

        $estimate = now()->addHours(6);

        $order->update([
            'pickup_estimation' => $estimate,
            'notified_pickup'   => true
        ]);

        return back()->with('success', 'Estimasi pengambilan berhasil dikirim!');
    }
}
