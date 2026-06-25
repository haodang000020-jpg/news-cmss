<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedure_required_documents', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('procedure_id')
                ->constrained('procedures')
                ->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('original_count')->default(0);
            $table->unsignedInteger('copy_count')->default(0);
            $table->text('note')->nullable();
            $table->string('form_path')->nullable();
            $table->string('form_name')->nullable();
            $table->boolean('is_required')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['procedure_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedure_required_documents');
    }
};
