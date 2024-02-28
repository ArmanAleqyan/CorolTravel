<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{

    public function all_news(){
        $get = News::get();


        return view('admin.News.all', compact('get'));
    }


    public function create_news_page(){
        return view('admin.News.create');
    }


    public function create_news(Request  $request){
        if (isset($request->photo)){
            $photo = $request->photo;
            $destinationPath = 'uploads';
            $originalFile =  time() . '.' . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $originalFile);
            $files = $originalFile;
        }else{
            $originalFile = null;
        }


        News::create([
           'title' => $request->title,
           'description' => $request->description,
           'photo' => $originalFile
        ]);


        return redirect()->back()->with('created','created');
    }

    public function single_page_news ($id){

        $get = News::where('id', $id)->first();



        return view('admin.News.single', compact('get'));
    }

    public function update_news(Request  $request){
        $get = News::where('id', $request->news_id)->first();

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
           'photo' => $originalFile,
           'title' => $request->title,
           'description' => $request->description
        ]);


        return redirect()->back()->with('created','created');

    }

    public function delete_news($id){
        News::where('id', $id)->delete();



        return redirect()->back()->with('deleted', 'deleted');


    }
}
