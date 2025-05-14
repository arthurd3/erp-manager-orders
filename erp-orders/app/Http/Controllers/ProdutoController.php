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
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required',
            'preco' => 'required|numeric',
            'variacoes' => 'required|array',
            'variacoes.*.nome' => 'required',
            'variacoes.*.quantidade' => 'required|integer'
        ]);

        // Criação do produto
        $produto = Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco
        ]);

        // Criação do estoque para as variações
        foreach ($request->variacoes as $variacao) {
            Estoque::create([
                'produto_id' => $produto->id,
                'variacao' => $variacao['nome'],
                'quantidade' => $variacao['quantidade']
            ]);
        }

        // Adicionar produto ao carrinho (usando o ID do produto)
        $carrinho = session()->get('carrinho', []);
        $carrinho[] = [
            'id' => $produto->id,
            'nome' => $produto->nome,
            'preco' => $produto->preco,
            'quantidade' => 1, // A quantidade inicial do produto no carrinho
        ];

        session()->put('carrinho', $carrinho);

        // Redirecionar para o carrinho
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso e adicionado ao carrinho!');
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