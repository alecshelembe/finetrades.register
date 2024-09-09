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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_image_url')->nullable();
            $table->string('role')->default('user'); // Setting default value for 'role'
            $table->string('position')->default('unknown'); // Setting default value for 'position'
            $table->string('age')->default('0'); // Setting default value for 'age'
            $table->string('street')->default(''); // Setting default value for 'street'
            $table->string('street_2')->default(''); // Setting default value for 'street_2'
            $table->string('district')->default(''); // Setting default value for 'district'
            $table->string('city')->default(''); // Setting default value for 'city'
            $table->string('province')->default(''); // Setting default value for 'province'
            $table->string('postal_code')->default(''); // Setting default value for 'postal_code'
            $table->rememberToken();
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
