<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoralInfo;
class InfoOnasController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/get_info_o_nas",
     *     summary="Get information about us",
     *     description="Retrieves information about the company or organization.",
     *     operationId="getInfoONas",
     *     tags={"Information"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation. Information retrieved.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation"),
     *             @OA\Property(property="data", type="object", description="Information about the company or organization",
     *                 @OA\Property(property="id", type="integer", description="Unique identifier"),
     *                 @OA\Property(property="name", type="string", description="Name of the company or organization"),
     *                 @OA\Property(property="description", type="string", description="Description of the company or organization"),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function get_info_o_nas(){
        $get = CoralInfo::first();


        return response()->json([
           'status' => true,
           'data' => $get
        ],200);

    }

    public function info_o_nas(){
        $get =CoralInfo::first();

        return view('admin.infoonas', compact('get'));
    }


    public function update_info_o_nas(Request  $request){

        CoralInfo::first()->update([
           'instagram' =>  $request->instagram,
           'wk' =>  $request->wk,
           'whatsapp' =>  $request->whatsapp,
           'telegram' =>  $request->telegram,
           'description_o_nas' =>  $request->description_o_nas,
        ]);


        return redirect()->back()->with('created','created');
    }
}
