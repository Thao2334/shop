<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use App\Http\Requests;
use App\Models\Comment ;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Comment as PhpParserComment;

session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
        return Redirect::to('dashboard');

        }else{
            return Redirect::to('admin')->send();
        } 
    }
    

    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_parent_comment = $data['comment_parent_comment'];
        $comment->comment_status = 0;
        $comment->comment_name = 'Lê Thảo';
        $comment->save();
    }
    
        
    
    
    public function list_comment(){
        $comment = Comment::orderBy('comment_status','DESC')->get();
        // return redirect('/index-comment')->with(compact('comment'));
        return view('pages.comment.list_comment')->with(compact('comment'));
    }


    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
       
    }
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->get();
        $output = '';
       foreach($comment as $key => $comm){
            $output.= '	<div class="row style_comment">
            <div class="col-md-2">
                <input type="hidden" name="comment_product_id" class="comment_product_id" >
                <img width="100%" src="'.url('/public/frontend/assets/images/batman.png').'">
            </div>

            <div class="col-md-10">
                <p style="color:blue">'.$comm->comment_name.'</p>
                <p style="color:#000">@'.$comm->comment_date.'</p>
                <p> '.$comm->comment.'
                </p>
            </div>
        </div>';
       }
       echo $output;
    }


    






    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->orderby('tbl_product.product_id','desc')->get();

        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName() ;
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image'] ='';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');



        // sl;'dksaksad';sâ;sd;;alsd;qe;sld;sak;zlkx;a;dk;sdaaa
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        // DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        // Session::put('message','Không kích hoạt  sản phẩm thành công');
        // return Redirect::to('all-product');
       
    }

    public function active_product($product_id){
        $this->AuthLogin();
        // DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        // Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        // return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        // $cate_product = DB::table('tbl_product')->orderby('category_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_category_product(Request $request ,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        return Redirect::to('all-category-product');

    }
}
