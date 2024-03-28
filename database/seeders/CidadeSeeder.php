<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cidade::create([
            'estado_id' => 1,
            'cidade_nome' => 'São Luis'
        ]);
    }
}
