@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-6">
    <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">Lista de Cupons</h2>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if($cupons->isEmpty())
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded mb-6">
            <p>Nenhum cupom cadastrado.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
            <table class="table-auto w-full text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Nome</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Código</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Desconto</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Valor Mínimo</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Validade</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cupons as $cupom)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $cupom->nome }}</td>
                        <td class="px-4 py-3">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $cupom->codigo }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-green-600 font-medium">{{ $cupom->desconto }}%</td>
                        <td class="px-4 py-3">R$ {{ number_format($cupom->valor_minimo, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($cupom->validade)->format('d/m/Y') }}
                            @if(\Carbon\Carbon::parse($cupom->validade)->isPast())
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded ml-2">
                                    Expirado
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('cupons.edit', $cupom->id) }}" 
                                   class="text-yellow-600 hover:text-white hover:bg-yellow-600 px-3 py-1 rounded-md border border-yellow-600 transition-colors">
                                    Editar
                                </a>
                                <form action="{{ route('cupons.destroy', $cupom->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-white hover:bg-red-600 px-3 py-1 rounded-md border border-red-600 transition-colors"
                                            onclick="return confirm('Tem certeza que deseja excluir este cupom?')">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-6 text-center">
        <a href="{{ route('cupons.create') }}" 
           class="bg-blue-600 text-white hover:bg-blue-800 px-6 py-3 rounded-md inline-block transition-colors">
            Cadastrar Novo Cupom
        </a>
    </div>
</div>
@endsection