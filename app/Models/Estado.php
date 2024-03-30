<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    protected $fillable = [
        'estado_nome',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'estado_id';

    use HasFactory;

    public function cidades()
    {
        return $this->hasMany(Cidade::class, 'estado_id', 'estado_id');
    }

    public function enderecos()
    {
        return $this->hasManyThrough(Endereco::class, Cidade::class, 'estado_id', 'cidade_id', 'estado_id', 'cidade_id');
    }

    public function contatos()
    {
        return $this->hasManyThrough(Contato::class, Cidade::class, 'estado_id', 'cidade_id', 'estado_id', 'cidade_id');
    }
}
