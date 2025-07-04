<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

                <!-- Card: Clientes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm text-gray-500">Clientes</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $totalClientes }}</p>
                </div>

                <!-- Card: Produtos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm text-gray-500">Produtos</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $totalProdutos }}</p>
                </div>

                <!-- Card: Vendas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm text-gray-500">Vendas</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $totalVendas }}</p>
                </div>

                <!-- Card: Valor Total Vendido -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-sm text-gray-500">Valor Total Vendido</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        R$ {{ number_format($valorTotalVendas, 2, ',', '.') }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
