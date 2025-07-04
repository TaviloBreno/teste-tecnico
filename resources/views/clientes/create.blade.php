<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
            {{ __('Novo Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg p-8">

                <!-- Mensagens de erro -->
                @if ($errors->any())
                    <div class="mb-6">
                        <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('clientes.store') }}" class="space-y-6">
                    @csrf

                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                        <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('clientes.index') }}"
                           class="text-sm text-gray-600 hover:text-gray-800 underline transition">← Voltar</a>

                        <button type="submit"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-semibold shadow hover:bg-indigo-700 transition">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
