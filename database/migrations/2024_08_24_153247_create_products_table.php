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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('images');
            $table->longText('uses');
            $table->longText('description');
            $table->integer('subject_of_use')->index()->default(0)->comment('0: khong xac dinh, 1: tre em, 2: nguoi lon, 3: nguoi gia');
            $table->integer('rate')->index()->default(0);
            $table->longText('note');
            $table->integer('active')->index()->default(0);
            $table->integer('order')->index()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
