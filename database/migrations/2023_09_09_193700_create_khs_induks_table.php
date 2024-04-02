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
        Schema::create('khs_induks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auth_login_id')->constrained();
            $table->string('no');
            $table->string('judul');
            $table->date('tgl_berlaku');
            $table->json('json');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khs_induks');
    }
};
