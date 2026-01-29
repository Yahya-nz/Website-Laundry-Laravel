@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Invoice</h1>
            <p class="mt-2 text-sm text-gray-600">Invoice #{{ $invoice->invoice_number ?? $invoice->id }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-500 to-orange-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Form Edit Invoice</h2>
            </div>

            <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PATCH')

                <!-- Customer Name -->
                <div>
                    <label for="customer_name" class="block text-sm font-bold text-gray-700 mb-2">Nama Customer</label>
                    <input type="text" name="customer_name" id="customer_name" required
                           value="{{ old('customer_name', $invoice->customer_name) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                           placeholder="Masukkan nama customer">
                    @error('customer_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Customer WhatsApp -->
                <div>
                    <label for="customer_whatsapp" class="block text-sm font-bold text-gray-700 mb-2">WhatsApp Customer</label>
                    <input type="text" name="customer_whatsapp" id="customer_whatsapp"
                           value="{{ old('customer_whatsapp', $invoice->customer_whatsapp) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                           placeholder="628123456789">
                    @error('customer_whatsapp')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subtotal -->
                <div>
                    <label for="subtotal" class="block text-sm font-bold text-gray-700 mb-2">Subtotal</label>
                    <input type="number" name="subtotal" id="subtotal" required min="0" step="0.01"
                           value="{{ old('subtotal', $invoice->subtotal) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                           placeholder="0">
                    @error('subtotal')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Discount -->
                <div>
                    <label for="discount" class="block text-sm font-bold text-gray-700 mb-2">Diskon (Opsional)</label>
                    <input type="number" name="discount" id="discount" min="0" step="0.01"
                           value="{{ old('discount', $invoice->discount) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                           placeholder="0">
                    @error('discount')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tax -->
                <div>
                    <label for="tax" class="block text-sm font-bold text-gray-700 mb-2">Pajak (Opsional)</label>
                    <input type="number" name="tax" id="tax" min="0" step="0.01"
                           value="{{ old('tax', $invoice->tax) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                           placeholder="0">
                    @error('tax')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        <option value="pending" {{ old('status', $invoice->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ old('status', $invoice->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="cancelled" {{ old('status', $invoice->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-bold text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="notes" id="notes" rows="4"
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                              placeholder="Tambahkan catatan untuk invoice...">{{ old('notes', $invoice->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('invoices.show', $invoice) }}"
                       class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Batal
                    </a>
                    <div class="flex space-x-3">
                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus invoice ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-red-500 text-white rounded-xl font-bold hover:bg-red-600 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                        </form>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-xl font-bold hover:from-yellow-600 hover:to-orange-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Invoice
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
