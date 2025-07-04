<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Cliente
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6">

                <form method="POST" action="{{ route('clientes.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Nome</label>
                        <input type="text" name="nome" value="{{ old('nome') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm @error('nome') border-red-500 @enderror">
                        @error('nome')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror">
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Telefone</label>
                        <input type="text" name="telefone" value="{{ old('telefone') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm @error('telefone') border-red-500 @enderror">
                        @error('telefone')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('clientes.index') }}"
                            class="text-sm text-gray-600 hover:underline">Cancelar</a>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">
                            Salvar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
