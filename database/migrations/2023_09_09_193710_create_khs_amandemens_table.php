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
        Schema::create('khs_amandemens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('khs_induk_id')->constrained();
            $table->string('no');
            $table->string('judul');
            $table->date('tgl_berlaku');
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
        Schema::dropIfExists('khs_amandemens');
    }
};
