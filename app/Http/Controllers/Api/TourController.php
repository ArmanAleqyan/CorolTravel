<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tours;
use App\Models\TourHotels;
use App\Models\Hotel;
use App\Models\TourCategory;
class TourController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/get_stories",
     *     summary="Get stories",
     *     description="Retrieves stories of ongoing tours.",
     *     operationId="getStories",
     *     tags={"Tours"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation. Stories retrieved.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation")
     *         ),
     *     ),
     * )
     */
    public function get_stories(){
        $get = Tours::where('date_end' , '>=',Carbon::now()->format('Y-m-d'))->get();


        foreach ($get as $tour){
            $get_tour_joined_hotels = TourHotels::where('tour_id', $tour->id)->get('hotel_id')->pluck('hotel_id')->toarray();
            $get_hotels = Hotel::wherein('id', $get_tour_joined_hotels)->with('photo')->get();
            $tour['hotels'] = $get_hotels;
        }
        return  response()->json([
            'status' => true,
            'data' => $get

        ]);

    }
    /**
     * @OA\Get(
     *      path="/api/get_tour",
     *      operationId="getTours",
     *      tags={"Tours"},
     *      summary="Get list of tours",
     *      description="Returns list of tours based on provided filters",
     *      @OA\Parameter(
     *          name="country_id",
     *          in="query",
     *          description="ID of the country",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="category_id",
     *          in="query",
     *          description="ID of the category",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="start_price",
     *          in="query",
     *          description="Start price range",
     *          required=false,
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="end_price",
     *          in="query",
     *          description="End price range",
     *          required=false,
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      )
     * )
     */
    public function get_tour(Request  $request){
        $get = Tours::query();

        if (isset($request->country_id)){
            $get->where('country_id', $request->country_id);
        }

        if ($request->category_id){
            $get->where('category_id', $request->category_id);
        }


        if (isset($request->start_price) && isset($request->end_price)){
            $get->wherebetween('price', [$request->start_price, $request->end_price])->orwherebetween('new_price', [$request->start_price, $request->end_price]);
        }


        $get = $get->with('country', 'gorod_vileta','category')->orderby('id', 'desc')->simplepaginate(10);


        return response()->json([
           'status' => true,
           'data' => $get
        ],200);
    }


    /**
     * @OA\Get(
     *     path="/api/single_page_tour",
     *     summary="Get details of a single tour",
     *     description="Retrieves details of a single tour including connected hotels.",
     *     operationId="singlePageTour",
     *     tags={"Tours"},
     *     @OA\Parameter(
     *         name="tour_id",
     *         in="query",
     *         description="ID of the tour",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation. Tour details retrieved.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Tour not found.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation"),
     *             @OA\Property(property="message", type="string", description="Error message"),
     *         ),
     *     ),
     * )
     */
    public function single_page_tour(Request $request){
        $get = Tours::where('id', $request->tour_id)->with('country', 'gorod_vileta','category')->first();


        if ($get == null){
            return response()->json([
               'status' => false,
               'message' => 'not found'
            ],422);
        }


        $get_connect_hotels = TourHotels::where('tour_id', $request->tour_id)->get('hotel_id')->pluck('hotel_id')->toarray();



        $get_hotels = Hotel::wherein('id', $get_connect_hotels)->with('photo')->get();


        return  response()->json([
           'status' => true,
           'tour' =>$get,
           'hotels' =>$get_hotels
        ],200);
    }
    /**
     * @OA\Get(
     *     path="/api/get_tour_category",
     *     summary="Get tour categories",
     *     description="Retrieves all available tour categories.",
     *     operationId="getTourCategory",
     *     tags={"Tours"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation. Tour categories retrieved.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation")
     *         ),
     *     ),
     * )
     */
    public function get_tour_category(){


        $get = TourCategory::get();
        return response()->json([
           'status' => true,
           'data' =>$get
        ]);
    }
}
