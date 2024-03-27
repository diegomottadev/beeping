<?php

namespace App\Jobs;

use App\Models\Executed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CalculateTotalCostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $totalCost;
    protected $totalOrders;

    public function __construct($totalCost,$totalOrders)
    {
        // Initialize job with total cost and total orders
        $this->totalCost = $totalCost;
        $this->totalOrders = $totalOrders;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {

            // Send an HTTP request to the /api/executed/create endpoint
            \Log::info('Job before execution.');

            $params = [
                'total_cost' => $this->totalCost,
                'total_orders' => $this->totalOrders
            ];
            
            // Post request to create executed record
            $response = Http::post('http://beeping-nginx/api/executed/create', $params);

            \Log::info('Job executed successfully.');

        } catch (\Exception $e) {
            // Log any errors that occur during job execution
            \Log::error('Job failed: ' . $e->getMessage());
        }
    }
}
