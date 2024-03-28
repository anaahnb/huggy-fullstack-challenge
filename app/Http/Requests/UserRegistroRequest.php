<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistroRequest extends FormRequest
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
            'name' => ['required', 'string','max:255'],
            'email' => ['required', 'string','email','unique:users,email'],
            'password' => ['required','string','min:6','confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'name.string' => 'O campo Nome é inválido',
            'name.max' => 'O campo Nome é muito grande',

            'email.required' => 'O campo Email é obrigatório',
            'email.string' => 'O campo Email é inválido',
            'email.email' => 'O campo Email não é um email válido',
            'email.unique' => 'O campo Email já está cadastrado em outra conta',

            'password.required' => 'O campo Senha é obrigatório',
            'password.string' => 'O campo Senha é inválido',
            'password.min' => 'A senha precisa ter pelo menos 6 digitos',
            'password.confirmed' => 'As senhas não coincidem',
        ];
        
    }
}
