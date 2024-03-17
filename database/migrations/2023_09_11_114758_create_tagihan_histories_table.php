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
        Schema::create('tagihan_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id')->constrained();
            $table->unsignedTinyInteger('status');
            $table->text('revisi')->nullable();
            $table->text('json');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_histories');
    }
};
