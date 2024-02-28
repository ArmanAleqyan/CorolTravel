<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;
class TourOperatorsController extends Controller
{

    public function get_tour_operators(){
        $get = User::where('role_id', 2)->get();


        return view('admin.Operators.all',compact('get'));
    }

    public function create_tour_operator_page(){
        $get_work_address = address::get();


        return view('admin.Operators.create',  compact('get_work_address'));
    }

    public function create_tour_operator(Request  $request){
        $rules=array(
            'email' => 'unique:users,email',
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return  redirect()->back()->withErrors($validator)->withInput();

        }

        $get = address::where('id', $request->address_id)->first();

        User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'address_id' => $request->address_id,
            'city_id' => $get->city_id,

            'role_id' => 2
        ]);

        return redirect()->back()->with('created','created');
    }

    public function single_page_operator($id){
        $get_work_address = address::get();

        $get = User::where('id', $id)->first();

        return view('admin.Operators.single', compact('get_work_address', 'get'));
    }

    public function update_tour_operator(Request  $request){

        $rules=array(
            'email' => [
                'required',
                'email',
                'max:254',
                Rule::unique('users')->where(function ($query) use($request) {
                    return $query->where('id',  '!=', $request->operator_id);
                }),
            ],
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return  redirect()->back()->withErrors($validator)->withInput();

        }

        $get = User::where('id', $request->operator_id)->first();


        if (isset($request->password)){
            $get->update([
               'password' => Hash::make($request->password)
            ]);
        }
        $get_address = address::where('id', $request->address_id)->first();
        $get->update([
            'name' => $request->name,
           'email' =>$request->email,
            'address_id' => $request->address_id,
            'city_id' => $get_address->city_id,
        ]);

        return  redirect()->back()->with('created','created');
    }
}
