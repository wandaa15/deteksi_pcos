<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_deteksi', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->integer('age');

            $table->double('bmi');

            $table->integer('income');

            $table->integer('education');

            $table->integer('genhlth');

            $table->integer('menthlth');

            $table->integer('physhlth');

            $table->boolean('highbp');

            $table->boolean('highchol');

            $table->boolean('smoker');

            $table->boolean('stroke');

            $table->boolean('heartdiseaseorattack');

            $table->boolean('physactivity');

            $table->boolean('fruits');

            $table->boolean('veggies');

            $table->boolean('sex');

            $table->string('bmi_category')->nullable();

            $table->integer('risk_factor_count')->nullable();

            $table->double('bmi_physactivity')->nullable();

            $table->string('hasil_prediksi');

            $table->double('probabilitas')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_deteksi');
    }
    
};