<?php

namespace App\Helpers;

use Illuminate\Http\Response as HttpResponse;
use CiroVargas\GoogleDistanceMatrix\GoogleDistanceMatrix;
use App\Helpers\ErrorResponseHelper;

class CalculateDistanceHelper
{
    /**
     * Function to calculate the distance in meters.
     *
     * @var order
     */
    public static function calculate($order)
    {
    	try {
			$distanceMatrix = new GoogleDistanceMatrix(config('app.google_maps_api_key'));
			$distance = $distanceMatrix->setLanguage('en-US')
			->addOrigin($order['start_latitude'].",".$order['start_longitude'])
			->addDestination($order['end_latitude'].",".$order['end_longitude'])
			->sendRequest();

			$calculatedDistance = (int)$distance->getResponseObject()->rows[0]->elements[0]->distance->value;    		
    	} 
    	catch(\Exception $e)
        {
            return '';
        }

    	# distance in meters
        return $calculatedDistance;
    }

}