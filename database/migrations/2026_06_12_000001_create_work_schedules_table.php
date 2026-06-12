<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_schedules', function (Blueprint $table): void {
            $table->id();
            $table->tinyInteger('day_of_week')->nullable();
            $table->string('title')->nullable();
            $table->string('morning_time')->nullable();
            $table->string('afternoon_time')->nullable();
            $table->text('note')->nullable();
            $table->boolean('is_working_day')->default(true);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_schedules');
    }
};
