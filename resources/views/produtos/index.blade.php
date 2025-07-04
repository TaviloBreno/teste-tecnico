<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- Mensagem de sucesso -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-6 py-3 rounded-lg shadow text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filtro e Botão Novo Produto -->
            <div class="flex flex-row items-center justify-between gap-4 mb-6">
                <form method="GET" class="flex flex-row flex-1 max-w-md">
                    <input type="text" name="busca" value="{{ $busca ?? '' }}" placeholder="Buscar produto..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                    <button type="submit"
                        class="ml-2 bg-indigo-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 shadow transition">
                        Buscar
                    </button>
                </form>

                <a href="{{ route('produtos.create') }}"
                    class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-semibold shadow hover:bg-indigo-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Novo Produto
                </a>
            </div>

            <!-- Tabela de Produtos -->
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Preço</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Estoque</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($produtos as $produto)
                            <tr class="hover:bg-indigo-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $produto->nome }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $produto->estoque }}</td>
                                <td class="px-6 py-4 text-sm text-right">
                                    <div class="flex justify-end items-center gap-3">
                                        <a href="{{ route('produtos.edit', $produto) }}"
                                            class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                            ✏️ Editar
                                        </a>

                                        <form action="{{ route('produtos.destroy', $produto) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 text-sm font-semibold">
                                                🗑️ Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-sm text-gray-500 text-center">
                                    Nenhum produto encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    {{ $produtos->appends(['busca' => $busca ?? ''])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
