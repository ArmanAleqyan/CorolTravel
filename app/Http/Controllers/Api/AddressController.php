<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\address;
class AddressController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/get_address",
     *      operationId="getAddress",
     *      tags={"Address"},
     *      summary="Get address data",
     *      description="Returns address data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="boolean",
     *                  example=true
     *              ),
     *          ),
     *      ),
     * )
     */
    public function get_address(Request  $request){
        $get = address::get();


        return response()->json([
           'status' => true,
           'data' => $get
        ]);
    }
}
