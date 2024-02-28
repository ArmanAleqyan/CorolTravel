<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\address;
use App\Models\WorkCity;
class AddressController extends Controller
{

    public function all_address(){
        $get = address::orderby('updated_at', 'desc')->get();



        return view('admin.Address.all', compact('get'));
    }

    public function create_address_page(){
        $work_city = WorkCity::orderby('id', 'desc')->get();
        return view('admin.Address.create' ,compact('work_city'));
    }

    public function create_address(Request  $request){
        $data = $request->all();

        if (isset($request->photo)){
            $photo = $request->photo;
            $destinationPath = 'uploads';
            $originalFile =  time() . '.' . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $originalFile);
            $files = $originalFile;
        }else{
            $originalFile = null;
        }


        unset($data['photo']);
        $data['photo'] = $originalFile;
        address::create($data);



        return redirect()->back()->with('created','created');
    }

    public function single_page_address($id){
        $get = address::where('id', $id)->first();
        $work_city = WorkCity::orderby('id', 'desc')->get();

        return  view('admin.Address.single', compact('get','work_city'));
    }

    public function update_address(Request  $request){
        $data = $request->except('address_id','_token');


        $get = address::where('id', $request->address_id)->first();


        if (isset($request->photo)){
            $photo = $request->photo;
            $destinationPath = 'uploads';
            $originalFile =  time() . '.' . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $originalFile);
            $files = $originalFile;
        }else{
            $originalFile = $get->photo;
        }


        unset($data['photo']);
        $data['photo'] = $originalFile;
        address::where('id', $request->address_id)->update(
            $data
        );

        return redirect()->back()->with('updated','updated');
    }
}
