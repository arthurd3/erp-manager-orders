@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-4">
                    <h2 class="h4 text-center mb-0">Cadastrar Produto</h2>
                </div>
                
                <div class="card-body px-5 py-4">
                    <form action="{{ route('produtos.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-semibold">Nome do Produto</label>
                            <input type="text" id="nome" name="nome" class="form-control form-control-lg" 
                                   placeholder="Digite o nome do produto" required>
                        </div>

                        <div class="mb-4">
                            <label for="preco" class="form-label fw-semibold">Preço</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="number" id="preco" name="preco" step="0.01" 
                                       class="form-control form-control-lg" 
                                       placeholder="0,00" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3 text-center fw-semibold">Variações</h4>
                        <div id="variacoes-container">
                            <div class="row mb-3 g-3">
                                <div class="col-md-6">
                                    <label for="variacao_nome_0" class="form-label">Nome da Variação</label>
                                    <input type="text" id="variacao_nome_0" name="variacoes[0][nome]" 
                                           class="form-control" placeholder="Ex: Tamanho M" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="variacao_qtd_0" class="form-label">Quantidade (Estoque)</label>
                                    <input type="number" id="variacao_qtd_0" name="variacoes[0][quantidade]" 
                                           class="form-control" placeholder="Quantidade disponível" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                            <button type="button" onclick="adicionarVariacao()" 
                                    class="btn btn-outline-primary me-md-2">
                                <i class="bi bi-plus-circle me-2"></i>Adicionar Variação
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                <i class="bi bi-save me-2"></i>Salvar Produto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let variacaoIndex = 1;

    function adicionarVariacao() {
        const container = document.getElementById('variacoes-container');
        const html = `
        <div class="row mb-3 g-3">
            <div class="col-md-6">
                <label for="variacao_nome_${variacaoIndex}" class="form-label">Nome da Variação</label>
                <input type="text" id="variacao_nome_${variacaoIndex}" 
                       name="variacoes[${variacaoIndex}][nome]" class="form-control" 
                       placeholder="Ex: Tamanho M" required>
            </div>
            <div class="col-md-6">
                <label for="variacao_qtd_${variacaoIndex}" class="form-label">Quantidade (Estoque)</label>
                <input type="number" id="variacao_qtd_${variacaoIndex}" 
                       name="variacoes[${variacaoIndex}][quantidade]" class="form-control" 
                       placeholder="Quantidade disponível" required>
            </div>
        </div>`;
        
        container.insertAdjacentHTML('beforeend', html);
        variacaoIndex++;
    }
</script>

<style>
    body {
        background-color: #f8f9fa;
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card-header {
        background-color: #f8f9fa !important;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #ced4da;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .form-control-lg {
        padding: 1rem 1.25rem;
    }
    
    .btn {
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
    }
    
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
    
    .btn-outline-primary {
        color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }
    
    hr {
        opacity: 0.15;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
    }
</style>
@endsection