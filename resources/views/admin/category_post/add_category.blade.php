@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                  Thêm danh mục bài viết
                </header>
                <?php
                        $message = Session::get('message');
                        if($message){
                            echo $message ;
                            Session::put('message',null);
                        }
                    ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/save-category-post') }}" method="post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="cate_post_name"class="form-control" id="
                            slug" placeholder="Tên sản phẩm">
                        </div>
                     
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="cate_post_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Hiển thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                       
                        <button type="submit"  name="add_post_cate" class="btn btn-info">Thêm danh mục bài viết</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    @endsection