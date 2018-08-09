@extends('admin/layouts.master')
@section('title','Ngành học')
@section('heading') 
    <i class="fab fa-readme" style="color:#16a291; font-size: 30px"></i>&nbsp;Ngành học
@endsection  	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-th-list"></i></div>
        <h5>Danh sách ngành học</h5>
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
                <th>STT</th>
                <th>Tên ngành</th>
                <th>Hệ đào tạo</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach($nganh as $obj)
                <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td>{{ $obj->ten_nganh }}</td>
                    <td>{{ $obj->he_dao_tao }}</td>
                    <td>
                        <div align="center"><a href="{{ route('getUpdate_majors',$obj->ma_nganh) }}" ><i class="fas fa-edit"></i></a>
                        </div>
                    </td>
                    <td>
                        <div align="center" class="delete">
                            <a href="{{ route('delete_majors',$obj->ma_nganh)}}" onclick="return false" class="adel"><i class="fas fa-times-circle"></i></a>
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
          title: "Bạn chắc chắn muốn xóa ngành học?",
          text: "Khi xóa sẽ mất hết mọi dữ liệu liên quan đến Ngành học như lớp, sinh viên, biên lai, mức thu trong Ngành học đó!",
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