<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ProdutoController;


Route::get('/', function () {
    return redirect()->route('produtos.produtos_create');
});

// Rota raiz redireciona para o cadastro de produtos
Route::redirect('/', '/produtos/create')->name('home');

// Grupo de rotas para produtos
Route::prefix('produtos')->name('produtos.')->group(function () {
    // Exibir formulário de cadastro de produto
    Route::get('/create', [ProdutoController::class, 'create'])->name('create');
    
    // Salvar produto
    Route::post('/', [ProdutoController::class, 'store'])->name('store');
    
    // Listar produtos
    Route::get('/', [ProdutoController::class, 'index'])->name('index');
    
    // Editar produto
    Route::get('/{id}/edit', [ProdutoController::class, 'edit'])->name('edit');
    
    // Atualizar produto
    Route::put('/{id}', [ProdutoController::class, 'update'])->name('update');
    
    // Excluir produto
    Route::delete('/{id}', [ProdutoController::class, 'destroy'])->name('destroy');
});

// Grupo de rotas para carrinho
Route::prefix('carrinho')->name('carrinho.')->group(function () {
    // Exibir carrinho
    Route::get('/', [CarrinhoController::class, 'index'])->name('index');
    
    // Adicionar item ao carrinho
    Route::post('/adicionar', [CarrinhoController::class, 'adicionar'])->name('adicionar');
});

// Rota para finalizar pedido
Route::post('/pedido/finalizar', [PedidoController::class, 'finalizar'])
     ->name('pedido.finalizar');