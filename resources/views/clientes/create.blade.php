<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
            {{ __('Novo Cliente') }}
        </h2>
    </x-slot>

    <div class="py-16 bg-gradient-to-br from-indigo-50 via-white to-indigo-100 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8"> <!-- Alterado de max-w-4xl para max-w-6xl -->
            <div class="bg-white shadow-2xl rounded-2xl p-10 border border-indigo-100">

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

                <form method="POST" action="{{ route('clientes.store') }}" class="space-y-8">
                    @csrf

                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-semibold text-indigo-700 mb-1">Nome</label>
                        <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                               class="mt-1 block w-full rounded-lg border border-indigo-200 shadow focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 text-base px-4 py-2 transition duration-150 ease-in-out bg-indigo-50">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-indigo-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="mt-1 block w-full rounded-lg border border-indigo-200 shadow focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 text-base px-4 py-2 transition duration-150 ease-in-out bg-indigo-50">
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label for="telefone" class="block text-sm font-semibold text-indigo-700 mb-1">Telefone</label>
                        <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                               class="mt-1 block w-full rounded-lg border border-indigo-200 shadow focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 text-base px-4 py-2 transition duration-150 ease-in-out bg-indigo-50">
                    </div>

                    <!-- Ações -->
                    <div class="flex justify-between items-center pt-6">
                        <a href="{{ route('clientes.index') }}"
                           class="text-sm text-indigo-500 hover:text-indigo-700 underline transition font-medium">← Voltar</a>

                        <button type="submit"
                                class="bg-gradient-to-r from-indigo-500 to-indigo-700 text-white px-8 py-2 rounded-lg text-base font-bold shadow-lg hover:from-indigo-600 hover:to-indigo-800 transition duration-150 ease-in-out">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
