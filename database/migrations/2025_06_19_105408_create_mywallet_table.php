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
        Schema::create('mywallet', function (Blueprint $table) {
            $table->bigIncrements('walletid');
            $table->unsignedBigInteger('userid');
            $table->string('type');
            $table->double('value');
            $table->timestamps();

            // Foreign Key tanımı
            $table->foreign('userid')
                ->references('userid') // users tablosundaki anahtar
                ->on('users')
                ->onDelete('cascade'); // kullanıcı silinirse ilişkili kayıtlar da silinir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mywallet');
    }
};