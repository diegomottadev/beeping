<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Executed;

class ExecutedController extends Controller
{
    //
    public function store(Request $request)
    {
        // Aquí guardas los datos recibidos en la tabla "executed"
        // Puedes usar el método create si tienes los campos masivos definidos en el modelo
        Executed::create($request->all());
        \Log::info('Controller Data saved successfully');

        return response()->json(['message' => 'Data saved successfully'], 200);
    }
}
