<?php

namespace App\Console\Commands;

use App\Jobs\CalculateTotalCostJob;
use App\Models\Executed;
use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExecuteTotal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execute:total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate total cost of all orders';

    /**
     * Execute the console command.
     */
    public function handle()
    {

       /*
        Calcular de forma asíncrona el coste total de todos los pedidos de la DB. 
        Para calcular este coste hay que multiplicar cada order_line “qty” por el “product cost” (colocar un nombre a la queue). 
        Una vez sumados todos los pedidos guardar el resultado en la tabla executed pegando al endpoint /api/executed/create
        */

        // Calcular el costo total de todos los pedidos
        $totalCost = OrderLine::with('product')->get()->sum(function ($orderLine) {
            return $orderLine->qty * $orderLine->product->cost;
        });

        //No se especifica que ordenes ya se ejecutaron en el challege considero que todas ordenes

        $totalOrders = Order::count();

        CalculateTotalCostJob::dispatch($totalCost,$totalOrders)->onQueue('total-queue');

        $this->info('Total cost calculation enqueued successfully.');
    }
}
