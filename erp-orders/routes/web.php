<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CupomController;

Route::get('/', function () {
    return redirect()->route('produtos.produtos_create');
});

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

Route::redirect('/', '/produtos/create')->name('home');

Route::prefix('produtos')->name('produtos.')->group(function () {
    Route::get('/create', [ProdutoController::class, 'create'])->name('create');
    Route::post('/', [ProdutoController::class, 'store'])->name('store');
    Route::get('/', [ProdutoController::class, 'index'])->name('index');
    Route::get('/{id}/edit', [ProdutoController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ProdutoController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProdutoController::class, 'destroy'])->name('destroy');
});


Route::prefix('/cupons')->name('cupons.')->group(function () {
    Route::get('/', [CupomController::class, 'index'])->name('index');
    Route::get('/create', [CupomController::class, 'create'])->name('create');
    Route::post('/', [CupomController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CupomController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CupomController::class, 'update'])->name('update');
    Route::delete('/{id}', [CupomController::class, 'destroy'])->name('destroy');
});

Route::prefix('/carrinho')->name('carrinho.')->group(function () {
    Route::get('/', [CarrinhoController::class, 'index'])->name('index');
    Route::post('/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('adicionar');
    Route::put('/atualizar/{index}', [CarrinhoController::class, 'atualizar'])->name('atualizar');
    Route::delete('/remover/{index}', [CarrinhoController::class, 'remover'])->name('remover');
});



Route::post('/pedido/finalizar', [PedidoController::class, 'finalizar'])
     ->name('pedido.finalizar');