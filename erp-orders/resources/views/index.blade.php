<form action="{{ route('carrinho.adicionar') }}" method="POST" class="mb-3">
    @csrf
    <input type="hidden" name="produto_id" value="{{ $produto->id }}">
    <div class="row">
        <div class="col-md-4">
            <select name="variacao" class="form-select" required>
                @foreach ($produto->estoques as $estoque)
                    <option value="{{ $estoque->variacao }}">{{ $estoque->variacao }} ({{ $estoque->quantidade }} disponíveis)</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" name="quantidade" class="form-control" value="1" min="1" required>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-success">Comprar</button>
        </div>
    </div>
</form>
