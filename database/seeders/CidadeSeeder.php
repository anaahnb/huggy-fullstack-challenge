<?php

namespace Database\Seeders;

use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cidadesPorEstado = [
            'Bahia' => ['Salvador', 'Feira de Santana', 'Vitória da Conquista'],
            'São Paulo' => ['São Paulo', 'Campinas', 'São José dos Campos'],
            'Rio de Janeiro' => ['Rio de Janeiro', 'Niterói', 'São Gonçalo'],
            'Maranhão' => ['São Luís', 'Santa Inês', 'Bacabal']
        ];

        foreach ($cidadesPorEstado as $estadoNome => $cidades) {
            $estado = Estado::where('estado_nome', $estadoNome)->firstOrFail();

            foreach ($cidades as $cidadeNome) {
                Cidade::create([
                    'estado_id' => $estado->estado_id,
                    'cidade_nome' => $cidadeNome,
                ]);
            }
        }
    }
}
