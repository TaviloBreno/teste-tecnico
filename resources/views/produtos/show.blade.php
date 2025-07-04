<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Detalhes do Produto') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg p-8 space-y-6">

                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800">Informações do Produto</h3>

                    <!-- Nome -->
                    <div>
                        <span class="text-sm font-medium text-gray-600">Nome:</span>
                        <p class="text-base text-gray-900">{{ $produto->nome }}</p>
                    </div>

                    <!-- Preço -->
                    <div>
                        <span class="text-sm font-medium text-gray-600">Preço:</span>
                        <p class="text-base text-gray-900">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </p>
                    </div>

                    <!-- Estoque -->
                    <div>
                        <span class="text-sm font-medium text-gray-600">Estoque:</span>
                        <p class="text-base text-gray-900">{{ $produto->estoque }}</p>
                    </div>

                    <!-- Criado em -->
                    <div>
                        <span class="text-sm font-medium text-gray-600">Cadastrado em:</span>
                        <p class="text-base text-gray-900">
                            {{ $produto->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>

                <!-- Botões -->
                <div class="flex justify-between pt-6">
                    <a href="{{ route('produtos.index') }}"
                       class="inline-block bg-gray-200 text-gray-700 px-6 py-2 rounded-md text-sm font-semibold hover:bg-gray-300 transition">
                        Voltar
                    </a>

                    <a href="{{ route('produtos.edit', $produto) }}"
                       class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-md text-sm font-semibold hover:bg-indigo-700 transition">
                        Editar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
