<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'url', 'model', 'type', 'input_field', 'method', 'total_data',
    ];
}
