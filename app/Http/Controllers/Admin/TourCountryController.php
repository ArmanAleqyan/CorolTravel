<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
class TourCountryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/get_tours_country",
     *     summary="Get list of countries for tours",
     *     description="Retrieve a list of countries available for tours.",
     *     operationId="getToursCountry",
     *     tags={"Tours"},
     *     @OA\Response(
     *         response=200,
     *         description="List of countries retrieved successfully.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation"),
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", description="Country ID"),
     *                 @OA\Property(property="name", type="string", description="Country name"),
     *                 @OA\Property(property="created_at", type="string", description="Creation timestamp"),
     *                 @OA\Property(property="updated_at", type="string", description="Last update timestamp"),
     *             )),
     *         ),
     *     ),
     * )
     */
    public function get_tours_country(){
        $get = Country::orderby('name', 'asc')->get();


        return response()->json([
           'status' => true,
           'data' =>  $get
        ],200);
    }

    public function all_tours_country(){

        $get = Country::orderby('name', 'asc')->get();



        return view('admin.Country.all', compact('get'));
    }


    public function create_country (Request  $request){
        Country::create([
           'name' => $request->name
        ]);



        return redirect()->back()->with('created','created');
    }

    public function delete_country($id){
        Country::where('id', $id)->delete();


        return redirect()->back();
    }
}
