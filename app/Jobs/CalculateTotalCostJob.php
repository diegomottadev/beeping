<?php

namespace App\Jobs;

use App\Models\Executed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateTotalCostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $totalCost;
    protected $totalOrder;

    public function __construct($totalCost,$totalOrder)
    {
        $this->totalCost = $totalCost;
        $this->totalOrder = $totalOrder;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Guarda el resultado en la tabla "executed"
        // Envía una solicitud HTTP al endpoint /api/executed/create
        // Puedes usar Guzzle HTTP Client u otro método para enviar la solicitud
        // Aquí un ejemplo utilizando Guzzle:
        $client = new \GuzzleHttp\Client();
        $client->post('http://localhost:8080/api/executed/create', [
            'json' => ['total_cost' => $this->totalCost,'total_orders' =>  $this->totalOrder  ]
        ]);
    }
}
