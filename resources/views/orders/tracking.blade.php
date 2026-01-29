@extends('layouts.app')

@section('content')
<!-- Hero Header -->
<div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-16 mb-8">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Tracking Status Cucian</h1>
        <p class="text-xl text-blue-100">Pantau progres cucian Anda secara real-time</p>
    </div>

    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
        </svg>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">

    <!-- Status Alerts -->
    @if($order->notified_done)
    <div class="mb-6 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform duration-200">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold mb-1">Cucian Anda Sudah Selesai!</h3>
                <p class="text-green-100">Silakan ambil kapan saja. Terima kasih telah menggunakan layanan kami.</p>
            </div>
        </div>
    </div>
    @endif

    @if($order->pickup_estimation)
    <div class="mb-6 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-xl font-bold mb-1">Estimasi Waktu Pengambilan</h3>
                <p class="text-2xl font-bold text-blue-100">{{ \Carbon\Carbon::parse($order->pickup_estimation)->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Order Details Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-6">
            <h2 class="text-2xl font-bold text-white">Detail Pesanan</h2>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Nama Pelanggan</p>
                            <p class="text-xl font-bold text-gray-900">{{ $order->nama_pelanggan }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Jenis Layanan</p>
                            <p class="text-xl font-bold text-gray-900">{{ $order->layanan }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Berat</p>
                            <p class="text-xl font-bold text-gray-900">{{ $order->berat }} Kg</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Status Proses</p>
                            <p class="text-xl font-bold text-gray-900">{{ ucfirst($order->process_status) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Section -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
            <h2 class="text-2xl font-bold text-white">Progress Pengerjaan</h2>
        </div>

        <div class="p-8">
            @php
            $width = ($progress ?? 0) . '%';
            @endphp

            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm font-semibold text-gray-600">Progress</span>
                    <span class="text-2xl font-bold text-blue-600">{{ $progress ?? 0 }}%</span>
                </div>
                <div class="relative">
                    <div class="overflow-hidden h-8 text-xs flex rounded-full bg-gray-200 shadow-inner">
                        <div role="progressbar"
                            aria-valuenow="{{ $progress ?? 0 }}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            style="width: {{ $width }}; background: linear-gradient(90deg, #06b6d4, #3b82f6, #8b5cf6);"
                            class="shadow-md flex flex-col text-center whitespace-nowrap text-white justify-center transition-all duration-500 ease-out">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Process Steps -->
            <div class="grid grid-cols-5 gap-4">
                @php
                $steps = [
                    ['name' => 'Penerimaan', 'status' => 'penerimaan', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ['name' => 'Pencucian', 'status' => 'pencucian', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
                    ['name' => 'Pengeringan', 'status' => 'pengeringan', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['name' => 'Setrika', 'status' => 'setrika', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['name' => 'Selesai', 'status' => 'selesai', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
                ];
                @endphp

                @foreach($steps as $step)
                <div class="text-center">
                    <div class="mb-3 flex justify-center">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center transition-all duration-300
                            {{ $order->process_status == $step['status'] ? 'bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg scale-110' : 'bg-gray-200' }}">
                            <svg class="w-8 h-8 {{ $order->process_status == $step['status'] ? 'text-white' : 'text-gray-400' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm font-semibold {{ $order->process_status == $step['status'] ? 'text-blue-600' : 'text-gray-500' }}">
                        {{ $step['name'] }}
                    </p>
                    @if($order->process_status == $step['status'])
                    <div class="mt-2">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full">
                            Sedang Proses
                        </span>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('home') }}"
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Beranda
        </a>
    </div>

</div>
@endsection