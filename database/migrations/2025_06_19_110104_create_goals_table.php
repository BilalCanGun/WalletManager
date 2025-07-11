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
        Schema::create('goals', function (Blueprint $table) {
            $table->bigIncrements('goalid');
            $table->unsignedBigInteger('userid');
            $table->string('goal_name');
            $table->double('cost');
            $table->timestamps();

            // Foreign key tanımı
            $table->foreign('userid')
                ->references('userid')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};