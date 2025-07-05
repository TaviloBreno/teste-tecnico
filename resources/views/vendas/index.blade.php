<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
            Vendas
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- Botão Nova Venda -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('vendas.create') }}"
                   class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-semibold shadow hover:bg-indigo-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Nova Venda
                </a>
            </div>

            <!-- Tabela de Vendas -->
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Cliente</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Data</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Parcelas</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Forma de Pagamento</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($vendas as $venda)
                            <tr class="hover:bg-indigo-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $venda->cliente->nome }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $venda->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    @if ($venda->parcelas->count() > 0)
                                        {{ $venda->parcelas->count() }} {{ Str::plural('parcela', $venda->parcelas->count()) }}
                                    @else
                                        Sem parcelas
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $venda->formaPagamento->nome }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-right flex gap-2 justify-end">
                                    <a href="{{ route('vendas.show', $venda) }}"
                                       class="inline-flex items-center px-4 py-1.5 bg-blue-600 text-white rounded-md text-sm font-semibold shadow hover:bg-blue-700 transition">
                                        Ver
                                    </a>
                                    <a href="{{ route('vendas.edit', $venda) }}"
                                       class="inline-flex items-center px-4 py-1.5 bg-yellow-500 text-white rounded-md text-sm font-semibold shadow hover:bg-yellow-600 transition">
                                        Editar
                                    </a>
                                    <form action="{{ route('vendas.destroy', $venda) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-4 py-1.5 bg-red-600 text-white rounded-md text-sm font-semibold shadow hover:bg-red-700 transition"
                                                onclick="return confirm('Tem certeza que deseja excluir esta venda?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-sm text-gray-500 text-center">
                                    Nenhuma venda registrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    {{ $vendas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
