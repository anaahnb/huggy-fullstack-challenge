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
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'endereco_id';
    
    use HasFactory;
}
