@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Lista de Cupons</h2>
        <a href="{{ route('cupons.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Novo Cupom
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cupons->isEmpty())
        <div class="alert alert-info">Nenhum cupom cadastrado.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Código</th>
                        <th>Desconto (%)</th>
                        <th>Valor Mínimo (R$)</th>
                        <th>Validade</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cupons as $cupom)
                        <tr>
                            <td>{{ $cupom->nome }}</td>
                            <td>{{ $cupom->codigo }}</td>
                            <td>{{ $cupom->desconto }}</td>
                            <td>R$ {{ number_format($cupom->valor_minimo, 2, ',', '.') }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($cupom->validade)->format('d/m/Y') }}
                                @if(\Carbon\Carbon::parse($cupom->validade)->isPast())
                                    <span class="badge bg-danger ms-2">Expirado</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('cupons.edit', $cupom->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('cupons.destroy', $cupom->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este cupom?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
