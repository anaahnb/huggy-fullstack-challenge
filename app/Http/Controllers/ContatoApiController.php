<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContatoApiController extends Controller
{
    public function __construct(Contato $contato_id)
    {
        $this->contato = $contato_id;
    }

    public function index()
    {
        $contatos = $this->contato->with('endereco.cidade.estado')->paginate(7);

        return response()->json($contatos, 200);
    }

    public function show($contato_id)
    {
        $contato = $this->contato->with('endereco.cidade.estado')->find($contato_id);
        if($contato === null) {
            return response()->json(['ERRO' => 'Recurso pesquisado não existe.'], 404);
        }

        return response()->json($contato, 200);
    }

    public function store(ContactRequest $request)
    {
        $contato = Contato::criarContatoComEndereco($request);
        return response()->json($contato, 201);
    }

    public function update(Request $request, $contato_id)
    {
        $contato = $this->contato->find($contato_id);

        if($contato === null) {
            return response()->json(['ERRO' => 'Impossível realizar a atualização. O recurso solicitado não existe.'], 404);
        }

        if($request->method() === 'PATCH') {
            if($request->file('contatos_imagem')) {
                Storage::disk('public')->delete($contato->contatos_imagem);
            }
            $contato->atualizarContato($request);
        } else {
            if($request->file('contatos_imagem')) {
                Storage::disk('public')->delete($contato->contatos_imagem);
            }
            $contato->atualizarContato($request);
        }

        return response()->json($contato, 200);
    }

    public function destroy($contato_id)
    {
        $contato = $this->contato->find($contato_id);

        if ($contato_id === null) {
            return response()->json(['ERRO' => 'Impossível realizar a exclusão. O recurso solicitado não existe.'], 404);
        }

        Storage::disk('public')->delete($contato->contatos_imagem);


        $contato->delete();
        return response()->json(['msg' => 'O contato foi removido com sucesso!'], 200);
    }
}
