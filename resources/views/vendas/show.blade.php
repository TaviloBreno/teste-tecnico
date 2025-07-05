<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
            Detalhes da Venda
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg p-8 space-y-6">

                <div class="text-sm text-gray-700">
                    <p><strong>Cliente:</strong> {{ $venda->cliente->nome ?? 'N/A' }}</p>
                    <p><strong>Data:</strong> {{ $venda->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Total:</strong> R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</p>
                </div>

                <hr class="my-4">

                <h3 class="text-lg font-bold text-gray-900 mb-2">Itens Vendidos</h3>
                <ul class="space-y-2">
                    @foreach ($venda->itens as $item)
                        <li class="flex justify-between text-sm text-gray-800 border-b pb-1">
                            <span>{{ $item->produto->nome }} (x{{ $item->quantidade }})</span>
                            <span>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>

                <hr class="my-4">

                <h3 class="text-lg font-bold text-gray-900 mb-2">Parcelas</h3>
                @if($venda->parcelas->count())
                    <ul class="space-y-2">
                        @foreach ($venda->parcelas as $index => $parcela)
                            <li class="flex justify-between text-sm text-gray-800 border-b pb-1">
                                <span>
                                    {{ ($index + 1) }}ª Parcela - Vencimento: {{ \Carbon\Carbon::parse($parcela->vencimento)->format('d/m/Y') }}
                                </span>
                                <span>Valor: R$ {{ number_format($parcela->valor, 2, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-500">Esta venda não possui parcelas registradas.</p>
                @endif

                <div class="mt-6">
                    <a href="{{ route('vendas.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md text-sm font-medium transition">
                        Voltar
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
