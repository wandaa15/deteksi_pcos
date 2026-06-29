@extends('layouts.app')

@section('title', 'Deteksi PCOS')

@section('content')

<div class="max-w-3xl mx-auto">

<div class="text-center mb-10">
    <h1 class="text-4xl font-extrabold hero-gradient-text mb-4">
        Deteksi Risiko PCOS
    </h1>

    <p class="text-slate-500 mt-3 text-lg">
        Unggah citra medis (ultrasound) untuk dianalisis oleh AI dan mengetahui tingkat risiko Polycystic Ovary Syndrome (PCOS).
    </p>
</div>

<form action="{{ route('deteksi.proses') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
    @csrf

    <div class="card-custom p-10 mb-8 text-center transition-all duration-300 hover:shadow-xl border-2 border-dashed border-rose-200 bg-rose-50/30 rounded-2xl">
        
        <div class="mb-6 flex justify-center">
            <div class="h-24 w-24 bg-rose-100 text-rose-500 rounded-full flex items-center justify-center text-4xl shadow-sm">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-2 text-gray-800">
            Pilih atau Tarik Gambar
        </h2>
        <p class="text-gray-500 mb-6 text-sm">
            Format yang didukung: JPEG, PNG, JPG (Maks 5MB)
        </p>

        <div class="relative w-full max-w-xs mx-auto">
            <input type="file" name="image" id="imageInput" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".jpg, .jpeg, .png" required onchange="previewImage(event)">
            <label for="imageInput" class="btn-rose-custom w-full flex justify-center items-center py-3 px-6 cursor-pointer">
                <i class="fa-solid fa-folder-open mr-2"></i> Cari File
            </label>
        </div>
        
        @error('image')
            <div class="text-red-500 text-sm mt-3">{{ $message }}</div>
        @enderror
        @error('ml_error')
            <div class="text-red-500 text-sm mt-3 bg-red-50 p-2 rounded">{{ $message }}</div>
        @enderror

        <div id="imagePreviewContainer" class="hidden mt-8">
            <h3 class="text-sm font-semibold text-gray-600 mb-3">Pratinjau Gambar</h3>
            <div class="relative inline-block border-4 border-white shadow-lg rounded-xl overflow-hidden">
                <img id="imagePreview" src="#" alt="Preview" class="max-w-xs max-h-64 object-cover">
            </div>
        </div>

    </div>

    <div class="flex justify-center mt-8">
        <button type="submit"
                id="submitBtn"
                class="btn-rose-custom text-lg px-10 py-4 shadow-lg hover:shadow-rose-500/30 flex items-center gap-3">
            <i class="fa-solid fa-microscope text-xl"></i>
            Mulai Analisis Gambar
        </button>
    </div>

</form>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex-col items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-2xl flex flex-col items-center max-w-sm mx-4 text-center">
        <i class="fa-solid fa-circle-notch fa-spin text-5xl text-rose-500 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Memproses Gambar</h3>
        <p class="text-slate-500 text-sm">Model AI sedang melakukan analisis pada gambar ultrasound Anda. Proses ini mungkin memakan waktu beberapa detik, mohon tunggu...</p>
    </div>
</div>

</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            document.getElementById('imagePreviewContainer').classList.remove('hidden');
        }
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    document.getElementById('uploadForm').addEventListener('submit', function() {
        if (document.getElementById('imageInput').files.length > 0) {
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        }
    });
</script>

@endsection
