<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedures', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('procedure_group_id')
                ->constrained('procedure_groups')
                ->restrictOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code', 100)->nullable()->index();
            $table->text('summary')->nullable();
            $table->string('applicants')->nullable();
            $table->string('implementing_agency')->nullable();
            $table->text('receiving_place')->nullable();
            $table->text('implementation_method')->nullable();
            $table->string('processing_time')->nullable();
            $table->string('fee')->nullable();
            $table->string('dossier_quantity', 100)->nullable();
            $table->text('result')->nullable();
            $table->longText('legal_basis')->nullable();
            $table->string('service_url')->nullable();
            $table->text('keywords')->nullable();
            $table->date('updated_on')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'procedure_group_id']);
            $table->index(['is_featured', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedures');
    }
};
