@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">Seu Carrinho</h2>

    @if(session('carrinho') && count(session('carrinho')) > 0)
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Produto</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Variação</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Preço</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Quantidade</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Subtotal</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('carrinho') as $index => $item)
                    <tr class="border-t border-gray-200">
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $item['nome'] }}</td>
                        <td class="py-4 px-4 text-sm text-gray-700">{{ $item['variacao'] ?? 'N/A' }}</td>
                        <td class="py-4 px-4 text-sm text-gray-700">R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                        <td class="py-4 px-4">
                            <form method="POST" action="{{ route('carrinho.atualizar', ['index' => $index]) }}">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantidade" value="{{ $item['quantidade'] }}" class="form-input w-16 py-1 px-2 border rounded-md" min="1" required>
                                <button type="submit" class="btn btn-sm btn-primary mt-2 bg-blue-500 text-white py-1 px-4 rounded-md hover:bg-blue-600">Atualizar</button>
                            </form>
                        </td>
                        <td class="py-4 px-4 text-sm text-gray-700">R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</td>
                        <td class="py-4 px-4">
                            <form method="POST" action="{{ route('carrinho.remover', ['index' => $index]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger bg-red-500 text-white py-1 px-4 rounded-md hover:bg-red-600">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            <p class="text-xl font-semibold text-gray-800"><strong>Subtotal:</strong> R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
            <p class="text-xl font-semibold text-gray-800"><strong>Frete:</strong> R$ {{ number_format($frete, 2, ',', '.') }}</p>
            <p class="text-xl font-semibold text-gray-800"><strong>Total:</strong> R$ {{ number_format($total, 2, ',', '.') }}</p>
        </div>

        <div class="mt-6 flex justify-center">
            <a href="#" class="btn btn-primary bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600">Finalizar Pedido</a>
        </div>
    @else
        <p class="text-center text-gray-600">Seu carrinho está vazio.</p>
    @endif

    @if(session('carrinho') && count(session('carrinho')) > 0)
        <form method="POST" action="{{ route('pedido.finalizar') }}" class="mt-8">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <div class="col-span-1">
                    <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                    <input type="text" name="cep" id="cep" class="form-input w-full py-2 px-4 border rounded-md" required>
                </div>
                <div class="col-span-1">
                    <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                    <input type="text" name="endereco" id="endereco" class="form-input w-full py-2 px-4 border rounded-md" readonly>
                </div>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="btn btn-success bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700">Finalizar Pedido</button>
            </div>
        </form>
    @endif
</div>

<script>
    document.getElementById('cep').addEventListener('blur', function () {
        let cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert("CEP inválido.");
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert("CEP não encontrado.");
                } else {
                    const endereco = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                    document.getElementById('endereco').value = endereco;
                }
            })
            .catch(() => alert("Erro ao buscar o CEP"));
    });
</script>
@endsection
