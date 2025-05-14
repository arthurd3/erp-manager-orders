<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['produto_id','nome', 'preco'];

    public function estoques()
    {
        return $this->hasMany(Estoque::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class)->withPivot('quantidade', 'preco');
    }
}

