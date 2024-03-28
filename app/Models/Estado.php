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
}
