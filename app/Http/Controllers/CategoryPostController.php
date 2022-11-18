<?php

namespace App\Http\Controllers;
use DB;
use App\Slider;
use App\CategoryPost;

use Illuminate\Http\Request;
use Session;
session_start();
use Illuminate\Support\Facades\Redirect;

class CategoryPostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
        return Redirect::to('dashboard');

        }else{
            return Redirect::to('admin')->send();
        } 
    }
    public function add_category_post(){
        $this->AuthLogin();
        return view('admin.category_post.add_category');
    }


    public function save_category_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $category_post = new CategoryPost();
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];

        $category_post->save();


        Session::put('message','Thêm sản phẩm thành công');
        return Redirect()->back;
    }
}
