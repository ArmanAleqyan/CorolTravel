<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelPhoto;
use App\Models\Tours;
use App\Models\address;
use Image;


class OptimizePhoto extends Controller
{

    public function optimize_photo(){
        $get_hotel_photo = HotelPhoto::where('photo_optimize', 0)->get();


        foreach ($get_hotel_photo as $hotel_photo) {
         $return = $this->optimize_function($hotel_photo->photo);
        if ($return == false){
            $hotel_photo->update([
                'photo_optimize' => 2
            ]);
        }else{
            $hotel_photo->update([
                'photo_optimize' => 1
            ]);
        }
        }

        $get_tour_photo = Tours::where('photo_optimize', 0)->get();


        foreach ($get_tour_photo as $tour_photo){
            $return = $this->optimize_function($tour_photo->photo);

            if ($return == false){
                $tour_photo->update([
                    'photo_optimize' => 2
                ]);
            }else{
                $tour_photo->update([
                    'photo_optimize' => 1
                ]);
            }
        }

        $get_address_photo = address::where('photo_optimize', 0)->get();

        foreach ($get_address_photo as $address_photo) {
            $return = $this->optimize_function($address_photo->photo);

            if ($return == false){
                $address_photo->update([
                    'photo_optimize' => 2
                ]);
            }else{
                $address_photo->update([
                    'photo_optimize' => 1
                ]);
            }
        }

    }


    public function optimize_function($photo){
        $destinationPath = public_path('uploads/'.$photo);
        $img = Image::make($destinationPath);
        $fileSizeBytes = $img->filesize();
        $fileSizeMB = round($fileSizeBytes / 1024 / 1024, 2); // Convert bytes to MB
        if ($fileSizeMB > 1 ){
            $img->orientate(false);
            $width =   getimagesize($destinationPath)[0] / 2;
            $height =   getimagesize($destinationPath)[1] / 2;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath);
            return true;
        }else{
            return  false;
        }
    }
}
