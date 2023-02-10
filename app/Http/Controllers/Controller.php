<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }
    /**
     * @param int $status
     * @param array $data
     * @param array $messages
     * @param bool $validation
     * @return \Illuminate\Http\JsonResponse
     */
    public function FailResponse($status=500 ,$messages=["Failed"], $validation = false, $custom_code=500,$status_message='warning')
    {
        $errors =  $messages;
        if($validation){
            $errors = [];
            foreach ($messages->errors()->toArray() as $key => $messages){
                $errors[] = $messages[0];
            }

        }

        return response()->json(
            [
                'code' => $custom_code != 500 ? (int)$custom_code : (int)$status,
                'messages' => $errors,
                'data' => null,
                'status_message' => $status_message
            ]
        )->header('status', $status);
    }

    /**
     * @param int $status
     * @param array $data
     * @param array $messages
     * @return \Illuminate\Http\JsonResponse
     */
    public function SuccessResponse($statusCode=200,$data=null,$messages=["Success"], $custom_code=200,$status="success")
    {
        return response()->json(
            [
                'code' => $statusCode != 200 ? (int)$statusCode : (int) 200,
                'messages' => $messages,
                'data' => ([] || empty($data))?  null : $data,
                'status' => $status
            ]
        )->header('status', $statusCode);
    }


    public function paginateFormat($collection, $items)
    {
        return [
            "paginator" => [
                "current_page" =>  $collection->currentPage(),
                "total_pages" =>  $collection->lastPage(),
                "previous_page_url" =>  null,
                "next_page_url" =>  null,
                "record_per_page" => $collection->perPage(),
            ],
            "pagination_last_page" => $collection->lastPage(),
            "total_count" => count($collection->items()),
            'data' =>  $items
        ];
    }
}
