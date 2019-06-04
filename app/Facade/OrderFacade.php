<?php

namespace App\Facade;

use Illuminate\Http\Response as HttpResponse;
use App\Models\Order;
use App\Helpers\CalculateDistanceHelper;
use App\Helpers\ErrorResponseHelper;

class OrderFacade
{

    public static function createOrder($parameters)
    {
		$orderDetails = [
			'start_latitude' => $parameters['origin'][0],
			'start_longitude' => $parameters['origin'][1],
			'end_latitude' => $parameters['destination'][0],
			'end_longitude' => $parameters['destination'][1]
		];

    	$orderDetails['distance'] = CalculateDistanceHelper::calculate($orderDetails);

	    $createdOrder = Order::createRecord($orderDetails);

		$resonse = [
			'id' => $createdOrder->id,
			'distance' => $createdOrder->distance,
			'status' => $createdOrder->status
		];

	    return response()->json($resonse, HttpResponse::HTTP_OK);
    }


    public static function updateOrder($id)
    {

    	$order = Order::select('id', 'status')->where('id', $id)->first();
		if($order) {
			if ($order->status == config('app.order_status.success')) 
				return ErrorResponseHelper::alreadyUpdatedError('ORDER_ALREADY_BEEN_TAKEN');

			$updatedRecord = Order::updateStatus($order);
			if ($updatedRecord) {
				$response = [ 'status' => $updatedRecord->status ];
		    	return response()->json($response, HttpResponse::HTTP_OK);
	    	}
		}

		return ErrorResponseHelper::noRecordFoundError('No record found.');
    }

    public static function ordersList($page=1, $limit=10)
    {
    	$startFrom = ($page * $limit) - $limit;
    	$orders = Order::list($startFrom, $limit);

    	return $orders;
    }

}
