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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained("users", "id")->cascadeOnDelete();
            $table->foreignId('root_folder_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('postcode')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
