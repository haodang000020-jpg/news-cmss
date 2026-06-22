<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('organization_members')
                ->nullOnDelete();

            $table->string('name', 150);
            $table->string('position', 150);

            // 1: Trưởng phòng
            // 2: Phó phòng
            // 3: Công chức
            $table->unsignedTinyInteger('position_level')->default(3);

            $table->string('department')->nullable();
            $table->text('responsibility')->nullable();

            $table->string('phone', 30)->nullable();
            $table->string('email')->nullable();

            $table->string('photo_path')->nullable();
            $table->text('biography')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['position_level', 'sort_order']);
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_members');
    }
};
