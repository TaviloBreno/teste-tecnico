<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produto::insert([
            [
                'nome' => 'Teclado Gamer RGB',
                'preco' => 199.90,
                'estoque' => 15,
            ],
            [
                'nome' => 'Mouse Sem Fio Logitech',
                'preco' => 149.50,
                'estoque' => 30,
            ],
            [
                'nome' => 'Monitor 24" LED',
                'preco' => 899.00,
                'estoque' => 10,
            ],
        ]);
    }
}
