@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-6 max-w-2xl bg-white shadow-md rounded-md">
    <h2 class="text-2xl font-bold mb-6">Editar Produto</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nome" class="block text-gray-700 font-medium mb-1">Nome</label>
            <input type="text" name="nome" value="{{ old('nome', $produto->nome) }}">
        </div>

        <div class="mb-4">
            <label for="preco" class="block text-gray-700 font-medium mb-1">Preço</label>
            <input type="number" name="preco" value="{{ old('preco', $produto->preco) }}">
        </div>

        <div class="mb-4">
            <label for="descricao" class="block text-gray-700 font-medium mb-1">Descrição</label>
            <textarea name="descricao" id="descricao" rows="4" class="w-full border border-gray-300 p-2 rounded-md">{{ old('descricao', $produto->descricao) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="variacao" class="block text-gray-700 font-medium mb-1">Variações</label>
            @foreach ($estoques as $estoque)
                <div class="flex items-center">
                    <input type="text" name="variacoes[{{ $estoque->id }}][nome]" value="{{ old('variacoes.' . $estoque->id . '.nome', $estoque->variacao) }}" class="mr-2">
                    <input type="number" name="variacoes[{{ $estoque->id }}][quantidade]" value="{{ old('variacoes.' . $estoque->id . '.quantidade', $estoque->quantidade) }}">
                </div>
            @endforeach
        </div>

        <div class="flex justify-between">
            <a href="{{ route('produtos.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Voltar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded">Atualizar</button>
        </div>
    </form>
</div>
@endsection
