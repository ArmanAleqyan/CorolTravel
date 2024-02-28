<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/get_news",
     *      operationId="getNews",
     *      tags={"News"},
     *      summary="Get the latest news",
     *      description="Returns the latest news with pagination",
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
    public function get_news(){
        $get = News::orderby('id', 'desc')->simplepaginate(10);
        return response()->json([
           'status' => true,
           'data' => $get
        ]);
    }
    /**
     * @OA\Get(
     *     path="/api/single_page_news",
     *     summary="Get details of a single news",
     *     description="Retrieves details of a single news article.",
     *     operationId="singlePageNews",
     *     tags={"News"},
     *     @OA\Parameter(
     *         name="news_id",
     *         in="query",
     *         description="ID of the news article",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation. News details retrieved.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="News article not found.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation"),
     *             @OA\Property(property="message", type="string", description="Error message"),
     *         ),
     *     ),
     * )
     */
    public function single_page_news(Request  $request){
        $get = News::where('id', $request->news_id)->first();



        return response()->json([
           'status' => true,
            'data' => $get
        ],200);
    }
}
