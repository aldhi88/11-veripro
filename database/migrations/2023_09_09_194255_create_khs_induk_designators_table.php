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
        Schema::create('khs_induk_designators', function (Blueprint $table) {
            $table->id();

            $table->foreignId('khs_induk_id')->constrained();
            $table->string('kat1')->nullable();
            $table->string('kat2')->nullable();
            $table->string('nama')->nullable();
            $table->string('nama_material')->nullable();
            $table->string('nama_jasa')->nullable();
            $table->text('uraian');
            $table->string('satuan');
            $table->unsignedBigInteger('material');
            $table->unsignedBigInteger('jasa');
            $table->boolean('fix_price')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khs_induk_designators');
    }
};
