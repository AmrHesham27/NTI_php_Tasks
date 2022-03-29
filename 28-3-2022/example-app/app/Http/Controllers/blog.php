<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class blog extends Controller
{
    public function index()
    {
        $articles = DB::select("SELECT * FROM articles AS a LEFT JOIN writers AS w
        ON a.writer_id = w.id");

        return view('/blog', ['articles' => $articles]);
    }
}
