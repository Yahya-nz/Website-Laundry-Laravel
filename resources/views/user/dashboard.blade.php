@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="mt-2 text-sm text-gray-600">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>

        <!-- User Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Wallet Balance Card -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Saldo Wallet</p>
                        <h3 class="text-3xl font-bold mt-2">Rp {{ number_format(Auth::user()->wallet->balance ?? 0, 0, ',', '.') }}</h3>
                        <p class="text-green-100 text-xs mt-2">Tersedia</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Transactions Card -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Transaksi</p>
                        <h3 class="text-3xl font-bold mt-2">{{ Auth::user()->transactions ? Auth::user()->transactions->count() : 0 }}</h3>
                        <p class="text-blue-100 text-xs mt-2">Riwayat transaksi</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Transactions -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">Transaksi Terbaru</h2>
                        <a href="{{ route('transactions.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua →</a>
                    </div>
                </div>
                <div class="p-6">
                    @forelse(Auth::user()->transactions()->latest()->take(5)->get() as $transaction)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg mb-3 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <h3 class="font-semibold text-gray-800">{{ ucfirst($transaction->type) }}</h3>
                                <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full
                                    @if($transaction->type == 'credit') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $transaction->type == 'credit' ? 'Masuk' : 'Keluar' }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                            @if($transaction->description)
                            <p class="text-xs text-gray-500 mt-1">{{ $transaction->description }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold {{ $transaction->type == 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type == 'credit' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="mt-4 text-gray-500">Belum ada transaksi</p>
                        <a href="{{ route('wallet.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Kelola Wallet
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions & Info -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Menu Cepat</h2>
                    <div class="space-y-3">
                        <a href="{{ route('wallet.index') }}" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200 group">
                            <div class="bg-green-500 rounded-lg p-2 mr-3 group-hover:bg-green-600 transition-colors duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Kelola Wallet</span>
                        </a>

                        <a href="{{ route('transactions.index') }}" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200 group">
                            <div class="bg-purple-500 rounded-lg p-2 mr-3 group-hover:bg-purple-600 transition-colors duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Riwayat Transaksi</span>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200 group">
                            <div class="bg-blue-500 rounded-lg p-2 mr-3 group-hover:bg-blue-600 transition-colors duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Edit Profil</span>
                        </a>
                    </div>
                </div>

                <!-- Promo Card -->
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-2">🎉 Promo Spesial!</h3>
                    <p class="text-sm text-orange-100 mb-4">Diskon 20% untuk cuci kiloan minimal 5kg</p>
                    <a href="{{ route('harga') }}" class="inline-flex items-center px-4 py-2 bg-white text-orange-600 rounded-lg font-semibold text-sm hover:bg-orange-50 transition-colors duration-200">
                        Lihat Harga
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Info Card -->
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-sm font-medium text-indigo-100 mb-3">Jam Operasional</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Senin - Jumat</span>
                            <span class="font-semibold">08:00 - 20:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sabtu - Minggu</span>
                            <span class="font-semibold">09:00 - 18:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
