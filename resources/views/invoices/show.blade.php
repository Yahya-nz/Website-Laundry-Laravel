@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Actions -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Invoice Detail</h1>
                <p class="mt-2 text-sm text-gray-600">Invoice #{{ $invoice->invoice_number ?? $invoice->id }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('invoices.edit', $invoice) }}"
                   class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('invoices.downloadPdf', $invoice) }}"
                   class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download PDF
                </a>
            </div>
        </div>

        <!-- Invoice Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-8 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">INVOICE</h2>
                        <p class="text-blue-100">Laundry Ukhuwah</p>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-blue-100">Invoice #</div>
                        <div class="text-2xl font-bold">{{ $invoice->invoice_number ?? $invoice->id }}</div>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <!-- Customer & Invoice Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-sm font-bold text-gray-500 uppercase mb-3">Kepada:</h3>
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6">
                            <p class="text-xl font-bold text-gray-900">{{ $invoice->customer_name }}</p>
                            @if($invoice->customer_whatsapp)
                            <p class="text-sm text-gray-600 mt-2">WhatsApp: {{ $invoice->customer_whatsapp }}</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-gray-500 uppercase mb-3">Detail Invoice:</h3>
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Tanggal:</span>
                                <span class="font-semibold text-gray-900">{{ $invoice->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Status:</span>
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($invoice->status == 'paid') bg-green-100 text-green-800
                                    @elseif($invoice->status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </div>
                            @if($invoice->paid_at)
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Dibayar:</span>
                                <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($invoice->paid_at)->format('d M Y') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Info -->
                @if($invoice->order)
                <div class="mb-8">
                    <h3 class="text-sm font-bold text-gray-500 uppercase mb-3">Detail Pesanan:</h3>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Layanan</p>
                                <p class="font-bold text-gray-900">{{ $invoice->order->layanan }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Berat</p>
                                <p class="font-bold text-gray-900">{{ $invoice->order->berat }} Kg</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status</p>
                                <p class="font-bold text-gray-900">{{ ucfirst($invoice->order->status) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Pricing -->
                <div class="border-t-2 border-gray-200 pt-6 mb-6">
                    <h3 class="text-sm font-bold text-gray-500 uppercase mb-4">Rincian Biaya:</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700">Subtotal</span>
                            <span class="text-lg font-semibold text-gray-900">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @if($invoice->discount > 0)
                        <div class="flex justify-between items-center text-red-600">
                            <span>Diskon</span>
                            <span class="text-lg font-semibold">- Rp {{ number_format($invoice->discount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        @if($invoice->tax > 0)
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700">Pajak</span>
                            <span class="text-lg font-semibold text-gray-900">Rp {{ number_format($invoice->tax, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Total -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl p-6">
                    <div class="flex justify-between items-center text-white">
                        <span class="text-xl font-bold">TOTAL</span>
                        <span class="text-3xl font-bold">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Notes -->
                @if($invoice->notes)
                <div class="mt-8 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg p-6">
                    <h3 class="text-sm font-bold text-gray-700 mb-2">Catatan:</h3>
                    <p class="text-gray-700">{{ $invoice->notes }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('invoices.index') }}"
               class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Invoice
            </a>
        </div>
    </div>
</div>
@endsection
