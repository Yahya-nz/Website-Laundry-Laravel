@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-4">
                Layanan Kami
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Berbagai pilihan layanan laundry profesional untuk kebutuhan Anda
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Cuci Kering -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-all duration-200 border-t-4 border-blue-500">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Cuci Kering</h3>
                <p class="text-gray-600 leading-relaxed">
                    Layanan cuci kering profesional untuk pakaian Anda dengan hasil bersih dan wangi.
                </p>
            </div>

            <!-- Cuci Setrika -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-all duration-200 border-t-4 border-cyan-500">
                <div class="bg-cyan-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Cuci Setrika</h3>
                <p class="text-gray-600 leading-relaxed">
                    Paket lengkap cuci dan setrika untuk hasil pakaian yang bersih, rapi, dan siap pakai.
                </p>
            </div>

            <!-- Setrika Saja -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-all duration-200 border-t-4 border-green-500">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Setrika Saja</h3>
                <p class="text-gray-600 leading-relaxed">
                    Khusus layanan setrika untuk pakaian yang sudah bersih namun perlu dirapikan.
                </p>
            </div>

            <!-- Laundry Kilat (Express) -->
            <div class="bg-gradient-to-br from-red-500 to-orange-500 rounded-xl shadow-lg p-8 transform hover:scale-105 transition-all duration-200 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-yellow-400 text-red-600 px-3 py-1 text-xs font-bold rounded-bl-lg">
                    POPULER
                </div>
                <div class="bg-white bg-opacity-20 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3">Laundry Kilat (Express)</h3>
                <p class="text-white text-opacity-90 leading-relaxed">
                    Layanan express dengan pengerjaan cepat untuk kebutuhan mendadak. Selesai dalam 3-6 jam!
                </p>
            </div>

            <!-- Laundry Sepatu -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-all duration-200 border-t-4 border-purple-500">
                <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Laundry Sepatu</h3>
                <p class="text-gray-600 leading-relaxed">
                    Perawatan khusus untuk sepatu Anda. Cuci bersih dan treatment khusus untuk berbagai jenis sepatu.
                </p>
            </div>

            <!-- Laundry Karpet -->
            <div class="bg-white rounded-xl shadow-lg p-8 transform hover:scale-105 transition-all duration-200 border-t-4 border-indigo-500">
                <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Laundry Karpet</h3>
                <p class="text-gray-600 leading-relaxed">
                    Cuci karpet dengan teknologi deep cleaning untuk hasil maksimal dan higienis.
                </p>
            </div>

        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl p-12 text-white">
            <h2 class="text-3xl font-bold mb-4">Siap Mencoba Layanan Kami?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Hubungi kami sekarang untuk mendapatkan layanan laundry terbaik dengan harga terjangkau
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/6281234567890" target="_blank"
                    class="inline-flex items-center justify-center px-8 py-4 bg-green-500 hover:bg-green-600 text-white text-lg font-semibold rounded-xl transform hover:scale-105 transition-all duration-200 shadow-lg">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Hubungi via WhatsApp
                </a>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-100 text-blue-600 text-lg font-semibold rounded-xl transform hover:scale-105 transition-all duration-200 shadow-lg">
                    Lihat Harga Layanan
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
