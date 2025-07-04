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

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('vendasChart').getContext('2d');
        const vendasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Total Vendido (R$)',
                    data: {!! json_encode($valores) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value.toLocaleString('pt-BR');
                            }
                        }
                    }
                }
            }
        });
    </script>
    @endpush

</x-app-layout>
