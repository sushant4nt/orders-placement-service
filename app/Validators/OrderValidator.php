<?php

namespace App\Validators;

use Validator;
use App\Models\Order;

class OrderValidator
{

    public static function order($parameters)
    {
        $rules = [
            'origin'            => 'required|array|min:2|max:2',
            'destination'       => 'required|array|min:2|max:2',
            'origin.0'          => 'required|regex:/^-?\d{1,2}\.\d{6,}$/',
            'origin.1'          => 'required|regex:/^-?\d{1,2}\.\d{6,}$/',
            'destination.0'          => 'required|regex:/^-?\d{1,2}\.\d{6,}$/',
            'destination.1'          => 'required|regex:/^-?\d{1,2}\.\d{6,}$/'
        ];

        return Validator::make($parameters, $rules);
    }


    public static function take($parameters)
    {
        $rules = [
            'status' => 'required|string|min:3|max:6'
        ];
        
        return Validator::make($parameters, $rules);
    }


    public static function listing($parameters)
    {
        $rules = [
            'page' => 'required|integer|min:1|max:1000',
            'limit' => 'required|integer|min:1|max:20'
        ];
        
        return Validator::make($parameters, $rules);
    }

}
