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

        // Aqui você pode salvar o pedido no banco (iremos montar isso depois)
        // Exemplo de salvamento básico:
        $subtotal = collect($carrinho)->sum(fn($item) => $item['preco'] * $item['quantidade']);
        $frete = $subtotal > 200 ? 0 : ($subtotal >= 52 && $subtotal <= 166.59 ? 15 : 20);

        $pedido = Pedido::create([
            'endereco' => $request->input('endereco'),
            'cep' => $request->input('cep'),
            'subtotal' => $subtotal,
            'frete' => $frete,
            'status' => 'pendente'
        ]);

        // Salva os itens do pedido (iremos criar essa tabela depois)
        foreach ($carrinho as $item) {
            ItemPedido::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $item['produto_id'],
                'variacao' => $item['variacao'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco']
            ]);
        }

        // Limpa o carrinho
        session()->forget('carrinho');

        return redirect()->route('carrinho.index')->with('success', 'Pedido realizado com sucesso!');
    }
}
