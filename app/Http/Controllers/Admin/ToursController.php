<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tours;
use App\Models\ViletCity;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\TourCategory;
use App\Models\TourHotels;
use App\Models\HotelPhoto;
class ToursController extends Controller
{

            public function delete_old_tour(){
                $get_tour = Tours::where('date_end', '<', Carbon::now()->subDay())->get();
                foreach ($get_tour as $tour){
                    $get_hotels_relation = TourHotels::where('tour_id', $tour->id)->get('hotel_id')->pluck('hotel_id')->toarray();
                    $get_hotels = Hotel::wherein('id', $get_hotels_relation)->get();
                    foreach ($get_hotels as $get_hotel) {
                        foreach ($get_hotel->photo as $hotel_photo){
                            $hotel_photo_path = public_path('uploads/'.$hotel_photo->photo);
                            if (file_exists($hotel_photo_path)) {
                                unlink($hotel_photo_path);
                            }
                            $hotel_photo->delete();
                        }
                        $get_hotel->delete();
                    }
                    $tour_photo_path = public_path('uploads/'.$tour->photo);
                    if (file_exists($tour_photo_path)){
                        unlink($tour_photo_path);
                    }
                    $tour->delete();
                }
            }

    public function all_tourss(){

        $get = Tours::query();

        if (auth()->user()->role_id != 1){
            $get->where('user_id', auth()->user()->id);
        }
        $get =$get->get();

        return view('admin.Tour.all', compact('get'));

    }

    public function create_tour_page(){
        $get_vilet_city = ViletCity::orderby('name', 'asc')->get();
        $get_country = Country::orderby('name', 'asc')->get();
        $tour_category = TourCategory::orderby('name', 'asc')->get();
        $night_count = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21];
        return view('admin.Tour.create',compact('get_vilet_city','get_country','tour_category','night_count'));
    }

    public function create_tour(Request  $request){


        if (isset($request->photo)){
            $photo = $request->photo;
            $destinationPath = 'uploads';
            $originalFile =  time() . '.' . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $originalFile);
            $files = $originalFile;
        }else{
            $originalFile = null;
        }


       $create_tour = Tours::create([
           'user_id'=> auth()->user()->id,
            'vilet_city_id' => $request->vilet_city_id,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'republic_text' => $request->republic_text,
            'republick_name' => $request->republick_name,
            'in_price_text' => $request->in_price_text,
            'price_description' => $request->price_description,
            'new_price' => $request->new_price,
            'price' => $request->price,
            'night_count' => $request->night_count,
            'date_end' => $request->date_end,
            'date_start' => $request->date_start,
            'kurort' => $request->kurort,
            'title' => $request->title,
            'photo' => $originalFile,
        ]);


        if (isset($request->data)){
            foreach ($request->data as $key => $data){







                    $create_hotel = Hotel::create([
                        'name' => $data['name'],
                        'price' => $data['price'],
                        'new_price' => $data['new_price'],
                        'description' => $data['description'],
                        'user_id' => auth()->user()->id,
                    ]);
                    $time = time();
                    foreach ( $request->photos[$key] as $photo){
                        $photo = $photo;
                        $destinationPath = 'uploads';
                        $originalFile =  $time++. '.' . $photo->getClientOriginalExtension();
                        $photo->move($destinationPath, $originalFile);
                        $files = $originalFile;
                        HotelPhoto::create([
                            'photo' =>$originalFile,
                            'hotel_id' => $create_hotel->id
                        ]);
                    }
                    TourHotels::create([
                       'user_id' => auth()->user()->id,
                       'tour_id' => $create_tour->id,
                       'hotel_id' => $create_hotel->id,
                    ]);
                }

        }




        return  response()->json([
           'status' => true,
           'url' => route('single_page_tour',$create_tour->id)
        ]);
    }


    public function single_page_tour($id){
        $get = Tours::where('id', $id)->first();
        if ($get == null){
            return  redirect()->route('all_tourss');
        }
        $get_vilet_city = ViletCity::orderby('name', 'asc')->get();
        $get_country = Country::orderby('name', 'asc')->get();
        $tour_category = TourCategory::orderby('name', 'asc')->get();
        $night_count = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21];




        $get_hotel_realtion = TourHotels::where('tour_id', $id)->get('hotel_id')->pluck('hotel_id')->toarray();

        $get_hotels = Hotel::wherein('id', $get_hotel_realtion)->get();


        return view('admin.Tour.single', compact('get','get_vilet_city','get_country','tour_category','night_count','get_hotels'));
    }

    public function update_tour(Request $request){
//
//
//        if (isset($request->hotels)){
//            TourHotels::where('tour_id', $request->tour_id)->delete();
//
//            foreach ($request->hotels as $hotels){
//                TourHotels::create([
//                   'tour_id' => $request->tour_id,
//                   'hotel_id' => $hotels,
//                   'user_id' => auth()->user()->id,
//                ]);
//            }
//        }

        $get = Tours::where('id', $request->tour_id)->first();

        if (isset($request->photo)){
            $photo = $request->photo;
            $destinationPath = 'uploads';
            $originalFile =  time() . '.' . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $originalFile);
            $files = $originalFile;
        }else{
            $originalFile = $get->photo;
        }

        $get->update([
            'vilet_city_id' => $request->vilet_city_id,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'republic_text' => $request->republic_text,
            'republick_name' => $request->republick_name,
            'in_price_text' => $request->in_price_text,
            'price_description' => $request->price_description,
            'new_price' => $request->new_price,
            'price' => $request->price,
            'night_count' => $request->night_count,
            'date_end' => $request->date_end,
            'date_start' => $request->date_start,
            'kurort' => $request->kurort,
            'title' => $request->title,
            'photo' => $originalFile,
        ]);

        if (isset($request->data)){
            foreach ($request->data as $key => $data){







                $create_hotel = Hotel::create([
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'new_price' => $data['new_price'],
                    'description' => $data['description'],
                    'user_id' => auth()->user()->id,
                ]);
                $time = time();
                foreach ( $request->photos[$key] as $photo){
                    $photo = $photo;
                    $destinationPath = 'uploads';
                    $originalFile =  $time++. '.' . $photo->getClientOriginalExtension();
                    $photo->move($destinationPath, $originalFile);
                    $files = $originalFile;
                    HotelPhoto::create([
                        'photo' =>$originalFile,
                        'hotel_id' => $create_hotel->id
                    ]);
                }
                TourHotels::create([
                    'user_id' => auth()->user()->id,
                    'tour_id' => $get->id,
                    'hotel_id' => $create_hotel->id,
                ]);
            }

        }

        return  response()->json([
            'status' => true,
            'url' => route('single_page_tour',$get->id)
        ]);
    }



    public function delete_tour($id){
        Tours::where('id', $id)->delete();

        return redirect()->route('all_tourss');
    }
}
