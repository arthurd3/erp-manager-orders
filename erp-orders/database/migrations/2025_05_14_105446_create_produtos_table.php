<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('preco', 15, 2); 
            $table->text('descricao')->nullable();
            $table->timestamps();
        });

    }

    
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
