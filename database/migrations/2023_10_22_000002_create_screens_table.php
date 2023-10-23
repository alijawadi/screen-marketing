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
        Schema::create('screens', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable()->unique();
            $table->string('device_id')->nullable();
            $table->foreignId('organization_id')->nullable()->constrained("organizations","id")->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->jsonb('tv_data')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screens');
    }
};
