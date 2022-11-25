<?php

namespace App\Http\Controllers;
use DB;
use App\Slider;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Http\Requests;
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
        $data =  $request->all();
       $category_post = new CategoryPost();
       $category_post->cate_post_name = $data ['cate_post_name'];
       $category_post->cate_post_desc = $data ['cate_post_desc'];
       $category_post->cate_post_status = $data ['cate_post_status'];
       $category_post->save();
        Session::put('message','Thêm bài viết thành công');
        return redirect()->back();
    }

    public function all_category_post(){
        $this->AuthLogin();

        $category_post = CategoryPost::orderBy('cate_post_id','DESC')->paginate(3);
            return view('admin.category_post.list_category')->with(compact('category_post'));


         
    }

    public function edit_category_post($category_post_id){
        $this->AuthLogin();
    $category_post =  CategoryPost::find($category_post_id);
       
        return view('admin.category_post.edit_category')->with(compact('category_post'));
    }


    public function update_category_post(Request $request, $cate_id){
        $data =  $request->all();
        $category_post =  CategoryPost::find($cate_id);
        $category_post->cate_post_name = $data ['cate_post_name'];
        $category_post->cate_post_desc = $data ['cate_post_desc'];
        $category_post->cate_post_status = $data ['cate_post_status'];
        $category_post->save();
         Session::put('message','Cập nhật bài viết thành công');
         return redirect('/all-category-post');
    }


    public function delete_category_post( $cate_id){
        $category_post =  CategoryPost::find($cate_id);
        $category_post->delete();
        Session::put('message','xóa bài viết thành công');
        return redirect()->back();
    }
    public function danh_muc_bai_viet(){

    }

}
