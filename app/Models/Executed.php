<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executed extends Model
{
    use HasFactory;
    protected $table = 'executed'; // Especifica el nombre de la tabla

    protected $fillable = ['total_orders', 'total_cost'];
}
