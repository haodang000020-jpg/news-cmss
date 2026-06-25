<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assistant_queries', function (Blueprint $table): void {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('question', 250);
            $table->string('normalized_question', 250)->index();
            $table->foreignId('matched_procedure_id')
                ->nullable()
                ->constrained('procedures')
                ->nullOnDelete();
            $table->unsignedSmallInteger('result_count')->default(0);
            $table->char('ip_hash', 64)->nullable()->index();
            $table->string('user_agent', 500)->nullable();
            $table->boolean('is_resolved')->default(false)->index();
            $table->boolean('is_helpful')->nullable()->index();
            $table->timestamp('feedback_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assistant_queries');
    }
};
