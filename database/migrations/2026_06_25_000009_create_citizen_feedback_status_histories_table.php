<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citizen_feedback_status_histories', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('citizen_feedback_id')
                ->constrained('citizen_feedbacks')
                ->cascadeOnDelete();
            $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('from_status', 30)->nullable();
            $table->string('to_status', 30);
            $table->text('public_note')->nullable();
            $table->text('internal_note')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['citizen_feedback_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citizen_feedback_status_histories');
    }
};
