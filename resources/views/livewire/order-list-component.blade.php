<div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
    <div>
        <div class="overflow-x-auto">
            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Listado de Pedidos</h2>
            <table class="table-auto w-full border-collapse border-3 border-white">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Order Ref</th>
                        <th class="px-4 py-2 text-left">Customer Name</th>
                        <th class="px-4 py-2 text-left">Total Qty</th>
                        <th class="px-4 py-2 text-left">Cantidad de productos por pedido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="hover:bg-white-50">
                        <td class="px-4 py-2 mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ $order->order_ref }}</td>
                        <td class="px-4 py-2 mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ $order->customer_name }}</td>
                        <td class="px-4 py-2 mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ $order->order_lines_count  }}</td>

                        <td class="px-4 py-2 mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            @foreach($order->orderLines as $orderLine)
                                {{ $orderLine->qty }}
                            @endforeach 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            <h2 class="text-xl mt-4 text-gray-500 dark:text-gray-400 leading-relaxed">Último registro en Executed</h2>
            @if($latestExecuted)
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Pedidos: <span class="font-semibold">{{ $latestExecuted->total_orders }}</span> - Total: <span class="font-semibold">{{ $latestExecuted->total_cost }}</span> - (<span class="italic">{{ $latestExecuted->created_at }}</span>)</p>
            @else
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">No hay registros en Executed.</p>
            @endif
        </div>
    </div>
</div>
