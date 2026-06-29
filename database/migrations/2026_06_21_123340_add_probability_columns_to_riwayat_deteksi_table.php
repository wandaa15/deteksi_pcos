<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('riwayat_deteksi', function (Blueprint $table) {

            $table->double('prob_non_diabetes')
                ->nullable()
                ->after('probabilitas');

            $table->double('prob_pre_diabetes')
                ->nullable()
                ->after('prob_non_diabetes');

            $table->double('prob_diabetes')
                ->nullable()
                ->after('prob_pre_diabetes');
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_deteksi', function (Blueprint $table) {

            $table->dropColumn([
                'prob_non_diabetes',
                'prob_pre_diabetes',
                'prob_diabetes'
            ]);
        });
    }
};