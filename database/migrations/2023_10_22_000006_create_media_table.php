<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained("organizations", "id")->cascadeOnDelete();
            $table->foreignId('folder_id')->constrained("folders", "id")->cascadeOnDelete();
            $table->foreignId('uploaded_by')->constrained('users', 'id')->nullOnDelete();
            $table->morphs('model');
            $table->uuid()->unique();
            $table->string('name');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size');
            $table->string('url');
            $table->string('key');
            $table->string('collection_name');
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->json('generated_conversions');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }

};
