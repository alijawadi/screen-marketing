<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media_playlist', function (Blueprint $table) {
            $table->foreignId('media_id')->constrained('media')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('playlist_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger('order_column')->nullable()->index();
            $table->timestamps();
            $table->audits();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_playlist');
    }
};
