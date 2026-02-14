<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function Pest\Laravel\json;

class OrderResource extends JsonResource
{
    public function __construct()
    {
        //
    }
   
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function getResponse($data)
    {
        return response()->json([
                                'success' => true,
                                'data' => $data
                            ]);
    }
}
