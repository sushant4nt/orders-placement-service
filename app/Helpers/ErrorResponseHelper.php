<?php

namespace App\Helpers;

use Illuminate\Http\Response as HttpResponse;

class ErrorResponseHelper
{

    /**
     * Return Error response as Internal_Server_Error.
     *
     * @var message
     */
    public static function throwInvalidError($message)
    {
        return response()->json(['error' => $message], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Return Error response as Http_Not_Found.
     *
     * @var message
     */
    public static function noRecordFoundError($message)
    { 
        return response()->json(['error' => $message], HttpResponse::HTTP_NOT_FOUND);
    }

    /**
     * Return Error response as Http_Conflict.
     *
     * @var message
     */
    public static function orderAlreadyUpdatedError($message)
    {
        return response()->json(['error' => $message], HttpResponse::HTTP_CONFLICT);
    }

}