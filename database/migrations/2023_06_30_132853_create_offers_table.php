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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 11);
            $table->string('instituicao', 255);
            $table->string('modalidade', 255);
            $table->decimal('valor_a_pagar', 10, 2);
            $table->decimal('valor_solicitado', 10, 2);
            $table->decimal('taxa_juros', 5, 5);
            $table->integer('qtd_parcelas');
            $table->timestamps();
        });

        // $table->unique(['cpf', 'instituicao', 'modalidade']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
