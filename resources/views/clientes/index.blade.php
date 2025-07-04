<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Filtro e botão -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <form method="GET" class="flex space-x-2 w-full sm:w-auto">
                    <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar cliente..."
                           class="border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 text-sm px-4 py-2 w-full sm:w-72 transition">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-5 py-2 rounded-lg shadow hover:bg-indigo-700 text-sm font-semibold transition">
                        Buscar
                    </button>
                </form>
                <a href="{{ route('clientes.create') }}"
                   class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 text-sm font-semibold transition">
                    + Novo Cliente
                </a>
            </div>

            <!-- Tabela -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-100 to-indigo-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Telefone</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($clientes as $cliente)
                            <tr class="hover:bg-indigo-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $cliente->nome }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $cliente->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $cliente->telefone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                    <a href="{{ route('clientes.edit', $cliente) }}"
                                       class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded hover:bg-blue-200 font-semibold transition text-xs shadow">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-sm text-gray-500 text-center">Nenhum cliente encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    {{ $clientes->appends(['busca' => $busca])->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
