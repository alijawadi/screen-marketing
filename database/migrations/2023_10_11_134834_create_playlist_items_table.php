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
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id');
            $table->string('item_type');
            $table->unsignedInteger('duration');
            $table->foreignId('playlist_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger('order_column')->nullable()->index();
            $table->unique(['order_column', 'playlist_id']);
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
