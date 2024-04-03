<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contatos_nome' => ['required', 'string', 'max:255'],
            'contatos_email' => ['required', 'string', 'email', 'unique:contatos,contatos_email'],
            'contatos_telefone' => ['required','unique:contatos,contatos_telefone'],
            'contatos_celular' => ['required'],
            'contatos_imagem' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],            
            'cidade_id' => ['required', 'numeric'], 
            'endereco_bairro' => ['required', 'string', 'max:255'], 
            'endereco_rua' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'contatos_nome.required' => 'O campo Nome é obrigatório',
            'contatos_nome.string' => 'O campo Nome é inválido',
            'contatos_nome.max' => 'O campo Nome é muito grande',

            'contatos_email.required' => 'O campo Email é obrigatório',
            'contatos_email.string' => 'O campo Email é inválido',
            'contatos_email.email' => 'O campo Email não é um email válido',
            'contatos_email.unique' => 'O campo Email já está cadastrado em outra conta',

            'contatos_telefone.required' => 'O campo Telefone é obrigatório',
            'contatos_telefone.unique' => 'O campo Telefone já está cadastrado em outra conta',

            'contatos_celular.required' => 'O campo Celular é obrigatório',


            'contatos_imagem.image' => 'O arquivo enviado precisa ser uma imagem',
            'contatos_imagem.mimes' => 'O campo imgem suporta apenas os formatos jpg, png e jpeg',


            'cidade_id.required' => 'O campo Cidade é obrigatório',
            'cidade_id.numeric' => 'O campo Cidade é inválido', 

            'endereco_bairro.required' => 'O campo Bairro é obrigatório',
            'endereco_bairro.string' => 'O campo Bairro é inválido',
            'endereco_bairro.max' => 'O campo Bairro é muito grande',

            'endereco_rua.required' => 'O campo Endereço é obrigatório',
            'endereco_rua.string' => 'O campo Endereço é inválido',
            'endereco_rua.max' => 'O campo Endereço é muito grande',
        ];
    }
}
