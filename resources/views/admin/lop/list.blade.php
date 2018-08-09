@extends('admin/layouts.master')
@section('title','Lớp học')
@section('heading') 
    <i class="fas fa-book" style="color:#16a291; font-size: 30px"></i>&nbsp;Lớp học
@endsection  	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-th-list"></i></div>
        <h5>Danh sách lớp học</h5>
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
                <th>Mã lớp học</th>
                <th>Tên lớp học</th>
                <th>Ngành học</th>
                <th>Khóa học</th>
                <th>Sĩ số</th>
                <th>Giáo viên chủ nhiểm</th>
                <th>Trạng thái</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($lop as $obj)
                <tr>
                    <td>{{ $obj->ma_lop }}</td>
                    <td>{{ $obj->ten_lop }}</td>
                    <td>{{ $obj->ten_nganh }}</td>
                    <td>{{ $obj->ten_khoa_hoc}}</td>
                    <td>{{ $obj->si_so}}</td>
                    <td>
                        @if($obj->giao_vien_chu_nhiem == 1 )
                            {{ 'Phạm Văn Hiệp'}}
                        @elseif($obj->giao_vien_chu_nhiem == 2 )
                            {{ 'Nguyễn Thị Nga' }}
                        @elseif($obj->giao_vien_chu_nhiem == 3 )
                            {{ 'Vũ Thị Lan Anh' }}
                        @elseif($obj->giao_vien_chu_nhiem == 4 )
                            {{ 'Trần Quốc Tuấn' }}
                        @else {{ 'Nguyễn Văn Duy' }}
                        @endif
                    </td>
                    <td>
                            @if($obj->trang_thai == 1 )
                                <p style="color: red">{{ "Còn học" }}</p>
                            @else 
                                <p style="color: green">{{ "Kết thúc" }}</p>
                            @endif
                        </td>
                    <td>
                        <div align="center"><a href="{{ route('getUpdate_classes',$obj->ma_lop) }}" ><i class="fas fa-edit"></i></a>
                        </div>
                    </td>
                    <td>
                        <div align="center" class="delete"><a href="{{ route('delete_classes',$obj->ma_lop)}}" onclick="return false" class="adel"><i class="fas fa-times-circle"></i></a>
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
          title: "Bạn chắc chắn muốn xóa lớp học?",
          text: "Khi xóa sẽ mất hết mọi dữ liệu liên quan đến lớp học như sinh viên, biên lai...!",
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