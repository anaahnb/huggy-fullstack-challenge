<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $table = 'contatos';
    protected $fillable = [
        'contatos_nome',
        'endereco_id',
        'contatos_email',
        'contatos_telefone',
        'contatos_celular',
        'contatos_imagem',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'contato_id';

    public static function criarContato($request) {
        return self::create(self::prepararDados($request));
    }

    public static function atualizarContato($request) {
        return self::update(self::prepararDados($request));
    }

    private static function prepararDados($request) {
        $data = $request->only([
            'contatos_nome',
            'endereco_id',
            'contatos_email',
            'contatos_telefone',
            'contatos_celular',
        ]);

        if ($request->hasFile('contatos_imagem')) {
            $image = $request->file('contatos_imagem');
            $data['contatos_imagem'] = $image->store('imagens', 'public');
        }

        return $data;
    }
}
