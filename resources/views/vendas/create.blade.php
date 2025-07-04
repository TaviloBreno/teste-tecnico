<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
            Nova Venda
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg p-8 space-y-8">

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded text-sm">
                        <strong>Erro:</strong> Corrija os campos abaixo:
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('vendas.store') }}">
                    @csrf

                    <!-- Cliente -->
                    <div>
                        <label for="cliente_id" class="block text-sm font-medium text-gray-700 mb-1">Cliente <span class="text-red-500">*</span></label>
                        <select name="cliente_id" id="cliente_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            required>
                            <option value="">Selecione um cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Produtos e Quantidade -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Produtos <span class="text-red-500">*</span></label>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-2 text-left font-semibold text-gray-700">Selecionar</th>
                                        <th class="px-2 py-2 text-left font-semibold text-gray-700">Produto</th>
                                        <th class="px-2 py-2 text-left font-semibold text-gray-700">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produtos as $produto)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-2 py-2">
                                                <input type="checkbox" name="produtos[{{ $produto->id }}][selecionado]" value="1"
                                                    class="rounded text-indigo-600 focus:ring-indigo-500"
                                                    {{ old("produtos.{$produto->id}.selecionado") ? 'checked' : '' }}>
                                            </td>
                                            <td class="px-2 py-2 text-gray-800">{{ $produto->nome }}</td>
                                            <td class="px-2 py-2">
                                                <input type="number" name="produtos[{{ $produto->id }}][quantidade]"
                                                    class="w-24 border rounded px-2 py-1 text-sm"
                                                    placeholder="Qtd" min="1"
                                                    value="{{ old("produtos.{$produto->id}.quantidade") }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <span class="text-xs text-gray-500 mt-1 block">Selecione ao menos um produto e informe a quantidade.</span>
                    </div>

                    <!-- Botões -->
                    <div class="flex justify-end gap-3 mt-8">
                        <a href="{{ route('vendas.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md text-sm font-medium transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-semibold transition">
                            Finalizar Venda
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
