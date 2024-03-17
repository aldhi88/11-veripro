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
        Schema::create('sp_amandemens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sp_induk_id')->constrained();
            $table->foreignId('auth_login_id')->constrained();
            $table->foreignId('khs_induk_id')->constrained();
            $table->foreignId('master_unit_id')->constrained();
            $table->foreignId('khs_amandemen_id')->nullable();
            $table->foreignId('mitra_id');
            $table->string('no_sp');
            $table->date('tgl_sp');
            $table->date('tgl_toc');
            $table->string('nama_pekerjaan');
            $table->string('file_sp');
            $table->string('file_lokasi');
            $table->unsignedTinyInteger('ppn');
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
        Schema::dropIfExists('sp_amandemens');
    }
};