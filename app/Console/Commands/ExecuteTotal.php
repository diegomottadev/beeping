<?php

namespace App\Console\Commands;

use App\Jobs\CalculateTotalCostJob;
use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

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
            // Calcular el costo total de todos los pedidos
            $totalCost = OrderLine::with('product')->get()->sum(function ($orderLine) {
                return $orderLine->qty * $orderLine->product->cost;
            });

            // No se especifica qué órdenes ya se ejecutaron en el desafío; consideraremos que todas las órdenes

            $totalOrders = Order::count();

            Bus::chain([
                new CalculateTotalCostJob($totalCost, $totalOrders),
            ])->catch(function (Throwable $e) {
               \Log::error('Command and job failed: ' . $e->getMessage());
            })->dispatch();

            $this->info('Total cost calculation enqueued successfully.');

            // Log de éxito
            \Log::info('Command executed and job dispatched successfully.');

    }
}
