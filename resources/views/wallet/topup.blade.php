@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('wallet.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Top Up Wallet</h1>
            <p class="text-gray-600">Isi saldo wallet Anda untuk transaksi lebih mudah</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('wallet.topup') }}" method="POST">
                @csrf

                <div class="space-y-6">

                    <!-- Jumlah Top Up -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Jumlah Top Up <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <span class="text-gray-500 font-medium">Rp</span>
                            </div>
                            <input type="number" name="amount" required min="1000" step="1000"
                                class="w-full pl-12 pr-4 py-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-lg font-semibold"
                                placeholder="10000">
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Minimal top up Rp 1.000</p>
                    </div>

                    <!-- Quick Amount Buttons -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            Pilih Nominal Cepat
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 10000"
                                class="px-4 py-3 bg-green-50 hover:bg-green-100 text-green-700 font-semibold rounded-lg border-2 border-green-200 hover:border-green-400 transition-all">
                                Rp 10.000
                            </button>
                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 50000"
                                class="px-4 py-3 bg-green-50 hover:bg-green-100 text-green-700 font-semibold rounded-lg border-2 border-green-200 hover:border-green-400 transition-all">
                                Rp 50.000
                            </button>
                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 100000"
                                class="px-4 py-3 bg-green-50 hover:bg-green-100 text-green-700 font-semibold rounded-lg border-2 border-green-200 hover:border-green-400 transition-all">
                                Rp 100.000
                            </button>
                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 200000"
                                class="px-4 py-3 bg-green-50 hover:bg-green-100 text-green-700 font-semibold rounded-lg border-2 border-green-200 hover:border-green-400 transition-all">
                                Rp 200.000
                            </button>
                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 500000"
                                class="px-4 py-3 bg-green-50 hover:bg-green-100 text-green-700 font-semibold rounded-lg border-2 border-green-200 hover:border-green-400 transition-all">
                                Rp 500.000
                            </button>
                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 1000000"
                                class="px-4 py-3 bg-green-50 hover:bg-green-100 text-green-700 font-semibold rounded-lg border-2 border-green-200 hover:border-green-400 transition-all">
                                Rp 1.000.000
                            </button>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea name="notes" rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                            placeholder="Tambahkan catatan untuk top up ini..."></textarea>
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t-2 border-gray-200">
                    <a href="{{ route('wallet.index') }}"
                        class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Kirim Top-up
                    </button>
                </div>

            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="text-sm text-blue-700">
                    <p class="font-semibold mb-1">Informasi:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Minimal top up adalah Rp 1.000</li>
                        <li>Saldo akan masuk ke wallet secara otomatis</li>
                        <li>Anda dapat menggunakan saldo untuk transaksi</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
