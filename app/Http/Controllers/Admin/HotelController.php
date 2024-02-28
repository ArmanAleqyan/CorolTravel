<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\HotelPhoto;

class HotelController extends Controller
{

        public function all_hotels(){

            $get = Hotel::query();


            if (auth()->user()->role_id != 1){
                $get = $get->where('user_id', auth()->user()->id);
            }
            $get = $get->get();


            return view('admin.Hotel.all', compact('get'));
        }

        public function create_hotel_page(){
            $get_country = Country::get();
            $night_count = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21];
            return view('admin.Hotel.create', compact('get_country', 'night_count'));
        }

        public function create_hotel(Request  $request){



            $create  = Hotel::create([
               'user_id' => auth()->user()->id ,
               'country_id' => $request->country_id,
               'name' => $request->name	,
               'start_date' => $request->start_date	,
               'night_count' => $request->night_count	,
               'price' => $request->price	,
               'new_price' => $request->new_price	,
               'text_one' => $request->text_one	,
               'text_two' => $request->text_two	,
               'text_three' => $request->text_three	,
               'text_for' => $request->text_for	,
               'text_five' => $request->text_five	,
            ]);


            if (isset($request->photo)){
                $time = time();
                foreach ($request->photo as $item) {
                    $photo = $item;
                    $destinationPath = 'uploads';
                    $originalFile =  $time++ . '.' . $photo->getClientOriginalExtension();
                    $photo->move($destinationPath, $originalFile);
                    $files = $originalFile;

                    HotelPhoto::create([
                       'hotel_id' =>$create->id,
                       'photo' =>$originalFile,
                    ]);
                }
            }


            return response()->json([
               'status' => true,
               'message' => 'Created',
                'url' => env('APP_URL').'admin/create_hotel_page'
            ],200);
        }

        public function single_page_hotel($id){
            $get= Hotel::where('id', $id)->first();
            $get_country = Country::get();
            $night_count = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21];

            return view('admin.Hotel.single', compact('get','get_country', 'night_count' ));
        }

        public function delete_hotel_photo($id){

            HotelPhoto::where('id', $id)->delete();


            return redirect()->back();
        }

        public function update_hotel(Request  $request){


            $get = Hotel::where('id', $request->hotel_id)->first();



            $get->update([
//                'country_id' => $request->country_id,
                'name' => $request->name	,
//                'start_date' => $request->start_date	,
//                'night_count' => $request->night_count	,
                'price' => $request->price	,
                'new_price' => $request->new_price	,
//                'text_one' => $request->text_one	,
//                'text_two' => $request->text_two	,
//                'text_three' => $request->text_three	,
//                'text_for' => $request->text_for	,
//                'text_five' => $request->text_five	,
                'description' => $request->description	,
            ]);

            if (isset($request->photo)){
                $time = time();
                foreach ($request->photo as $item) {
                    $photo = $item;
                    $destinationPath = 'uploads';
                    $originalFile =  $time++ . '.' . $photo->getClientOriginalExtension();
                    $photo->move($destinationPath, $originalFile);
                    $files = $originalFile;

                    HotelPhoto::create([
                        'hotel_id' =>$get->id,
                        'photo' =>$originalFile,
                    ]);
                }
            }


            return response()->json([
               'status' => true,
               'message' =>'Updated',
                'url' => env('APP_URL').'admin/single_page_hotel/hotel_id='.$get->id
            ]);
        }


        public function delete_hotel($id){
            $get_hotel_relation_tour = \App\Models\TourHotels::where('hotel_id', $id)->first();

            Hotel::where('id', $id)->delete();

            return redirect()->route('single_page_tour',$get_hotel_relation_tour->tour_id);
        }
}
