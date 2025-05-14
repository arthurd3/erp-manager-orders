@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Seu Carrinho</h2>

    @if(session('carrinho') && count(session('carrinho')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Variação</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrinho as $item)
                    <tr>
                        <td>{{ $item['nome'] }}</td>
                        <td>{{ $item['variacao'] }}</td>
                        <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                        <td>{{ $item['quantidade'] }}</td>
                        <td>R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Subtotal:</strong> R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
        <p><strong>Frete:</strong> R$ {{ number_format($frete, 2, ',', '.') }}</p>
        <p><strong>Total:</strong> R$ {{ number_format($total, 2, ',', '.') }}</p>

        <a href="#" class="btn btn-primary">Finalizar Pedido</a>
    @else
        <p>Seu carrinho está vazio.</p>
    @endif

    <form method="POST" action="{{ route('pedido.finalizar') }}">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label>CEP</label>
                <input type="text" name="cep" id="cep" class="form-control" required>
            </div>

            <div class="col-md-8">
                <label>Endereço</label>
                <input type="text" name="endereco" id="endereco" class="form-control" readonly>
            </div>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Finalizar Pedido</button>
    </form>

</div>
@endsection
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
