<?php

namespace App\Livewire;

use App\Models\Executed;
use App\Models\Order;
use App\Models\OrderLine;
use Livewire\Component;

class OrderListComponent extends Component
{
    public function render()
    {
        // Retrieve all orders with the count of associated order lines
        $orders = Order::withCount('orderLines')->get();
        
        // Retrieve the latest executed record
        $latestExecuted = Executed::latest()->first();
    
        // Return the 'order-list-component' view with the necessary data for rendering
        return view('livewire.order-list-component', [
            'orders' => $orders, // Pass the orders to the view
            'latestExecuted' => $latestExecuted // Pass the latest executed record to the view
        ]);
    }
}
