@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-32 px-6">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 drop-shadow-lg">
            Selamat Datang di Catering Maju Jaya
        </h1>
        <p class="text-lg md:text-2xl font-light mb-8">
            Solusi Catering terbaik untuk acara kamu! Lezat, higienis, dan harga ramah kantong.
        </p>

        <a href="{{ url('/layanan') }}" class="bg-white text-indigo-700 font-semibold px-6 py-3 rounded-lg shadow hover:shadow-xl hover:bg-gray-100 transition duration-300">
            Lihat Layanan & Harga
        </a>
    </div>
</section>

<!-- LAYANAN SECTION -->
<section class="py-20 bg-gray-50 px-6">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-12">Layanan Kami</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- Card 1 -->
            <div class="bg-white shadow-lg rounded-2xl p-6 hover:shadow-2xl transition">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" class="rounded-xl mb-4">
                <h3 class="text-xl font-semibold mb-2">Snack Box Premium</h3>
                <p class="text-gray-600 mb-3">Cocok untuk meeting, arisan, dan event kecil.</p>
                <p class="font-bold text-indigo-700 text-lg">Mulai Rp 12.000</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow-lg rounded-2xl p-6 hover:shadow-2xl transition">
                <img src="https://images.unsplash.com/photo-1555243896-c709bfa0b564" class="rounded-xl mb-4">
                <h3 class="text-xl font-semibold mb-2">Katering Nasi Box</h3>
                <p class="text-gray-600 mb-3">Menu lengkap untuk kantor, rapat, dan acara.</p>
                <p class="font-bold text-indigo-700 text-lg">Mulai Rp 25.000</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow-lg rounded-2xl p-6 hover:shadow-2xl transition">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" class="rounded-xl mb-4">
                <h3 class="text-xl font-semibold mb-2">Paket Spesial Acara</h3>
                <p class="text-gray-600 mb-3">Catering untuk pesta, seminar, dan gathering.</p>
                <p class="font-bold text-indigo-700 text-lg">Mulai Rp 40.000</p>
            </div>

        </div>
    </div>
</section>

<!-- PROFIL USAHA -->
<section class="py-20 px-6 bg-white">
    <div class="container mx-auto">

        <h2 class="text-3xl font-bold text-center mb-8">Profil Usaha</h2>

        <div class="max-w-3xl mx-auto text-center text-gray-700 text-lg leading-relaxed">
            <p class="mb-6">
                Catering Maju Jaya telah melayani ratusan pelanggan sejak 2020.
                Kami berkomitmen memberikan makanan lezat, higienis, dan pelayanan cepat.
            </p>

            <p class="mb-6">
                Kami melayani berbagai kebutuhan acara seperti ulang tahun, kantor, rapat, seminar, dan event besar.
            </p>

            <p>
                <strong>Hubungi Kami:</strong>
                <br>
                <span class="text-indigo-700 font-bold text-xl">0812-3456-7890</span>
            </p>
        </div>

    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-gradient-to-r from-indigo-700 to-blue-600 text-white text-center">
    <h2 class="text-4xl font-bold mb-4">Siap Memesan?</h2>
    <p class="mb-8 text-lg">Kami siap membantu menyediakan kebutuhan catering acara kamu.</p>

    <a href="https://wa.me/6281234567890" target="_blank"
        class="bg-white text-indigo-700 font-semibold px-8 py-3 rounded-lg shadow hover:bg-gray-100 transition">
        Chat WhatsApp Sekarang
    </a>
</section>

@endsection