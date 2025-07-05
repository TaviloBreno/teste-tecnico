<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
            Editar Venda #{{ $venda->id }}
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

                <form method="POST" action="{{ route('vendas.update', $venda) }}">
                    @csrf
                    @method('PUT')

                    <!-- Cliente -->
                    <div>
                        <label for="cliente_id" class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                        <select name="cliente_id" id="cliente_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="">Selecione um cliente (opcional)</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}"
                                    {{ (old('cliente_id') ?? $venda->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data da Venda -->
                    <div>
                        <label for="data" class="block text-sm font-medium text-gray-700 mb-1">Data da Venda <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="data" id="data"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            value="{{ old('data', $venda->data?->format('Y-m-d')) }}" required>
                    </div>

                    <!-- Forma de Pagamento -->
                    <div>
                        <label for="forma_pagamento_id" class="block text-sm font-medium text-gray-700 mb-1">Forma de
                            Pagamento <span class="text-red-500">*</span></label>
                        <select name="forma_pagamento_id" id="forma_pagamento_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            required>
                            <option value="">Selecione uma forma de pagamento</option>
                            @foreach ($formasPagamento as $forma)
                                <option value="{{ $forma->id }}"
                                    {{ (old('forma_pagamento_id') ?? $venda->forma_pagamento_id) == $forma->id ? 'selected' : '' }}>
                                    {{ $forma->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Número de Parcelas -->
                    <div>
                        <label for="quantidade_parcelas" class="block text-sm font-medium text-gray-700 mb-1">Número de Parcelas
                            <span class="text-red-500">*</span></label>
                        <input type="number" name="quantidade_parcelas" id="quantidade_parcelas"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            value="{{ old('quantidade_parcelas', $venda->parcelas->count()) }}" min="1" max="60"
                            required>
                    </div>

                    <!-- Produtos e Quantidade -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Produtos <span
                                class="text-red-500">*</span></label>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-2 text-left font-semibold text-gray-700">Selecionar</th>
                                        <th class="px-2 py-2 text-left font-semibold text-gray-700">Produto</th>
                                        <th class="px-2 py-2 text-left font-semibold text-gray-700">Preço</th>
                                        <th class="px-2 py-2 text-left font-semibold text-gray-700">Estoque</th>
                                        <th class="px-2 py-2 text-left font-semibold text-gray-700">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produtos as $index => $produto)
                                        @php
                                            $itemVenda = $venda->itens->firstWhere('produto_id', $produto->id);
                                            $quantidadeAtual = $itemVenda ? $itemVenda->quantidade : 0;
                                            $selecionado = $quantidadeAtual > 0;
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-2 py-2">
                                                <input type="checkbox" name="produtos_selecionados[]"
                                                    value="{{ $produto->id }}"
                                                    class="rounded text-indigo-600 focus:ring-indigo-500"
                                                    data-preco="{{ $produto->preco }}"
                                                    {{ $selecionado ? 'checked' : '' }}
                                                    onchange="toggleProduto({{ $index }}, {{ $produto->id }})">
                                            </td>
                                            <td class="px-2 py-2 text-gray-800">{{ $produto->nome }}</td>
                                            <td class="px-2 py-2 text-gray-600">R$
                                                {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                            <td class="px-2 py-2 text-gray-600">
                                                {{ $produto->estoque + $quantidadeAtual }}</td>
                                            <td class="px-2 py-2">
                                                <input type="number" name="itens[{{ $index }}][quantidade]"
                                                    class="w-24 border rounded px-2 py-1 text-sm" placeholder="Qtd"
                                                    min="1" max="{{ $produto->estoque + $quantidadeAtual }}"
                                                    value="{{ $quantidadeAtual > 0 ? $quantidadeAtual : '' }}"
                                                    {{ $selecionado ? '' : 'disabled' }}
                                                    id="quantidade_{{ $index }}">
                                                <input type="hidden" name="itens[{{ $index }}][produto_id]"
                                                    value="{{ $produto->id }}"
                                                    id="produto_id_{{ $index }}"
                                                    {{ $selecionado ? '' : 'disabled' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <span class="text-xs text-gray-500 mt-1 block">Selecione ao menos um produto e informe a
                            quantidade.</span>
                    </div>

                    <!-- Parcelas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Parcelas <span
                                class="text-red-500">*</span></label>

                        <div id="parcelas-container" class="space-y-2">
                            @php
                                $total = $venda->total;
                                $parcelas = $venda->parcelas->sortBy('vencimento')->values();
                            @endphp

                            @foreach ($parcelas as $index => $parcela)
                                <div class="flex items-center gap-4">
                                    <div class="w-1/2">
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Valor da Parcela
                                            #{{ $index + 1 }}</label>
                                        <input type="number" step="0.01"
                                            name="parcelas[{{ $index }}][valor]"
                                            class="w-full border rounded px-2 py-1 text-sm valor-parcela"
                                            value="{{ number_format($parcela->valor, 2, '.', '') }}"
                                            required>
                                    </div>
                                    <div class="w-1/2">
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Vencimento</label>
                                        <input type="date" name="parcelas[{{ $index }}][vencimento]"
                                            class="w-full border rounded px-2 py-1 text-sm"
                                            value="{{ $parcela->vencimento->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-xs text-gray-500 mt-2">Ao alterar uma parcela, as demais serão ajustadas
                            automaticamente para manter o total da venda.</div>

                        <div class="mt-3 p-3 bg-gray-50 rounded-md">
                            <div class="text-sm font-medium text-gray-700">
                                Total da Venda: <span class="total-venda-valor">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</span>
                            </div>
                            <div id="total-parcelas" class="text-sm mt-1"></div>
                            
                            <div class="mt-2 flex gap-2">
                                <button type="button" onclick="distribuirIgualmente()" 
                                    class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                    Distribuir Igualmente
                                </button>
                                <button type="button" onclick="ajustarPorcentualmente()" 
                                    class="text-xs px-3 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200">
                                    Ajustar Proporcionalmente
                                </button>
                            </div>
                        </div>

                    </div <!-- Botões -->
                    <div class="flex justify-end gap-3 mt-8">
                        <a href="{{ route('vendas.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md text-sm font-medium transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-semibold transition">
                            Atualizar Venda
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function toggleProduto(index, produtoId) {
            const checkbox = document.querySelector(`input[value="${produtoId}"]`);
            const quantidadeInput = document.getElementById(`quantidade_${index}`);
            const produtoIdInput = document.getElementById(`produto_id_${index}`);

            if (checkbox.checked) {
                quantidadeInput.disabled = false;
                quantidadeInput.required = true;
                produtoIdInput.disabled = false;
                if (!quantidadeInput.value) {
                    quantidadeInput.value = '1';
                }
            } else {
                quantidadeInput.disabled = true;
                quantidadeInput.required = false;
                quantidadeInput.value = '';
                produtoIdInput.disabled = true;
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const totalVenda = parseFloat({{ $venda->valor_total }});
            const inputsValor = document.querySelectorAll('.valor-parcela');

            inputsValor.forEach((input, index) => {
                input.addEventListener('input', () => ajustarParcelas(index));
            });

            function ajustarParcelas(parcelaAlteradaIndex) {
                const valores = Array.from(inputsValor).map(input => parseFloat(input.value) || 0);
                const somaAtual = valores.reduce((acc, val) => acc + val, 0);
                const diferenca = totalVenda - somaAtual;

                // Ajusta as outras parcelas proporcionalmente
                let restanteParcelas = valores.length - 1;
                if (restanteParcelas < 1) return;

                const parcelaUnitaria = diferenca / restanteParcelas;

                valores.forEach((valor, index) => {
                    if (index !== parcelaAlteradaIndex) {
                        const valorAtual = parseFloat(inputsValor[index].value || 0);
                        const novoValor = valorAtual + parcelaUnitaria;
                        inputsValor[index].value = (novoValor < 0 ? 0 : novoValor.toFixed(2));
                    }
                });

                // Verifica se a soma final bate com o total
                const somaFinal = Array.from(inputsValor).reduce((acc, input) => acc + parseFloat(input.value || 0), 0);
                const diferencaFinal = totalVenda - somaFinal;

                // Se ainda há diferença, ajusta na última parcela
                if (Math.abs(diferencaFinal) > 0.01) {
                    const ultimaParcela = inputsValor[inputsValor.length - 1];
                    const valorUltimaParcela = parseFloat(ultimaParcela.value || 0);
                    ultimaParcela.value = (valorUltimaParcela + diferencaFinal).toFixed(2);
                }
            }

            // Função para mostrar o total atual das parcelas
            function mostrarTotalParcelas() {
                const somaAtual = Array.from(inputsValor).reduce((acc, input) => acc + parseFloat(input.value || 0), 0);
                const diferenca = totalVenda - somaAtual;
                
                // Atualiza o indicador visual se existir
                const indicadorTotal = document.getElementById('total-parcelas');
                if (indicadorTotal) {
                    indicadorTotal.textContent = `Total das parcelas: R$ ${somaAtual.toFixed(2).replace('.', ',')} (Diferença: R$ ${diferenca.toFixed(2).replace('.', ',')})`;
                    indicadorTotal.className = Math.abs(diferenca) < 0.01 ? 'text-green-600' : 'text-red-600';
                }
            }

            // Atualiza o total ao digitar
            inputsValor.forEach(input => {
                input.addEventListener('input', mostrarTotalParcelas);
            });

            // Mostra o total inicial
            mostrarTotalParcelas();

            // Função para distribuir o total igualmente entre as parcelas
            window.distribuirIgualmente = function() {
                const valorPorParcela = totalVenda / inputsValor.length;
                const diferenca = totalVenda - (valorPorParcela * inputsValor.length);
                
                inputsValor.forEach((input, index) => {
                    let valor = valorPorParcela;
                    // Adiciona a diferença na última parcela para fechar o total
                    if (index === inputsValor.length - 1) {
                        valor += diferenca;
                    }
                    input.value = valor.toFixed(2);
                });
                
                mostrarTotalParcelas();
            };

            // Função para ajustar proporcionalmente baseado nos valores atuais
            window.ajustarPorcentualmente = function() {
                const valoresAtuais = Array.from(inputsValor).map(input => parseFloat(input.value) || 0);
                const somaAtual = valoresAtuais.reduce((acc, val) => acc + val, 0);
                
                if (somaAtual <= 0) {
                    distribuirIgualmente();
                    return;
                }
                
                const fatorProporcional = totalVenda / somaAtual;
                let somaAjustada = 0;
                
                inputsValor.forEach((input, index) => {
                    let valorAjustado = valoresAtuais[index] * fatorProporcional;
                    
                    // Se é a última parcela, ajustar para fechar o total exato
                    if (index === inputsValor.length - 1) {
                        valorAjustado = totalVenda - somaAjustada;
                    }
                    
                    input.value = valorAjustado.toFixed(2);
                    somaAjustada += parseFloat(input.value);
                });
                
                mostrarTotalParcelas();
            };
        });
    </script>

    <script>
        // Script para recalcular total quando itens são alterados
        document.addEventListener('DOMContentLoaded', () => {
            const inputsQuantidade = document.querySelectorAll('input[name*="quantidade"]');
            const checkboxesProdutos = document.querySelectorAll('input[type="checkbox"]');
            
            // Função para recalcular o total da venda baseado nos itens selecionados
            function recalcularTotalVenda() {
                let novoTotal = 0;
                
                checkboxesProdutos.forEach((checkbox, index) => {
                    if (checkbox.checked) {
                        const quantidadeInput = document.getElementById(`quantidade_${index}`);
                        const quantidade = parseInt(quantidadeInput.value) || 0;
                        const preco = parseFloat(checkbox.dataset.preco) || 0;
                        novoTotal += quantidade * preco;
                    }
                });
                
                return novoTotal;
            }
            
            // Função para atualizar o total da venda e ajustar parcelas
            function atualizarTotalEParcelas() {
                const novoTotal = recalcularTotalVenda();
                
                // Atualizar o total exibido
                const totalVendaElement = document.querySelector('.total-venda-valor');
                if (totalVendaElement) {
                    totalVendaElement.textContent = `R$ ${novoTotal.toFixed(2).replace('.', ',')}`;
                }
                
                // Ajustar parcelas proporcionalmente se há parcelas
                const inputsValor = document.querySelectorAll('.valor-parcela');
                if (inputsValor.length > 0 && novoTotal > 0) {
                    const totalAtualParcelas = Array.from(inputsValor).reduce((acc, input) => acc + parseFloat(input.value || 0), 0);
                    
                    if (totalAtualParcelas > 0) {
                        const fatorAjuste = novoTotal / totalAtualParcelas;
                        let somaAjustada = 0;
                        
                        inputsValor.forEach((input, index) => {
                            let valorAjustado = parseFloat(input.value || 0) * fatorAjuste;
                            
                            // Se é a última parcela, ajustar para fechar o total exato
                            if (index === inputsValor.length - 1) {
                                valorAjustado = novoTotal - somaAjustada;
                            }
                            
                            input.value = valorAjustado.toFixed(2);
                            somaAjustada += parseFloat(input.value);
                        });
                    }
                }
                
                // Atualizar o indicador de total de parcelas
                const indicadorTotal = document.getElementById('total-parcelas');
                if (indicadorTotal) {
                    const somaAtual = Array.from(inputsValor).reduce((acc, input) => acc + parseFloat(input.value || 0), 0);
                    const diferenca = novoTotal - somaAtual;
                    indicadorTotal.textContent = `Total das parcelas: R$ ${somaAtual.toFixed(2).replace('.', ',')} (Diferença: R$ ${diferenca.toFixed(2).replace('.', ',')})`;
                    indicadorTotal.className = Math.abs(diferenca) < 0.01 ? 'text-green-600' : 'text-red-600';
                }
            }
            
            // Adicionar listeners para recalcular quando itens mudam
            inputsQuantidade.forEach(input => {
                input.addEventListener('input', atualizarTotalEParcelas);
            });
            
            checkboxesProdutos.forEach(checkbox => {
                checkbox.addEventListener('change', atualizarTotalEParcelas);
            });
        });
    </script>
</x-app-layout>
