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
}
