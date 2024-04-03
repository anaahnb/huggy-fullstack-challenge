<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            'Bahia', 'São Paulo', 'Rio de Janeiro', 'Maranhão'
        ];

        foreach ($estados as $estado) {
            Estado::create([
                'estado_nome' => $estado,
            ]);
        }
    }
}
