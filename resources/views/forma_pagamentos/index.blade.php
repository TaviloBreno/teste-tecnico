<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
            Formas de Pagamento
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- Botão Nova Forma de Pagamento -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('forma-pagamentos.create') }}"
                   class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-semibold shadow hover:bg-indigo-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Nova Forma
                </a>
            </div>

            <!-- Tabela -->
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($formasPagamento as $forma)
                            <tr class="hover:bg-indigo-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $forma->nome }}</td>
                                <td class="px-6 py-4 text-sm text-right">
                                    <a href="{{ route('formas_pagamento.edit', $forma) }}"
                                       class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Editar</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-6 text-sm text-gray-500 text-center">
                                    Nenhuma forma de pagamento cadastrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    {{ $formasPagamento->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
