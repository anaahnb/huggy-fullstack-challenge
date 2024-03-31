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

    for ($i = 0; $i < 5; $i++) {
        Contato::create([
            'contatos_nome' => $faker->name,
            'contatos_email' => $faker->unique()->safeEmail,
            'contatos_telefone' => $faker->numerify('##########'),
            'contatos_celular' => $faker->numerify('##########'), 
            'endereco_id' => 1,
            'contatos_imagem' => $faker->lexify('??')
        ]);
    }
}

}
