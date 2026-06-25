<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedure_steps', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('procedure_id')
                ->constrained('procedures')
                ->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['procedure_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedure_steps');
    }
};
