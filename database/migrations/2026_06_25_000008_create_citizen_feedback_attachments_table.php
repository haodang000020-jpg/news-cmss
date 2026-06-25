<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citizen_feedback_attachments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('citizen_feedback_id')
                ->constrained('citizen_feedbacks')
                ->cascadeOnDelete();
            $table->string('original_name');
            $table->string('disk', 30)->default('local');
            $table->string('path');
            $table->string('mime_type', 150)->nullable();
            $table->unsignedBigInteger('size_bytes')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citizen_feedback_attachments');
    }
};
