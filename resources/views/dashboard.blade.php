<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- Cards de Resumo -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-sm text-gray-500">Clientes</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $totalClientes }}</p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-sm text-gray-500">Produtos</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $totalProdutos }}</p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-sm text-gray-500">Vendas</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $totalVendas }}</p>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-sm text-gray-500">Valor Total Vendido</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        R$ {{ number_format($valorTotalVendas, 2, ',', '.') }}
                    </p>
                </div>
            </div>

            <!-- Gráfico de Desempenho de Vendas -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Vendas nos últimos 6 meses</h3>
                <div class="overflow-x-auto">
                    <canvas id="vendasChart" height="120"></canvas>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('vendasChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($labels) !!},
                        datasets: [{
                            label: 'Total Vendido (R$)',
                            data: {!! json_encode($valores) !!},
                            backgroundColor: 'rgba(59, 130, 246, 0.6)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Desempenho de Vendas nos Últimos 6 Meses',
                                font: {
                                    size: 16
                                }
                            }
                        },
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
            });
        </script>
    @endpush
</x-app-layout>
