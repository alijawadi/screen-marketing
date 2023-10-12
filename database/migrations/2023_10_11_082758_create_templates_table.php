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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name', '50')->nullable();
            $table->json('data')->nullable();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
            $table->audits();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
