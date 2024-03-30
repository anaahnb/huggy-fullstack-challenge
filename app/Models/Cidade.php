<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{

    protected $table = 'cidades';

    protected $fillable = [
        'estado_id',
        'cidade_nome',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'cidade_id';

    use HasFactory;

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'estado_id');
    }

    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'cidade_id', 'cidade_id');
    }

    public function contatos()
    {
        return $this->hasManyThrough(Contato::class, Endereco::class, 'cidade_id', 'endereco_id', 'cidade_id', 'endereco_id');
    }
}
