@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Tambah Order Baru</h1>
            <p class="text-gray-600">Isi form di bawah untuk menambah pesanan laundry baru</p>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="text-red-800 font-semibold mb-2">Ada kesalahan!</h3>
                    <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf

                <div class="space-y-6">

                    <!-- Nama Pelanggan / Wali Santri -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Nama Pelanggan / Wali Santri <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_pelanggan" required
                            value="{{ old('nama_pelanggan') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Contoh: Bapak Ahmad">
                    </div>

                    <!-- No WhatsApp -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            No WhatsApp Wali Santri
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <span class="text-gray-500 font-medium">+62</span>
                            </div>
                            <input type="text" name="whatsapp"
                                value="{{ old('whatsapp') }}"
                                class="w-full pl-16 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="81234567890">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Untuk kirim nota otomatis via WhatsApp</p>
                    </div>

                    <!-- Layanan -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Layanan <span class="text-red-500">*</span>
                        </label>
                        <select name="layanan" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="">-- Pilih Layanan --</option>
                            <option value="Cuci Kering" {{ old('layanan') == 'Cuci Kering' ? 'selected' : '' }}>Cuci Kering</option>
                            <option value="Cuci Basah" {{ old('layanan') == 'Cuci Basah' ? 'selected' : '' }}>Cuci Basah</option>
                            <option value="Setrika" {{ old('layanan') == 'Setrika' ? 'selected' : '' }}>Setrika</option>
                            <option value="Cuci + Setrika" {{ old('layanan') == 'Cuci + Setrika' ? 'selected' : '' }}>Cuci + Setrika</option>
                        </select>
                    </div>

                    <!-- Grid 2 Kolom: Berat dan Jumlah Pakaian -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Berat -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Berat (kg) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" name="berat" step="0.1" required
                                    value="{{ old('berat') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="2.5">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <span class="text-gray-500 font-medium">kg</span>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Pakaian -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Jumlah Pakaian
                            </label>
                            <div class="relative">
                                <input type="number" name="jumlah_pakaian" min="0"
                                    value="{{ old('jumlah_pakaian') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="10">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <span class="text-gray-500 font-medium">pcs</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Total Harga -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Total Harga <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <span class="text-gray-500 font-medium">Rp</span>
                            </div>
                            <input type="number" name="total_harga" required
                                value="{{ old('total_harga') }}"
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="0">
                        </div>
                    </div>

                    <!-- Tahap Proses -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Tahap Proses
                        </label>
                        <select name="process_status"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="penerimaan" {{ old('process_status') == 'penerimaan' ? 'selected' : '' }}>Penerimaan</option>
                            <option value="pencucian" {{ old('process_status') == 'pencucian' ? 'selected' : '' }}>Pencucian</option>
                            <option value="pengeringan" {{ old('process_status') == 'pengeringan' ? 'selected' : '' }}>Pengeringan</option>
                            <option value="setrika" {{ old('process_status') == 'setrika' ? 'selected' : '' }}>Setrika</option>
                            <option value="selesai" {{ old('process_status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="diambil" {{ old('status') == 'diambil' ? 'selected' : '' }}>Sudah Diambil</option>
                        </select>
                    </div>

                    <!-- Catatan / Notes -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea name="catatan" rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Tambahkan catatan khusus untuk pesanan ini...">{{ old('catatan') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Contoh: Pisahkan pakaian putih, jangan pakai pewangi tertentu, dll</p>
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t-2 border-gray-200">
                    <a href="{{ route('admin.orders.index') }}"
                        class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Order
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
                    <p class="font-semibold mb-1">Tips Mengisi Order:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Isi nama wali santri dengan jelas untuk nota</li>
                        <li>No WhatsApp wajib diisi jika ingin kirim nota otomatis</li>
                        <li>Berat (kg) dan jumlah pakaian (pcs) membantu tracking</li>
                        <li>Catatan bisa diisi untuk permintaan khusus</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- WhatsApp Info Card -->
        <div class="mt-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                <div class="text-sm text-green-700">
                    <p class="font-semibold mb-1">Fitur Nota WhatsApp Otomatis:</p>
                    <p>Jika Anda mengisi No WhatsApp, nota laundry akan otomatis dikirim ke wali santri setelah pesanan selesai. Pastikan nomor dalam format: <strong>81234567890</strong> (tanpa +62 atau 0)</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
