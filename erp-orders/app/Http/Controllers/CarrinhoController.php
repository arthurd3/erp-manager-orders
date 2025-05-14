<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Estoque;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);
        $subtotal = $this->calcularSubtotal($carrinho);
        $frete = $this->calcularFrete($subtotal);
        $total = $subtotal + $frete;

        return view('carrinho.index', compact('carrinho', 'subtotal', 'frete', 'total'));
    }

    public function adicionar(Request $request)
    {
        $produto_id = $request->input('produto_id');
        $variacao = $request->input('variacao');
        $quantidade = (int)$request->input('quantidade');

        $produto = Produto::findOrFail($produto_id);
        $estoque = Estoque::where('produto_id', $produto_id)->where('variacao', $variacao)->first();

        if (!$estoque || $estoque->quantidade < $quantidade) {
            return back()->with('error', 'Estoque insuficiente');
        }

        
        $carrinho = session()->get('carrinho', []);

        $key = $produto_id . '-' . $variacao;

        if (isset($carrinho[$key])) {
            $carrinho[$key]['quantidade'] += $quantidade;
        } else {
            $carrinho[$key] = [
                'produto_id' => $produto_id,
                'nome' => $produto->nome,
                'variacao' => $variacao,
                'preco' => $produto->preco,
                'quantidade' => $quantidade
            ];
        }

        session()->put('carrinho', $carrinho);

        return redirect()->route('carrinho.index')->with('success', 'Produto adicionado ao carrinho');
    }

    private function calcularSubtotal($carrinho)
    {
        return collect($carrinho)->reduce(function ($total, $item) {
            return $total + ($item['preco'] * $item['quantidade']);
        }, 0);
    }

    private function calcularFrete($subtotal)
    {
        if ($subtotal > 200) {
            return 0;
        } elseif ($subtotal >= 52 && $subtotal <= 166.59) {
            return 15;
        } else {
            return 20;
        }
    }

    public function atualizar(Request $request, $index)
    {
        $carrinho = session()->get('carrinho', []);
        
        if (isset($carrinho[$index])) {
            $carrinho[$index]['quantidade'] = $request->quantidade;
        }
        
        session()->put('carrinho', $carrinho);

        return redirect()->route('carrinho.index');
    }

    public function remover($index)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$index])) {
            unset($carrinho[$index]);
        }

        session()->put('carrinho', array_values($carrinho));

        return redirect()->route('carrinho.index');
    }

}

