<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos'; 

    protected $fillable = [
        'endereco', 'cep', 'subtotal', 'frete', 'status', 'total' 
    ];

    public $timestamps = true;

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'pedido_produto', 'pedido_id', 'produto_id')
                    ->withPivot('quantidade', 'preco'); // Adicionando campos adicionais se necessário
    }

    

}


