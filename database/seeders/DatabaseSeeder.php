<?php

namespace Database\Seeders;

use App\Models\FormaPagamento;
use App\Models\User;
use App\Models\Venda;
use GuzzleHttp\Client;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ClienteSeeder;
use Database\Seeders\ProdutoSeeder;
use Database\Seeders\FormaPagamentoSeeder;
use Database\Seeders\VendaSeeder;
use Database\Seeders\VendaItemSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ClienteSeeder::class,
            ProdutoSeeder::class,
            FormaPagamentoSeeder::class,
            VendaSeeder::class,
            VendaItemSeeder::class,
        ]);
    }
}
