@extends('admin/layouts.master')
@section('title','Tài khoản')
@section('heading') 
    <i class="fas fa-user-circle" style="color:#16a291 ; font-size: 30px"></i>&nbsp;Tài khoản
@endsection  	
@section('content')

<script type="text/javascript">
    function ConfirmDelete(){
        return confirm("Bạn chắc chắn muốn xóa tài khoản?")
    }
</script>
<div class="box">
    <header>
        <div class="icons"><i class="fas fa-address-book"></i></div>
        <h5>Danh sách tài khoản</h5>
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
    <!-- id="data_table" -->
    <div id="collapse4" class="body">
        <table id="data_table" class="table  table-bordered table-condensed table-hover table-striped">
            <thead>
            <tr style="color: white; background-color: #16a291;">
                <th>Tên tài khoản</th>
                <th>Email</th>
                <th>Phân quyền</th>
                <th>Họ và tên</th>
                <th>Giới tính</th>
                <th>SDT</th>
                <th>Last Access</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($list_user as $obj)
                <tr>
                    <td>
                        <br>
                        <div style="text-align: center;">
                            <img src="admin/public/assets/img/{{ $obj->image }}" width="50" style="border-radius: 100%; border: 1px solid #ccc">
                        </div>
                        <p align="center">{{ $obj->ten_tai_khoan }}</p>
                    </td>
                    <td>{{ $obj->email }}</td>
                    <td>
                        @if($obj->phan_quyen == 1)
                            <p style="color: red">{{ "Admin" }}</p>
                        @elseif($obj->phan_quyen == 2)
                            <p style="color: blue">{{ "Gíáo vụ" }}</p>
                        @endif
                    </td>
                    <td>{{ $obj->ho_ten }}</td>
                    <td>
                        @if($obj->gioi_tinh == 1 )
                            {{ "Nam" }}
                        @else 
                            {{ "Nữ" }}
                        @endif
                    </td>
                    <td>{{ $obj->SDT }}</td>
                    <td>
                        <?php \Carbon\Carbon::setLocale('vi') ?>
                        @if($obj->lan_truy_cap_cuoi != null)
                            {{date('d-m-Y h:i:s A', strtotime($obj->lan_truy_cap_cuoi))}}<br>
                        @else
                            {{"00-00-0000 0:0:0"}}
                        @endif
                    </td>
                    <td>
                        <div align="center"><a href="{{ route('getUpdate_user',$obj->ma_tai_khoan) }}" ><i class="fas fa-edit"></i></a>
                        </div>
                    </td>
                    <td>
                        <div align="center"><a href="{{ route('delete_user',$obj->ma_tai_khoan)}}" onclick="return ConfirmDelete()"><i class="fas fa-times-circle"></i></a>
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