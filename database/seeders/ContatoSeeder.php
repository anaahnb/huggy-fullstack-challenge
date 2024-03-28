<?php

namespace Database\Seeders;

use App\Models\Contato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contato::create([
            'contatos_nome' => 'Ana Julia',
            'contatos_email' => 'ana@email.com',
            'contatos_telefone' => '9899119229',
            'contatos_celular' => '32334841',
            'endereco_id' => 1,
            'contatos_imagem' => 'imagem',
        ]);
    }
}
