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
        Schema::create('gift', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->double('price');
            $table->double('oldprice');
            $table->string('picture',2048);
            $table->boolean('available');
            $table->unsignedBigInteger('filter_id');
            $table->foreign('filter_id')->references('id')->on('filter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift');
    }
};
