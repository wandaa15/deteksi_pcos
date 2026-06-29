@extends('layouts.app')

@section('title', 'Beranda - PCOSAI Deteksi Dini PCOS')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <!-- Hero Section -->
    <div class="card-custom p-8 sm:p-12 mb-12 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden bg-rose-50/50">
        <div class="flex-1 text-center md:text-left z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold text-rose-600 bg-rose-100 border border-rose-200 mb-4 animate-pulse">
                <i class="fa-solid fa-sparkles"></i> Deteksi Cepat & Akurat
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4 leading-tight text-gray-800">
                Skrining Risiko PCOS Melalui <span class="text-rose-500">Kecerdasan Buatan</span>
            </h1>
            <p class="text-sm sm:text-base text-slate-600 mb-8 max-w-lg leading-relaxed">
                Polycystic Ovary Syndrome (PCOS) adalah gangguan hormon yang umum terjadi pada wanita usia subur. Gunakan aplikasi skrining kami berbasis AI untuk menganalisis gambar ultrasound Anda secara instan. Tanpa perlu mendaftar.
            </p>
            <div>
                <a href="{{ route('deteksi.form') }}" class="btn-rose-custom text-base py-3 px-8 shadow-lg hover:shadow-rose-500/30">
                    <i class="fa-solid fa-camera"></i> Mulai Analisis Gambar
                </a>
            </div>
        </div>
        <div class="flex-1 flex justify-center items-center z-10">
            <!-- Icon illustration with animations -->
            <div class="w-48 h-48 sm:w-64 sm:h-64 bg-rose-100 rounded-full flex items-center justify-center border-4 border-white shadow-xl relative animate-bounce" style="animation-duration: 4s;">
                <i class="fa-solid fa-microscope text-7xl sm:text-8xl text-rose-500"></i>
                <div class="absolute -top-2 -right-2 w-12 h-12 bg-white shadow rounded-full flex items-center justify-center text-rose-400 animate-spin" style="animation-duration: 10s;">
                    <i class="fa-solid fa-notes-medical text-xl"></i>
                </div>
                <div class="absolute -bottom-2 -left-2 w-14 h-14 bg-white shadow rounded-full flex items-center justify-center text-rose-400">
                    <i class="fa-solid fa-brain text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Educational section -->
    <div class="text-center mb-12">
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-2 text-gray-800">Mengapa Deteksi Dini itu Penting?</h2>
        <p class="text-slate-500 max-w-xl mx-auto text-sm sm:text-base">
            Mengenali tanda-tanda PCOS sejak awal memungkinkan Anda melakukan langkah penanganan medis yang tepat dan memperbaiki gaya hidup untuk mencegah komplikasi di masa depan.
        </p>
    </div>

    <!-- Feature Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="feature-card text-center p-6 bg-white rounded-2xl shadow-sm border border-rose-100 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 mx-auto bg-rose-100 text-rose-500 rounded-full flex items-center justify-center text-2xl mb-4">
                <i class="fa-solid fa-person-pregnant"></i>
            </div>
            <h3 class="font-bold text-lg mb-2 text-slate-700">Gangguan Kesuburan</h3>
            <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                PCOS sering kali menjadi penyebab utama gangguan kesuburan atau infertilitas pada wanita.
            </p>
        </div>

        <div class="feature-card text-center p-6 bg-white rounded-2xl shadow-sm border border-rose-100 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 mx-auto bg-rose-100 text-rose-500 rounded-full flex items-center justify-center text-2xl mb-4">
                <i class="fa-solid fa-weight-scale"></i>
            </div>
            <h3 class="font-bold text-lg mb-2 text-slate-700">Komplikasi Metabolik</h3>
            <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                Wanita dengan PCOS memiliki risiko lebih tinggi mengalami resistensi insulin, obesitas, dan komplikasi jangka panjang lainnya.
            </p>
        </div>

        <div class="feature-card text-center p-6 bg-white rounded-2xl shadow-sm border border-rose-100 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 mx-auto bg-rose-100 text-rose-500 rounded-full flex items-center justify-center text-2xl mb-4">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </div>
            <h3 class="font-bold text-lg mb-2 text-slate-700">Cerdas Berbasis AI</h3>
            <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                Model Deep Learning kami dilatih menggunakan ribuan citra ultrasound untuk membantu identifikasi dengan cepat.
            </p>
        </div>
    </div>

    <!-- How it works card -->
    <div class="card-custom p-8 sm:p-10 mb-12 border border-rose-100">
        <h3 class="text-xl sm:text-2xl font-extrabold mb-8 text-center text-gray-800">Langkah Analisis Cepat</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 bg-rose-100 border border-rose-200 text-rose-600 rounded-full flex items-center justify-center font-bold text-lg mb-3 shadow-sm">1</div>
                <h4 class="font-bold text-sm mb-1 text-gray-700">Pilih Citra</h4>
                <p class="text-xs text-slate-500">Siapkan dan unggah citra medis ultrasound ke dalam sistem kami.</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 bg-rose-100 border border-rose-200 text-rose-600 rounded-full flex items-center justify-center font-bold text-lg mb-3 shadow-sm">2</div>
                <h4 class="font-bold text-sm mb-1 text-gray-700">Proses AI</h4>
                <p class="text-xs text-slate-500">Sistem cerdas akan mengekstraksi dan menganalisis pola dari citra secara instan.</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 bg-rose-100 border border-rose-200 text-rose-600 rounded-full flex items-center justify-center font-bold text-lg mb-3 shadow-sm">3</div>
                <h4 class="font-bold text-sm mb-1 text-gray-700">Dapatkan Hasil</h4>
                <p class="text-xs text-slate-500">Lihat hasil deteksi dan rekomendasi langsung di layar Anda.</p>
            </div>
        </div>
    </div>
</div>
@endsection
