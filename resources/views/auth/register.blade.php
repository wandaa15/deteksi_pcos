@extends('layouts.app')

@section('title', 'Daftar Akun Baru - DiaCheck')

@section('content')
<div class="max-w-md mx-auto py-8">
    <div class="card-custom p-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-extrabold tracking-tight">Daftar Akun Baru</h2>
            <p class="text-slate-500 text-xs sm:text-sm mt-1">
                Buat akun untuk memulai deteksi dini risiko diabetes Anda
            </p>
        </div>

        <form action="{{ url('/register') }}" method="POST">
            @csrf
            
            <!-- Full Name -->
            <div class="mb-5">
                <label for="nama" class="form-label-custom">
                    <i class="fa-solid fa-user text-slate-400 mr-1.5"></i>Nama Lengkap
                </label>
                <input type="text" name="nama" id="nama"
                    class="form-input-custom @error('nama') border-rose-500 @enderror"
                    placeholder="Masukkan nama lengkap Anda"
                    value="{{ old('nama') }}"
                    required autofocus>

                @error('nama')
                    <span class="text-xs text-rose-500 mt-1 block font-semibold">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-5">
                <label for="email" class="form-label-custom">
                    <i class="fa-solid fa-envelope text-slate-400 mr-1.5"></i>Alamat Email
                </label>
                <input type="email" name="email" id="email"
                    class="form-input-custom @error('email') border-rose-500 @enderror"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    required>

                @error('email')
                    <span class="text-xs text-rose-500 mt-1 block font-semibold">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="form-label-custom">
                    <i class="fa-solid fa-lock text-slate-400 mr-1.5"></i>Kata Sandi
                </label>
                <input type="password" name="password" id="password"
                    class="form-input-custom @error('password') border-rose-500 @enderror"
                    placeholder="Minimal 6 karakter"
                    required>

                @error('password')
                    <span class="text-xs text-rose-500 mt-1 block font-semibold">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="form-label-custom">
                    <i class="fa-solid fa-shield-halved text-slate-400 mr-1.5"></i>Konfirmasi Kata Sandi
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-input-custom"
                    placeholder="Ulangi kata sandi"
                    required>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn-rose-custom w-full justify-center py-3">
                    <i class="fa-solid fa-user-plus"></i>
                    Daftar Akun Baru
                </button>
            </div>
        </form>

        <div class="mt-8 text-center border-t border-rose-100 pt-6">
            <p class="text-xs text-slate-500">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="text-rose-600 font-bold hover:underline">
                    Masuk Sekarang
                </a>
            </p>
        </div>
    </div>
</div>
@endsection