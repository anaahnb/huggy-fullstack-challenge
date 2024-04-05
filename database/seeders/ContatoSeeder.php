<?php

namespace Database\Seeders;

use App\Models\Contato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class ContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            $contatoNome = $faker->name;
            $contatoImagem = $this->generateContatoImagem($contatoNome);

            Contato::create([
                'contatos_nome' => $contatoNome,
                'contatos_email' => $faker->unique()->safeEmail,
                'contatos_telefone' => $faker->numerify('(##) #####-####'),
                'contatos_celular' => $faker->numerify('(##) #####-####'), 
                'endereco_id' => 1,
                'contatos_imagem' => $contatoImagem
            ]);
        }
    }

    /**
     * Gerar imagem de contato baseado no nome.
     *
     * @param string $contatoNome
     * @return string
     */
    private function generateContatoImagem(string $contatoNome): string
    {
        $text = explode(" ", $contatoNome);
        $image = isset($text[1]) ? substr($text[0], 0, 1) . substr($text[1], 0, 1) : substr($text[0], 0, 2);
        return $image;
    }
}
