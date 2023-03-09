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
                        $table->string('name',100);
                        $table->string('email')->unique();
                        $table->enum('gender',['Male','Femela','None'])->default('None');
                        $table->date('birthday')->nullable();
                        $table->integer('age')->nullable();
                        $table->string('lang')->default('en');
                        $table->string('city',50)->nullable();
                        $table->string('state')->nullable();
                        $table->string('country',50)->nullable();
                        $table->timestamp('email_verified_at')->nullable();
                        $table->string('password');
                        $table->rememberToken();
                        $table->foreignId('current_team_id')->nullable();
                        $table->string('profile_photo_path', 2048)->nullable();
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
