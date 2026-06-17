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
    Schema::create('site_visits', function (Blueprint $table) {
        $table->id();
        $table->string('session_id')->nullable()->index();
        $table->string('ip_hash')->nullable();
        $table->string('user_agent_hash')->nullable();
        $table->timestamp('visited_at')->useCurrent();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('site_visits');
}
};
