@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Tất cả bình luận
      </div>
    <div id="notify_comment"></div>

      <div class="table-responsive">
        <?php
        $message = Session::get('message');
        if($message){
            echo $message ;
            Session::put('message',null);
        }
    ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>

              <th>Duyệt</th>
              <th>Tên người gửi </th>
              <th>Bình luận </th>
              <th>Ngày gửi</th>
              {{-- <th>Sản phẩm </th>  --}}
              {{-- SẢN PHẨM CHƯA CÓ  --}}
              <th>Quản lý</th>
             
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($comment as $key => $comm)
                
            <tr>
              
              <td>
                @if($comm->comment_status==1)
                  <input type="button" data-comment_status="0" data-comment_id="{{$comm->comment_id }}"  class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt">
                @else
                <input type="button" data-comment_status="0" data-comment_id="{{$comm->comment_id }}"  class="btn btn-danger btn-xs comment_boduyet_btn" value="Bỏ Duyệt">
                @endif
                
              </td>
              <td>{{ $comm->comment_name }}</td>
              <td>{{ $comm->comment }} 

                @if($comm->comment_status==0)
                  
                <br/><textarea class="form-control reply_comment" rows="5" ></textarea>
                <br/> <button class="btn btn-default btn-xs btn-reply-comment" data-comment_id="{{$comm->comment_id }}"  >Trả lời</button>
                
                @endif

                
              </td>
             
           


              <td>{{ $comm->comment_date }}</td>
              {{-- <td>{{ $comm->comment_product_id }}</td> --}}
             

              {{-- <td><span class="text-ellipsis">
                <?php
                 if($pro->product_status == 0){
                  ?>
                  <a href="{{ URL::to('/unactive-product/'.$pro->product_id) }}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                   <?php
                 }else {
                  ?>
                    <a href="{{ URL::to('/active-product/'.$pro->product_id) }}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                    <?php

                 }
                 ?>

            
              
            </span></td> --}}
             
              <td>
                <a href="" class="active styling-edit" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                  <a onclick="return confirm('Bạn có chắc là muốn xóa bình luận này không ?')" href="" class="active styling-edit" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i></a>
              </td>
            </tr>
           @endforeach
          </tbody>
        </table>
      </div>
      {{-- <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer> --}}

      {{-- {{  $comment->links() }} --}}
    </div>
  </div>
    @endsection