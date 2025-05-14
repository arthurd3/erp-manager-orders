<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\ItemPedido; 

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
        $total = $subtotal + $frete; 

       $pedido = Pedido::create([
            'endereco' => $request->input('endereco'),
            'cep' => $request->input('cep'),
            'subtotal' => $subtotal,
            'frete' => $frete,
            'total' => $total,
            'status' => 'pendente',
        ]);

    
        foreach ($carrinho as $item) {
            $pedido->produtos()->attach($item['produto_id'], [
                'quantidade' => $item['quantidade'],
                'preco' => $item['preco']
            ]);
        }

        session()->forget('carrinho');
        return redirect()->route('carrinho.index')->with('success', 'Pedido realizado com sucesso!');
    }
}
