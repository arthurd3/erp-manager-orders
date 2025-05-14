@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cadastrar Produto</h2>
    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" required>
        </div>
        <hr>
        <h4>Variações</h4>
        <div id="variacoes-container">
            <div class="row mb-2">
                <div class="col">
                    <input type="text" name="variacoes[0][nome]" placeholder="Ex: Tamanho M" class="form-control" required>
                </div>
                <div class="col">
                    <input type="number" name="variacoes[0][quantidade]" placeholder="Qtd" class="form-control" required>
                </div>
            </div>
        </div>
        <button type="button" onclick="adicionarVariacao()" class="btn btn-secondary mb-3">Adicionar Variação</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<script>
    let variacaoIndex = 1;
    function adicionarVariacao() {
        const container = document.getElementById('variacoes-container');
        const html = `
        <div class="row mb-2">
            <div class="col">
                <input type="text" name="variacoes[${variacaoIndex}][nome]" class="form-control" required>
            </div>
            <div class="col">
                <input type="number" name="variacoes[${variacaoIndex}][quantidade]" class="form-control" required>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        variacaoIndex++;
    }
</script>
@endsection
