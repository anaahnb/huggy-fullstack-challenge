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

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id', 'endereco_id');
    }

    public static function criarContatoComEndereco($request)
    {
        $endereco = Endereco::firstOrCreate([
            'cidade_id' => $request->cidade_id,
            'endereco_bairro' => $request->endereco_bairro,
            'endereco_rua' => $request->endereco_rua,
        ]);

        $data = self::prepararDados($request);
        $data['endereco_id'] = $endereco->endereco_id; 
        return self::create($data);
    }

    private static function prepararDados($request)
    {
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
            $image = isset($text[1]) ? substr($text[0], 0, 1) . substr($text[1], 0, 1) : substr($text[0], 0, 2);
            $data['contatos_imagem'] = $image;
        }

        return $data;
    }

}
