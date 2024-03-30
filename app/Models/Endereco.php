<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    protected $fillable = [
        'cidade_id',
        'endereco_bairro',
        'endereco_rua',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'endereco_id';
    
    use HasFactory;

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id', 'cidade_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'cidade_id', 'estado_id')
                    ->through(Cidade::class);
    }

    public function contatos()
    {
        return $this->hasMany(Contato::class, 'endereco_id', 'endereco_id');
    }
}
