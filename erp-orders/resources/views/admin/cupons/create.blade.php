@extends('layouts.app')
@section('content')
<form action="{{ route('cupons.store') }}" method="POST">
    @csrf
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Cadastrar Novo Cupom</h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="codigo" class="form-label">Código do Cupom</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Código do cupom" required>
                        </div>

                        <div class="mb-3">
                            <label for="desconto" class="form-label">Desconto</label>
                            <input type="number" step="0.01" name="desconto" id="desconto" class="form-control" placeholder="Desconto" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo_percentual" class="form-label">Tipo de Desconto</label>
                            <select name="tipo_percentual" id="tipo_percentual" class="form-select">
                                <option value="0">Desconto Fixo</option>
                                <option value="1">Desconto Percentual</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="valor_minimo" class="form-label">Valor Mínimo do Carrinho</label>
                            <input type="number" step="0.01" name="valor_minimo" id="valor_minimo" class="form-control" placeholder="Valor mínimo do carrinho">
                        </div>

                        <div class="mb-3">
                            <label for="validade" class="form-label">Data de Validade</label>
                            <input type="date" name="validade" id="validade" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100">Salvar Cupom</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection