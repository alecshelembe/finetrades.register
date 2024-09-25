<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Add plate column as BOOLEAN with default value false
            $table->boolean('plate')->default(false);
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop the plate column
            $table->dropColumn('plate');
        });
    }
};