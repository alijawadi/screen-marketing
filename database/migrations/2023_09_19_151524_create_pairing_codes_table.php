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
        Schema::create('pairing_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('screen_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('organization_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('code')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pairing_codes');
    }
};
