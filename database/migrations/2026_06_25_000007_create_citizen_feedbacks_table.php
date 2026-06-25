<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citizen_feedbacks', function (Blueprint $table): void {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('tracking_code', 32)->unique();
            $table->foreignId('feedback_category_id')
                ->constrained('feedback_categories')
                ->restrictOnDelete();
            $table->string('full_name');
            $table->string('phone', 20)->index();
            $table->string('email')->nullable()->index();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('subject');
            $table->text('content');
            $table->string('status', 30)->default('new')->index();
            $table->text('admin_response')->nullable();
            $table->text('internal_note')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('received_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->unsignedTinyInteger('satisfaction_rating')->nullable()->index();
            $table->text('satisfaction_comment')->nullable();
            $table->timestamp('satisfaction_at')->nullable();
            $table->char('ip_hash', 64)->nullable()->index();
            $table->string('user_agent', 500)->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index(['feedback_category_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citizen_feedbacks');
    }
};
