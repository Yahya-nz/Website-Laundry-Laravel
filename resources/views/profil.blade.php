@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-4">
                Profil Usaha Laundry Ukhuwah
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Jasa laundry terpercaya yang berkomitmen memberikan pelayanan terbaik untuk menjaga kebersihan dan kenyamanan pakaian Anda.
            </p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

            <!-- Visi Card -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-transform duration-200 border-t-4 border-blue-500">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 rounded-lg p-3 mr-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Visi</h2>
                </div>
                <p class="text-gray-700 leading-relaxed text-lg">
                    Menjadi layanan laundry terbaik dengan pelayanan cepat, bersih, dan profesional.
                </p>
            </div>

            <!-- Misi Card -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-transform duration-200 border-t-4 border-indigo-500">
                <div class="flex items-center mb-4">
                    <div class="bg-indigo-100 rounded-lg p-3 mr-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Misi</h2>
                </div>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 text-lg">Memberikan layanan laundry berkualitas tinggi</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 text-lg">Menjaga kebersihan dan kerapian pakaian pelanggan</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 text-lg">Memberikan harga terjangkau untuk semua kalangan</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 text-lg">Pelayanan cepat dan tepat waktu</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Contact Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

            <!-- Phone Contact Card -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-8 text-white transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center mb-4">
                    <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold">Hubungi Kami</h3>
                </div>
                <p class="text-white text-opacity-90 mb-3 text-lg">WhatsApp</p>
                <a href="https://wa.me/6285328901924" target="_blank" class="text-3xl font-bold hover:text-green-100 transition-colors block">
                    +62 853-2890-1924
                </a>
                <p class="text-sm text-green-100 mt-2">Klik untuk chat langsung</p>
            </div>

            <!-- Location Card -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-8 text-white transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center mb-4">
                    <div class="bg-white bg-opacity-20 rounded-lg p-3 mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold">Lokasi Kami</h3>
                </div>
                <p class="text-white text-opacity-90 mb-3 text-lg">Alamat</p>
                <p class="text-xl font-semibold">
                    Jl. Mawar No.12, Tegal
                </p>
            </div>

        </div>

        <!-- CTA Button -->
        <div class="text-center mt-12">
            <a href="{{ route('home') }}"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-lg font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Halaman Depan
            </a>
        </div>

    </div>
</div>
@endsection