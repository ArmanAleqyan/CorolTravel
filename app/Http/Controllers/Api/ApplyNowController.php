<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tours;
use Illuminate\Http\Request;
use App\Mail\NewRequest;
use Illuminate\Support\Facades\Mail;
use Validator;
class ApplyNowController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/appl_now",
     *     summary="Apply for a tour",
     *     description="Apply for a tour by providing necessary information.",
     *     operationId="applyNow",
     *     tags={"Tours"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Tour application data",
     *         @OA\JsonContent(
     *             required={"tour_id", "name", "phone", "email"},
     *             @OA\Property(property="tour_id", type="integer", description="ID of the tour to apply for"),
     *             @OA\Property(property="name", type="string", description="Name of the applicant"),
     *             @OA\Property(property="phone", type="string", description="Phone number of the applicant"),
     *             @OA\Property(property="email", type="string", format="email", description="Email address of the applicant"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Application submitted successfully.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation"),
     *             @OA\Property(property="message", type="string", description="Message indicating the result of the operation"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request. Validation errors occurred.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation"),
     *             @OA\Property(property="message", type="object", description="Validation errors"),
     *         ),
     *     ),
     * )
     */
    public function apply_now(Request  $request){
        $rules=array(
            'tour_id' => 'required|exists:tours,id',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' =>$validator->errors()
            ],400);
        }


        $get = Tours::where('id', $request->tour_id)->first();


        $get_user = User::where('id', $get->user_id)->first();



        $details = [
            'name' =>$get_user->name,
            'user_name' =>$request->name,
            'user_phone' =>$request->phone,
            'user_email' =>$request->email,
            'title' =>$get->title,
            'kurort' =>$get->kurort,
            'date_start' =>$get->date_start,
            'date_end' =>$get->date_end,
            'night_count' =>$get->night_count,
            'price' =>$get->price,
            'new_price' =>$get->new_price
        ];

        Mail::to($get_user->email)->send(new NewRequest($details));

        return  response()->json([
           'status' =>true,
           'message' => 'Sended'
        ]);
    }
}
