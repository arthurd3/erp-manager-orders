<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('frete', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('cep');
            $table->string('endereco');
            $table->string('status')->default('pendente');
            $table->timestamps();
        });

    }


    
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
