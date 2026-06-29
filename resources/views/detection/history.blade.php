@extends('layouts.app')

@section('title', 'Riwayat Deteksi PCOS')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="text-center mb-8">

        <h1 class="text-4xl font-extrabold hero-gradient-text mb-4">
            Riwayat Deteksi Saya
        </h1>

        <p class="text-slate-500 mt-2 text-lg">
            Seluruh hasil deteksi risiko Polycystic Ovary Syndrome (PCOS) yang pernah Anda lakukan.
        </p>

    </div>

    @if($riwayat->count() == 0)

        <div class="card-custom p-12 text-center">

            <i class="fa-solid fa-clock-rotate-left text-6xl text-rose-300 mb-6"></i>

            <h3 class="text-2xl font-bold text-slate-700 mb-3">
                Belum Ada Riwayat
            </h3>

            <p class="text-slate-500 mb-6">
                Anda belum pernah melakukan deteksi risiko PCOS.
            </p>

            <a href="{{ route('deteksi.form') }}"
               class="btn-rose-custom">
                <i class="fa-solid fa-camera mr-2"></i> Mulai Deteksi
            </a>

        </div>

    @else

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($riwayat as $item)

                @php
                    $badgeClass = 'bg-green-100 text-green-700 border border-green-200';
                    $icon = 'fa-check-circle';

                    if($item->prediction_result == 'PCOS'){
                        $badgeClass = 'bg-rose-100 text-rose-700 border border-rose-200';
                        $icon = 'fa-triangle-exclamation';
                    }
                @endphp

                <div class="card-custom overflow-hidden transition-all duration-300 hover:shadow-xl group">

                    <div class="h-40 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Image">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-3 left-3 text-white text-sm font-medium">
                            <i class="fa-regular fa-calendar mr-1"></i> {{ $item->created_at->format('d M Y') }}
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $badgeClass }}">
                                <i class="fa-solid {{ $icon }} mr-1"></i>
                                {{ $item->prediction_result }}
                            </span>
                        </div>

                        <div class="space-y-2 mb-5 text-sm">
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="text-slate-500">Tingkat Keyakinan</span>
                                <span class="font-bold text-gray-700">{{ number_format($item->confidence_score, 2) }}%</span>
                            </div>
                        </div>

                        <a href="{{ route('deteksi.hasil', $item->id) }}"
                           class="btn-outline-rose w-full justify-center text-sm">
                            <i class="fa-solid fa-eye mr-2"></i> Lihat Detail
                        </a>
                    </div>
                </div>

            @endforeach

        </div>

        <!-- Statistik Ringkas -->
        <div class="grid md:grid-cols-3 gap-6 mt-8">

            <div class="card-custom p-6 text-center">
                <h4 class="text-slate-500 text-sm mb-2">Total Deteksi</h4>
                <p class="text-4xl font-extrabold text-gray-800">{{ $riwayat->count() }}</p>
            </div>

            <div class="card-custom p-6 text-center">
                <h4 class="text-slate-500 text-sm mb-2">Terdeteksi PCOS</h4>
                <p class="text-4xl font-extrabold text-rose-500">
                    {{ $riwayat->where('prediction_result','PCOS')->count() }}
                </p>
            </div>

            <div class="card-custom p-6 text-center">
                <h4 class="text-slate-500 text-sm mb-2">Normal</h4>
                <p class="text-4xl font-extrabold text-green-500">
                    {{ $riwayat->where('prediction_result','Normal')->count() }}
                </p>
            </div>

        </div>

    @endif

</div>

@endsection