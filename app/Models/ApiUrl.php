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

    public static function getMethod($method)
    {
        if($method == 'get'){
            return 'index';
        }elseif($method == 'put'){
            return 'update';
        }elseif($method == 'get_view'){
            return 'show';
        }elseif($method == 'delete'){
            return 'destroy';
        }elseif($method == 'post'){
            return 'store';
        }else{
            return "No method select";
        }
    }

    public static function getRouteMethod($method)
    {
        if($method == 'get'){
            return 'get';
        }elseif($method == 'put'){
            return 'put';
        }elseif($method == 'get_view'){
            return 'get';
        }elseif($method == 'delete'){
            return 'delete';
        }elseif($method == 'post'){
            return 'post';
        }else{
            return "apiResource";
        }
    }

    public static function getUrl($url, $method)
    {
        if($method == 'get'){
            return $url;
        }elseif($method == 'put'){
            return $url.'/{id}';
        }elseif($method == 'get_view'){
            return $url.'/{id}';
        }elseif($method == 'delete'){
            return $url.'/{id}';
        }elseif($method == 'post'){
            return $url;
        }else{
            return $url;
        }
    }
}
