<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Estoque;


class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('estoques')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.produtos_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'preco' => 'required|numeric',
            'variacoes' => 'required|array',
            'variacoes.*.nome' => 'required',
            'variacoes.*.quantidade' => 'required|integer'
        ]);

        $produto = Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco
        ]);

        foreach ($request->variacoes as $variacao) {
            Estoque::create([
                'produto_id' => $produto->id,
                'variacao' => $variacao['nome'],
                'quantidade' => $variacao['quantidade']
            ]);
        }

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($id)
    {
        $produto = Produto::with('estoques')->findOrFail($id);
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $produto->update([
            'nome' => $request->nome,
            'preco' => $request->preco
        ]);

        // Atualiza os estoques existentes
        foreach ($request->variacoes as $estoque_id => $data) {
            $estoque = Estoque::find($estoque_id);
            if ($estoque) {
                $estoque->update([
                    'variacao' => $data['nome'],
                    'quantidade' => $data['quantidade']
                ]);
            }
        }

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado!');
    }
}

