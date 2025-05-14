@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">Pedido Finalizado</h2>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <p class="text-xl font-semibold text-gray-800"><strong>Subtotal:</strong> R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
        <p class="text-xl font-semibold text-gray-800"><strong>Frete:</strong> R$ {{ number_format($frete, 2, ',', '.') }}</p>

        <!-- Exibir o desconto do cupom, se houver -->
        @if(isset($cupom))
            <p class="text-xl font-semibold text-gray-800">
                <strong>Desconto:</strong> 
                R$ {{ number_format($subtotal * ($cupom->desconto / 100), 2, ',', '.') }}
            </p>
        @endif

        <p class="text-2xl font-bold text-gray-800 mt-4"><strong>Total:</strong> R$ {{ number_format($total, 2, ',', '.') }}</p>

        <!-- Mensagem de sucesso -->
        <div class="mt-6 bg-green-100 text-green-800 p-4 rounded-md">
            Seu pedido foi finalizado com sucesso! Agradecemos pela sua compra.
        </div>

        <!-- Detalhes do cupom -->
        @if(isset($cupom))
            <div class="mt-4">
                <h3 class="text-lg font-semibold text-gray-800">Detalhes do Cupom</h3>
                <p><strong>Código do Cupom:</strong> {{ $cupom->codigo }}</p>
                <p><strong>Desconto Aplicado:</strong> R$ {{ number_format($subtotal * ($cupom->desconto / 100), 2, ',', '.') }}</p>
            </div>
        @endif
    </div>

    <
    <div class="mt-10">
        <h3 class="text-xl font-semibold text-gray-800">Detalhes do Pedido</h3>
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Produto</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Quantidade</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Preço</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('carrinho') as $item)
                    <tr class="border-t border-gray-200">
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $item['nome'] }}</td>
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $item['quantidade'] }}</td>
                        <td class="py-4 px-4 text-sm text-gray-700">R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                        <td class="py-4 px-4 text-sm text-gray-700">R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
