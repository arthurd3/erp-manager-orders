@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-6">
    <h2 class="text-3xl font-semibold text-center mb-6">Lista de Produtos</h2>
    
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
        <table class="table-auto w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-600">Nome</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-600">Preço</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-600">Descrição</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-600">Quantidade</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-600">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $produto->nome }}</td>
                    <td class="px-4 py-2">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ $produto->descricao }}</td>
                    <td class="px-4 py-2">{{ $produto->quantidade }}</td>
                    <td class="px-4 py-2 space-y-2">
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="inline-block btn btn-warning text-yellow-600 hover:text-white bg-yellow-100 hover:bg-yellow-600 px-4 py-2 rounded-md">Editar</a>
                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white hover:bg-red-700 px-4 py-2 rounded-md">Excluir</button>
                        </form>
                        <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white hover:bg-green-700 px-4 py-2 rounded-md">Adicionar ao Carrinho</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('produtos.create') }}" class="btn btn-primary bg-blue-600 text-white hover:bg-blue-800 px-6 py-3 rounded-md">Cadastrar Novo Produto</a>
    </div>
</div>
@endsection
