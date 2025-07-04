<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('cliente_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('forma_pagamento_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->decimal('valor_total', 10, 2);

            $table->date('data'); // <--- Adicionada aqui

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
