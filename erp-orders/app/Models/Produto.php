<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco'];

    public function estoques()
    {
        return $this->hasMany(Estoque::class);
    }
}

