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
        // Calculate the total cost of all orders
        $totalCost = OrderLine::with('product')->get()->sum(function ($orderLine) {
            return $orderLine->qty * $orderLine->product->cost;
        });

        // It's not specified which orders are already executed in the challenge; we'll consider all orders

        // Count total number of orders
        $totalOrders = Order::count();

        // Dispatch a job to calculate the total cost in a queued chain
        Bus::chain([
            new CalculateTotalCostJob($totalCost, $totalOrders),
        ])->catch(function (Throwable $e) {
           // Log any errors that occur during job execution
           \Log::error('Command and job failed: ' . $e->getMessage());
        })->dispatch();

        // Output success message to console
        $this->info('Total cost calculation enqueued successfully.');

        // Log success
        \Log::info('Command executed and job dispatched successfully.');

    }
}
