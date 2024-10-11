<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wells', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->constrained('fields'); // Месторождение
            $table->string('well_number');  // Номер скважины
            $table->foreignId('well_type_id')->constrained('well_types'); // Тип скважины
            $table->foreignId('well_status_id')->constrained('well_statuses'); // Состояние скважины
            $table->foreignId('horizon_id')->nullable()->constrained('horizons'); // Горизонт
            $table->float('liquid_flow')->nullable();  // Q жидкости
            $table->float('water_cut')->nullable();  // Обводненность
            $table->float('oil_density')->nullable();  // Плотность нефти
            $table->float('oil_rate')->nullable();  // Дебит нефти
            $table->boolean('is_saved')->default(true);  // Флаг сохраненных/несохраненных данных
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wells');
    }
};
