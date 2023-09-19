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
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name',255);
            $table->string('email',255);
            $table->string('picture',255);
            $table->string('password',255);
            $table->string('gender',255);
            $table->string('school',255);
            $table->string('degree',255);
            $table->string('field_of_study',255);
            $table->string('title',255)->nullable();
            $table->string('company',255)->nullable();
            $table->string('location',255)->nullable();
            $table->String('withdraw_method')->nullable();
            $table->String('withdraw_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
