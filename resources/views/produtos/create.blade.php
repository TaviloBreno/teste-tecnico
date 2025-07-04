<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Novo Produto') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg p-8 space-y-6">

                <form method="POST" action="{{ route('produtos.store') }}">
                    @csrf

                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                        <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                        @error('nome')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preço -->
                    <div>
                        <label for="preco" class="block text-sm font-medium text-gray-700">Preço (R$)</label>
                        <input type="number" step="0.01" name="preco" id="preco" value="{{ old('preco') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                        @error('preco')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Estoque -->
                    <div>
                        <label for="estoque" class="block text-sm font-medium text-gray-700">Quantidade em Estoque</label>
                        <input type="number" name="estoque" id="estoque" value="{{ old('estoque') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                        @error('estoque')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botões -->
                    <div class="flex justify-between mt-6">
                        <a href="{{ route('produtos.index') }}"
                           class="inline-block bg-gray-200 text-gray-700 px-6 py-2 rounded-md text-sm font-semibold hover:bg-gray-300 transition">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-md text-sm font-semibold hover:bg-indigo-700 transition">
                            Salvar Produto
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
