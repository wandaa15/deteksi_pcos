<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('riwayat_deteksi', function (Blueprint $table) {

            $table->boolean('highchol')->default(false)->after('highbp');

            $table->boolean('stroke')->default(false)->after('smoker');

            $table->boolean('heartdiseaseorattack')
                  ->default(false)
                  ->after('stroke');

            $table->boolean('physactivity')
                  ->default(false)
                  ->after('heartdiseaseorattack');
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_deteksi', function (Blueprint $table) {

            $table->dropColumn([
                'highchol',
                'stroke',
                'heartdiseaseorattack',
                'physactivity'
            ]);
        });
    }
};