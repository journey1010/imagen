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
        Schema::create('table_image', function (Blueprint $table) {
            $table->id();
            $table->string('nombreGerencia');
            $table->string('gerenciaReferencia')->nullable();
            $table->string('colorGerencia')->nullable();
            $table->string('logoGerencia')->nullable();
            $table->string('nombreObraPrograma', 1000)->nullable();
            $table->text('imagen')->nullable();
            $table->string('montoInversion')->nullable();
            $table->string('descripcion', 2000)->nullable();
            $table->string('beneficiarios')->nullable();
            $table->string('codigoInversion')->nullable();
            $table->string('tipoInversion')->nullable();
            $table->string('estudiosPreliminares')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_image');
    }
};
