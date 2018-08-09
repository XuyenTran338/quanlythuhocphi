@extends('admin/layouts.master')
@section('title','Mức thu')
@section('heading') 
    <i class="fas fa-donate" style="color:#16a291; font-size: 30px"></i>&nbsp;Mức thu
@endsection  	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-th-list"></i></div>
        <h5>Danh sách mức thu</h5>
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
                <th>Mã mức thu</th>
                <th>Tên ngành</th>
                <th>Hình thức nộp</th>
                <th>Tỷ lệ ưu đãi</th>
                <th>Mức thu qui định</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($hinhthuc as $obj)
                <tr>
                    <td>{{ $obj->ma_muc_thu }}</td>
                    <td>{{ $obj->ten_nganh }}</td>
                    <td>{{ $obj->ten_hinh_thuc }}</td>
                    <td>{{ $obj->ty_le_giam }}%</td>
                    <td>{{ number_format( $obj->muc_thu_qui_dinh,0,",",".")." "}} VND</td>
                    <td>
                        <div align="center"><a href="{{ route('getUpdate_fee',$obj->ma_muc_thu) }}" ><i class="fas fa-edit"></i></a>
                        </div>
                    </td>
                    <td>
                        <div align="center" class="delete"><a href="{{ route('delete_fee',$obj->ma_muc_thu)}}" onclick="return false" class="adel"><i class="fas fa-times-circle"></i></a>
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
          title: "Bạn chắc chắn muốn xóa mức thu?",
          text: "Khi xóa sẽ mất hết mọi dữ liệu liên quan đến học bổng như sinh viên, phiếu thu...!",
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