@extends('admin/layouts.master')
@section('title','Khóa học')
@section('heading') 
    <i class="fab fa-leanpub" style="color:#16a291; font-size: 30px"></i>&nbsp;Khóa học
@endsection  	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-th-list"></i></div>
        <h5>Danh sách khóa học</h5>
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
                <th>Mã khóa học</th>
                <th>Tên khóa học</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($khoahoc as $obj)
                <tr>
                    <td>{{ $obj->ma_khoa_hoc }}</td>
                    <td>{{ $obj->ten_khoa_hoc }}</td>
                    <td>{{ date('d-m-Y', strtotime($obj->ngay_bat_dau)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($obj->ngay_ket_thuc))}}</td>
                    <td>
                        <div align="center"><a href="{{ route('getUpdate_course',$obj->ma_khoa_hoc) }}" ><i class="fas fa-edit"></i></a>
                        </div>
                    </td>
                    <td>
                        <div align="center" class="delete"><a href="{{ route('delete_course',$obj->ma_khoa_hoc)}}" onclick="return false" class="adel"><i class="fas fa-times-circle"></i></a>
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
          title: "Bạn chắc chắn muốn xóa khóa học?",
          text: "Khi xóa sẽ mất hết mọi dữ liệu liên quan đến khóa học như lớp, sinh viên, biên lai...!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Delete!",
          cancelButtonText: "Cancel",
          closeOnConfirm: true,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) { 
            obj.children('.adel')[0].click();  
          } else {
            swal("Nhắc nhở", "Thao tác xóa đã được hủy !", "error");
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