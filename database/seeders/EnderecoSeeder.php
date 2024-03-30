<?php

namespace Database\Seeders;

use App\Models\Endereco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Endereco::create([
            'cidade_id' => 1,
            'endereco_bairro' => 'São João',
            'endereco_rua' => 'Rua Doutor Elpidio Nova, 1109',

        ]);
    }
}
