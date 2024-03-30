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
            $data['contatos_imagem'] = $image->store('images', 'public');
        } else {

            $text = explode(" ", $request->contatos_nome);
            $image = substr($text[0], 0, 1) . substr($text[1], 0, 1);
            $data['contatos_imagem'] = $image;
            echo $image;

        }

        return $data;
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id', 'endereco_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'endereco_id', 'cidade_id')
                    ->through(Endereco::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'endereco_id', 'estado_id')
                    ->through(Cidade::class);
    }
}
