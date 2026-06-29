@extends('layouts.app')

@section('title', 'Hasil Deteksi PCOS')

@section('content')

@php
$riskClass = 'risk-card-rendah';
$icon = 'fa-check-circle';
$color = 'text-white';

if($riwayat->prediction_result == 'PCOS'){
    $riskClass = 'risk-card-tinggi';
    $icon = 'fa-triangle-exclamation';
    $color = 'text-white';
}
@endphp

<div class="max-w-5xl mx-auto">

<div class="text-center mb-8">
    <h1 class="text-4xl font-extrabold hero-gradient-text">
        Hasil Analisis PCOS
    </h1>

    <p class="text-slate-500 mt-2 text-lg">
        Berikut hasil analisis gambar ultrasound Anda menggunakan model kecerdasan buatan.
    </p>
</div>

<!-- RESULT CARD -->
<div class="risk-output-card {{ $riskClass }} p-10 mb-8 flex flex-col md:flex-row gap-8 items-center justify-center">

    <div class="w-full md:w-1/2 flex justify-center">
        <div class="relative inline-block border-4 border-white shadow-xl rounded-xl overflow-hidden bg-white">
            <img src="{{ asset('storage/' . $riwayat->image_path) }}" alt="Ultrasound Image" class="max-w-xs max-h-64 object-cover">
        </div>
    </div>

    <div class="w-full md:w-1/2 text-center md:text-left relative z-10">
        <i class="fa-solid {{ $icon }} text-6xl mb-4 {{ $color }}"></i>
        
        <p class="text-lg opacity-90 mb-1 text-white font-semibold">
            Hasil Deteksi AI
        </p>

        <h2 class="text-5xl font-extrabold mb-4 {{ $color }}">
            {{ $riwayat->prediction_result }}
        </h2>

        <div class="bg-white/80 p-4 rounded-xl shadow-sm inline-block">
            <p class="text-gray-700 font-medium mb-1">Tingkat Keyakinan Model</p>
            <div class="flex items-center gap-3">
                <div class="w-48 bg-gray-200 rounded-full h-3">
                    <div class="bg-rose-500 h-3 rounded-full" style="width: {{ $riwayat->confidence_score }}%"></div>
                </div>
                <span class="font-bold">{{ number_format($riwayat->confidence_score, 2) }}%</span>
            </div>
        </div>
    </div>

</div>

<!-- REKOMENDASI -->
<div class="card-custom p-8 mb-8">

    <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
        <i class="fa-solid fa-user-doctor text-rose-500"></i> Rekomendasi
    </h3>

    @if($riwayat->prediction_result == 'Normal')
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
            <p class="text-green-800">
                Berdasarkan analisis gambar, tidak ditemukan indikasi kuat adanya Polycystic Ovary Syndrome (PCOS). Tetap pertahankan pola hidup sehat dan konsultasikan dengan dokter jika Anda memiliki keluhan kesehatan reproduksi.
            </p>
        </div>
    @else
        <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg">
            <p class="text-rose-800 font-medium mb-2">
                Sistem mendeteksi adanya indikasi Polycystic Ovary Syndrome (PCOS).
            </p>
            <ul class="list-disc list-inside text-rose-700 space-y-1">
                <li>Segera konsultasikan hasil ini dengan dokter kandungan (Obgyn) untuk diagnosis pasti.</li>
                <li>PCOS adalah kondisi yang dapat dikelola dengan perawatan medis dan perubahan gaya hidup.</li>
                <li>Hasil ini berasal dari prediksi AI dan tidak menggantikan diagnosis medis profesional.</li>
            </ul>
        </div>
    @endif

</div>

<!-- ACTION -->
<div class="flex flex-wrap gap-4 justify-center">

    <a href="{{ route('deteksi.form') }}"
       class="btn-rose-custom px-6 py-3">
        <i class="fa-solid fa-camera mr-2"></i> Analisis Gambar Lain
    </a>

    <a href="{{ route('home') }}"
       class="btn-outline-rose px-6 py-3">
        <i class="fa-solid fa-house mr-2"></i> Kembali ke Beranda
    </a>

</div>

</div>

@endsection
