<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQ;

class FAQController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/get_all_faqs",
     *     summary="Get all FAQs",
     *     description="Retrieves all frequently asked questions (FAQs) from the database.",
     *     operationId="getAllFaqs",
     *     tags={"FAQs"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation. FAQs retrieved.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", description="Status of the operation"),
     *         ),
     *     ),
     * )
     */
    public function get_all_faqs(){
        $get = FAQ::orderby('id', 'desc')->get();


        return response()->json([
           'status' => true,
            'data' => $get
        ]);
    }
    public function all_faqs(){
        $get = FAQ::orderby('id', 'desc')->get();


        return view('admin.Faq.all', compact('get'));
    }

    public function create_faq_page(){
        return view('admin.Faq.create');
    }

    public function create_faq(Request  $request){
        FAQ::create([
           'question' => $request->question,
           'replay' => $request->replay,
        ]);



        return redirect()->back()->with('created','created');
    }

    public function single_page_faq($id){
        $get = FAQ::where('id', $id)->first();



        return view('admin.Faq.single', compact('get'));
    }

    public function update_faq(Request  $request){
        FAQ::where('id', $request->faq_id)->update([
            'question' => $request->question,
            'replay' => $request->replay,
        ]);


        return redirect()->back()->with('created','created');
    }

    public function delete_faq($id){
        FAQ::where('id', $id)->delete();

        return redirect()->route('all_faqs');
    }
}
