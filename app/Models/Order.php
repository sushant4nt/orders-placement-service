<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{

    protected $fillable = [
        'start_latitude', 
        'start_longitude', 
        'end_latitude', 
        'end_longitude', 
        'distance', 
        'status'
    ];

    public $timestamps = false;

    /**
     * Create order
     */
    static public function createRecord($parameters) {

        $order = self::create(
            [
                'start_latitude' => $parameters['start_latitude'],
                'start_longitude' => $parameters['start_longitude'],
                'end_latitude' => $parameters['end_latitude'],
                'end_longitude' => $parameters['end_longitude'],
                'distance' => $parameters['distance'],
                'status' => config('app.order_status.unassign'),
                'created_at' => Carbon::now()->toDateTimeString()
            ]
        );

        return $order;
    }


    /**
     * Update order
     */
    static public function updateStatus($order) {
        
        $order->status = config('app.order_status.success');
        $order->save();

        return $order;
    }


    /**
     * List of orders
     */
    static public function list($start, $limit) {

        return self::select('id', 'distance', 'status')->skip($start)->take($limit)->get();
    }

}
