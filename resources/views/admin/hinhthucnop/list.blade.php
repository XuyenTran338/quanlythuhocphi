@extends('admin/layouts.master')
@section('title','Hình thức')
@section('heading') 
    <i class="fas fa-clipboard-list" style="color:#16a291; font-size: 30px"></i>&nbsp;Hình thức nộp
@endsection  	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-th-list"></i></div>
        <h5>Danh sách hình thức nộp</h5>
        <!-- .toolbar -->
        <div class="toolbar">
          <nav style="padding: 8px;">
              <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                  <i class="fa fa-minus"></i>
              </a>
              <a href="javascript:;" class="btn btn-default btn-xs full-box">
                  <i class="fa fa-expand"></i>
              </a>
              <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                  <i class="fa fa-times"></i>
              </a>
          </nav>
        </div>
        <!-- /.toolbar -->
    </header>
    <div id="collapse4" class="body">
        <table id="data_table" class="table table-bordered table-condensed table-hover table-striped">
            <thead>
            <tr style="color: white; background-color: #16a291;">
                <th>Mã</th>
                <th width="160">Tên hình thức</th>
                <th>Số tháng</th>
                <th>Tỷ lệ ưu đãi</th>
                <th width="300">Ghi chú</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($hinhthuc as $obj)
                <tr>
                    <td>{{ $obj->ma_hinh_thuc }}</td>
                    <td>{{ $obj->ten_hinh_thuc }}</td>
                    <td>{{ $obj->so_thang }} (tháng)</td>
                    <td>{{ $obj->ty_le_giam }}%</td>
                    <td>{{ $obj->ghi_chu }}</td>
                    <td>
                        <div align="center"><a href="{{ route('getUpdate_payment',$obj->ma_hinh_thuc) }}" ><i class="fas fa-edit"></i></a>
                        </div>
                    </td>
                    <td>
                        <div align="center" class="delete"><a href="{{ route('delete_payment',$obj->ma_hinh_thuc)}}" onclick="return false"  class="adel"><i class="fas fa-times-circle"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).on('click','.delete',function(e){
        var obj = $(this);
        $(this).children('.adel').attr("onclick","");  
        swal({
          title: "Bạn chắc chắn muốn xóa hình thức nộp?",
          text: "Khi xóa sẽ mất hết mọi dữ liệu liên quan đến học bổng nhưmức thu,phiếu thu, ...!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Delete!",
          cancelButtonText: "Cancel",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) { 
            obj.children('.adel')[0].click();  
          } else {
            obj.children('.adel').attr("onclick","return false")
          }
        });
    });
</script>
@if(session('messages'))
    <script type="text/javascript">
        $(document).ready(function(){
            swal("Thành công!",'{{session('messages')}}', "success");
        });
    </script>
@endif

@if(session('messages_error'))
    <script type="text/javascript">
        $(document).ready(function(){
            swal("Có lỗi!",'{{session('messages_error')}}', "error");
        });
    </script>
@endif

@endsection