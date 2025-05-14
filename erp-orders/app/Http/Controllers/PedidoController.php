<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\ItemPedido; 
use App\Models\Cupom;


class PedidoController extends Controller
{
    public function finalizar(Request $request)
    {
        
        $cupom = null;
        if ($request->has('cupom') && !empty($request->cupom)) {
            $cupom = Cupom::where('codigo', $request->cupom)->first();
            
            
            if (!$cupom || $cupom->validade < now()) {
                return redirect()->back()->with('erro', 'Cupom inválido ou expirado.');
            }
        }

        
        $carrinho = session('carrinho');
        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        $frete = 10.00; 
        $total = $subtotal + $frete;

        
        if ($cupom) {
            if ($cupom->tipo_percentual) {
                
                $desconto = ($total * $cupom->desconto) / 100;
            } else {
                
                $desconto = $cupom->desconto;
            }

            $total -= $desconto;
        }

    
        return view('pedido.finalizado', compact('total', 'cupom', 'subtotal', 'frete'));
    }

}
