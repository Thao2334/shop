<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Redirect;
session_start();


class HomeController extends Controller
{
    public function index(Request $request){
        $category_post = CategoryPost::orderBy('cate_post_id','DESC')->get();

        return view ('welcome')->with('category_post',$category_post);
        }

        
       
}
