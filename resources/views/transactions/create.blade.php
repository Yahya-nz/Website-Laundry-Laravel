@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('transactions.index') }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium mb-4 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Riwayat Transaksi
            </a>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Buat Transaksi Baru</h1>
            <p class="text-gray-600">Lakukan pembayaran atau transfer saldo ke pengguna lain</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Form Transaksi</h2>
                <p class="text-blue-100 mt-1">Isi formulir di bawah ini dengan lengkap</p>
            </div>

            <!-- Card Body -->
            <form action="{{ route('transactions.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Alert Info -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-blue-800">Saldo Wallet Anda</p>
                            <p class="text-2xl font-bold text-blue-600 mt-1">
                                Rp {{ number_format(Auth::user()->wallet->balance ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tipe Transaksi -->
                <div>
                    <label for="type" class="block text-sm font-bold text-gray-700 mb-2">
                        Tipe Transaksi <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="type"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="payment">💳 Pembayaran</option>
                        <option value="transfer">💸 Transfer ke Pengguna Lain</option>
                    </select>
                    <p class="mt-2 text-sm text-gray-500">Pilih jenis transaksi yang akan dilakukan</p>
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="amount" class="block text-sm font-bold text-gray-700 mb-2">
                        Jumlah <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-semibold">Rp</span>
                        </div>
                        <input type="number"
                               name="amount"
                               id="amount"
                               min="1000"
                               step="1000"
                               class="w-full pl-14 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                               placeholder="50000"
                               required>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Minimum Rp 1.000</p>
                </div>

                <!-- Target Email (conditional) -->
                <div id="transferFields" style="display: none;">
                    <label for="target_email" class="block text-sm font-bold text-gray-700 mb-2">
                        Email Penerima <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input type="email"
                               name="target_email"
                               id="target_email"
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                               placeholder="user@example.com">
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Masukkan email pengguna yang akan menerima transfer</p>
                </div>

                <!-- Catatan -->
                <div>
                    <label for="notes" class="block text-sm font-bold text-gray-700 mb-2">
                        Catatan (Opsional)
                    </label>
                    <textarea name="notes"
                              id="notes"
                              rows="4"
                              class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                              placeholder="Tambahkan catatan atau keterangan transaksi..."></textarea>
                    <p class="mt-2 text-sm text-gray-500">Contoh: Pembayaran untuk order #INV-123</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-red-800">Terjadi kesalahan:</p>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-200">
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Proses Transaksi
                    </button>
                    <a href="{{ route('transactions.index') }}"
                       class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- Info Payment -->
            <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-green-500">
                <div class="flex items-center mb-3">
                    <div class="bg-green-100 rounded-lg p-2 mr-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Pembayaran</h3>
                </div>
                <p class="text-sm text-gray-600">Gunakan untuk membayar invoice atau order laundry Anda</p>
            </div>

            <!-- Info Transfer -->
            <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-blue-500">
                <div class="flex items-center mb-3">
                    <div class="bg-blue-100 rounded-lg p-2 mr-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Transfer</h3>
                </div>
                <p class="text-sm text-gray-600">Kirim saldo wallet ke pengguna lain menggunakan email mereka</p>
            </div>
        </div>

    </div>
</div>

<script>
// Show/hide transfer fields based on transaction type
document.getElementById('type').addEventListener('change', function() {
    const transferFields = document.getElementById('transferFields');
    const targetEmail = document.getElementById('target_email');

    if (this.value === 'transfer') {
        transferFields.style.display = 'block';
        targetEmail.required = true;
    } else {
        transferFields.style.display = 'none';
        targetEmail.required = false;
    }
});
</script>
@endsection