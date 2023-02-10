<?php

namespace App\Http\Traits;

trait ResponseTrait
{
    public function ValidationResponse($status=200 ,$validator)
    {
        return response()->json(
            [
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
            ]
        )->header('status', $status);
    }
}
