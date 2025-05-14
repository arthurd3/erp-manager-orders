<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function finalizar(Request $request)
    {
        $carrinho = session('carrinho', []);
        if (empty($carrinho)) {
            return redirect()->back()->with('error', 'Carrinho vazio.');
        }

        
        $subtotal = collect($carrinho)->sum(fn($item) => $item['preco'] * $item['quantidade']);
        $frete = $subtotal > 200 ? 0 : ($subtotal >= 52 && $subtotal <= 166.59 ? 15 : 20);

        $pedido = Pedido::create([
            'endereco' => $request->input('endereco'),
            'cep' => $request->input('cep'),
            'subtotal' => $subtotal,
            'frete' => $frete,
            'status' => 'pendente'
        ]);

        
        foreach ($carrinho as $item) {
            ItemPedido::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $item['produto_id'],
                'variacao' => $item['variacao'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco']
            ]);
        }

        
        session()->forget('carrinho');

        return redirect()->route('carrinho.index')->with('success', 'Pedido realizado com sucesso!');
    }
}
