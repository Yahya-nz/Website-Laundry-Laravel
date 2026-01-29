@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Buat Invoice Baru</h1>
            <p class="mt-2 text-sm text-gray-600">Isi form di bawah untuk membuat invoice</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Form Invoice</h2>
            </div>

            <form action="{{ route('invoices.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Order Selection -->
                <div>
                    <label for="order_id" class="block text-sm font-bold text-gray-700 mb-2">Pesanan</label>
                    <select name="order_id" id="order_id" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach(\App\Models\Order::whereDoesntHave('invoice')->get() as $order)
                            <option value="{{ $order->id }}" {{ old('order_id', $order->id ?? '') == $order->id ? 'selected' : '' }}>
                                Order #{{ $order->id }} - {{ $order->nama_pelanggan }} - {{ $order->layanan }} (Rp {{ number_format($order->total_harga, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('order_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Customer Name -->
                <div>
                    <label for="customer_name" class="block text-sm font-bold text-gray-700 mb-2">Nama Customer</label>
                    <input type="text" name="customer_name" id="customer_name" required
                           value="{{ old('customer_name') }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan nama customer">
                    @error('customer_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Customer WhatsApp -->
                <div>
                    <label for="customer_whatsapp" class="block text-sm font-bold text-gray-700 mb-2">WhatsApp Customer</label>
                    <input type="text" name="customer_whatsapp" id="customer_whatsapp"
                           value="{{ old('customer_whatsapp') }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="628123456789">
                    @error('customer_whatsapp')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subtotal -->
                <div>
                    <label for="subtotal" class="block text-sm font-bold text-gray-700 mb-2">Subtotal</label>
                    <input type="number" name="subtotal" id="subtotal" required min="0" step="0.01"
                           value="{{ old('subtotal') }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="0">
                    @error('subtotal')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Discount -->
                <div>
                    <label for="discount" class="block text-sm font-bold text-gray-700 mb-2">Diskon (Opsional)</label>
                    <input type="number" name="discount" id="discount" min="0" step="0.01"
                           value="{{ old('discount', 0) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="0">
                    @error('discount')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tax -->
                <div>
                    <label for="tax" class="block text-sm font-bold text-gray-700 mb-2">Pajak (Opsional)</label>
                    <input type="number" name="tax" id="tax" min="0" step="0.01"
                           value="{{ old('tax', 0) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="0">
                    @error('tax')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-bold text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="notes" id="notes" rows="4"
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Tambahkan catatan untuk invoice...">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Send WhatsApp -->
                <div class="flex items-center">
                    <input type="checkbox" name="send_whatsapp" id="send_whatsapp" value="1"
                           class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500 border-gray-300">
                    <label for="send_whatsapp" class="ml-3 text-sm font-medium text-gray-700">
                        Kirim invoice via WhatsApp setelah dibuat
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('invoices.index') }}"
                       class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Invoice
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
