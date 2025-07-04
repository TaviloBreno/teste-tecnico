<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Relatório de Vendas
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Botões de exportação -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('relatorios.vendas.pdf') }}"
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    Exportar PDF
                </a>

                <a href="{{ route('relatorios.vendas.csv') }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    Exportar CSV
                </a>
            </div>

            <!-- Tabela -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Forma Pagamento</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Data</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase">Valor Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($vendas as $venda)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $venda->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $venda->cliente->nome ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $venda->formaPagamento->nome ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $venda->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-right text-gray-800">
                                    R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-sm text-gray-500">
                                    Nenhuma venda encontrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    {{ $vendas->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
