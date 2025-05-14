<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    session()->push('carrinho', [
        'produto_id' => $produto->id,
        'variacao' => 'Tamanho M',
        'quantidade' => 2,
        'preco' => $produto->preco
    ]);

}
