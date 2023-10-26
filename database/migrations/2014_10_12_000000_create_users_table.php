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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained("users", "id")->cascadeOnDelete();
            $table->foreignId('organization_id')->nullable();
            $table->uuid()->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->text('password');
            $table->json('roles')->default(json_encode([]));
            $table->json('accesses')->default(json_encode([]));
            $table->boolean('is_organization_owner');
            $table->boolean('is_active');

            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
