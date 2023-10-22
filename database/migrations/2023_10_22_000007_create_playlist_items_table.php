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
            $table->foreignId('playlist_id')->constrained("playlists","id")->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users', 'id')->cascadeOnDelete();

            $table->string('item_type');
            $table->unsignedInteger('duration');
            $table->unsignedInteger('order_column')->nullable()->index();

            $table->timestamps();

            $table->unique(['order_column', 'playlist_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_items');
    }
};
