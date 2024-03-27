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
        $this->totalCost = $totalCost;
        $this->totalOrders = $totalOrders;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
       try{ // Guarda el resultado en la tabla "executed"
            // Envía una solicitud HTTP al endpoint /api/executed/create
            // Puedes usar Guzzle HTTP Client u otro método para enviar la solicitud
            // Aquí un ejemplo utilizando Guzzle:
            \Log::info('Job before to execute.');

            $params = [
                'total_cost' => $this->totalCost,
                'total_orders' => $this->totalOrders
            ];
            
            $response = Http::post('http://beeping-nginx/api/executed/create', $params);

            \Log::info('Job executed successfully.');

        } catch (\Exception $e) {
            // Log de error
            \Log::error('Job failed: ' . $e->getMessage());
        }
    }
}
