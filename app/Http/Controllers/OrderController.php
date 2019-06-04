<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Facade\OrderFacade;
use App\Validators\OrderValidator;
use App\Helpers\ErrorResponseHelper;

class OrderController extends Controller
{

    /**
     * Create Order
     * 
     * JSON Request
     * {
     * "origin": ["START_LATITUDE", "START_LONGTITUDE"],
     * "destination": ["END_LATITUDE", "END_LONGTITUDE"]
     * }
     *  
     * @param  \App\Models\Order $request 
     * 
     * @return json
     */
    public function place(Request $request){

        $parameters = $request->json()->all();

        $validator = OrderValidator::order($parameters);
        if (!$validator->fails()) {
            return OrderFacade::createOrder($parameters);
        }

        return ErrorResponseHelper::throwInvalidError('UNABLE_TO_PLACE_ORDER');
    }


    /**
     * Take Order
     * 
     * @param  \App\Models\Order $request 
     * @return json
     */
    public function take(Request $request, $id){

        $parameters = $request->json()->all();

        $validator = OrderValidator::take($parameters);
        if (!$validator->fails()) {
            return OrderFacade::updateOrder($id);
        }

        return ErrorResponseHelper::throwInvalidError('UNABLE_TO_TAKE_ORDER');
    }


    /**
     * List Order
     * 
     * @param  \App\Models\Order $request 
     * @return json
     */
    public function list(Request $request){

        $parameters = [
            'page' => $request->input('page'),
            'limit' => $request->input('limit')
        ];

        $validator = OrderValidator::listing($parameters);
        if (!$validator->fails()) {
            return OrderFacade::ordersList($parameters['page'], $parameters['limit']);
        }

        return ErrorResponseHelper::throwInvalidError('UNABLE_TO_LIST_ORDER');
    }

}
