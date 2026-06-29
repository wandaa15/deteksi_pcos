@extends('layouts.app')

@section('title', 'Masuk - DiaCheck')

@section('content')
<div class="max-w-md mx-auto py-8">
    <div class="card-custom p-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-extrabold tracking-tight">Selamat Datang Kembali</h2>
            <p class="text-slate-500 text-xs sm:text-sm mt-1">Masuk untuk mengakses layanan deteksi risiko diabetes Anda</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Email Address -->
            <div>
                <label for="email" class="form-label-custom">
                    <i class="fa-solid fa-envelope text-slate-400 mr-1.5"></i>Alamat Email
                </label>
                <input type="email" name="email" id="email" 
                       class="form-input-custom" 
                       placeholder="nama@email.com" 
                       value="{{ old('email') }}" 
                       required autofocus>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="form-label-custom">
                    <i class="fa-solid fa-lock text-slate-400 mr-1.5"></i>Kata Sandi
                </label>
                <input type="password" name="password" id="password" 
                       class="form-input-custom" 
                       placeholder="••••••••" 
                       required>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn-rose-custom w-full justify-center py-3">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang
                </button>
            </div>
        </form>

        <div class="mt-8 text-center border-t border-rose-100 pt-6">
            <p class="text-xs text-slate-500">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="text-rose-600 font-bold hover:underline">Daftar Akun Baru</a>
            </p>
        </div>
    </div>
</div>
@endsection
