<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ImageUploader;
use Illuminate\Support\Facades\DB;

class Writer extends Controller
{
    /* upload */
    use ImageUploader;
    /* views */
    public function viewAddArticle(){
        return view('/addArticle');
    }

    /* logic */
    public function addArticleAction(Request $request){
        $data =  $this->validate($request,[
            "title"     => "required|string",
            "content" => "required|min:50|max:100",
        ]);
        $checkImage = $this->checkImage($request);
        if($checkImage) {
            $imagePath = $this->uploadImage($request);
        };
        DB::insert(
            "INSERT INTO articles (articleName, content, imagePath, writer_id)
            VALUES ('{$data['title']}','{$data['content']}', '$imagePath', 1);"
        );
        return view('/addArticle');
    }
}
