<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDeteksi extends Model
{
    protected $table = 'riwayat_deteksi';

    protected $fillable = [

        'user_id',

        'age',
        'bmi',

        'income',
        'education',

        'genhlth',
        'menthlth',
        'physhlth',

        'highbp',
        'highchol',
        'smoker',
        'stroke',
        'heartdiseaseorattack',
        'physactivity',

        'fruits',
        'veggies',
        'sex',

        'bmi_category',
        'risk_factor_count',
        'bmi_physactivity',

        'hasil_prediksi',
        'probabilitas',
        'prob_non_diabetes',
'prob_pre_diabetes',
'prob_diabetes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}