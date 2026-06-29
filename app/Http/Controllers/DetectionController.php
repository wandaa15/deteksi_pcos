<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class DetectionController extends Controller
{
    /**
     * Show welcome page.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show detection form.
     */
    public function showForm()
    {
        return view('detection.form');
    }

    /**
     * Run prediction and show result directly.
     */
    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // max 5MB
        ], [
            'required' => 'Silakan unggah gambar.',
            'image' => 'File harus berupa gambar.',
            'mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        if (!$request->hasFile('image')) {
            return back()->withErrors(['image' => 'Gagal mengunggah gambar.']);
        }

        // Save image to storage/app/public/pcos_images temporarily
        $imagePath = $request->file('image')->store('pcos_images', 'public');
        $absolutePath = storage_path('app/public/' . $imagePath);

        // Call the Python FastAPI model
        try {
            $response = \Illuminate\Support\Facades\Http::post('http://127.0.0.1:8001/predict', [
                'image_path' => $absolutePath
            ]);
            $output = $response->json();
        } catch (\Exception $e) {
            $output = null;
        }

        if ($output && isset($output['success']) && $output['success']) {
            $riwayat = (object) [
                'image_path' => $imagePath,
                'prediction_result' => $output['prediction'],
                'confidence_score' => $output['confidence'],
            ];

            return view('detection.output', compact('riwayat'));
        } else {
            $errorMsg = $output ? ($output['detail'] ?? $output['error'] ?? 'Terjadi kesalahan sistem model') : 'Gagal menghubungi API Python (pastikan uvicorn berjalan).';
            Storage::disk('public')->delete($imagePath);
            return back()->withErrors(['ml_error' => $errorMsg])->withInput();
        }
    }
}

