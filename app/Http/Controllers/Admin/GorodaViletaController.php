<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViletCity;
class GorodaViletaController extends Controller
{

    public function all_goroda_vileta(){

        $get = ViletCity::get();


        return view('admin.GorodaVileta.all', compact('get'));
    }

    public function create_goroda_vileta(Request  $request){
        ViletCity::create([
           'name' =>$request->name
        ]);


        return redirect()->back()->with('created','created');
    }


    public function delete_goroda_vileta($id){
        ViletCity::where('id', $id)->delete();


        return redirect()->back()->with('deleted','deleted');
    }
}
