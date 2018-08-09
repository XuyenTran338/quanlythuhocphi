@extends('admin/layouts.master')
@section('title','Sinh viên')
@section('heading') 
    <i class="fas fa-graduation-cap" style="color:#16a291; font-size: 30px"></i>&nbsp;Sinh viên
@endsection  	
@section('content')

<div class="box">
    <header>
        <div class="icons"><i class="fas fa-th-list"></i></div>
        <h5>Danh sách sinh viên</h5>
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
        <div class="row" style="margin-bottom: 20px;margin-top: 10px">
            <div class="select_input col-sm-12">
                <div class="form-group col-sm-4">
                    <label class="label-control col-sm-8">Ngành học</label>
                    <div class="col-sm-12">
                        <select name="sltNganh" id="id_nganh" class="form-control select2"  data-live-search = "true">
                           @foreach($nganh as $obj)
                                <option value="{{ $obj->ma_nganh }}" @if(old('sltNganh') == $obj->ma_nganh) selected @endif>
                                    {{ $obj->ten_nganh }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="label-control col-sm-8">Khóa</label>
                    <div class="col-sm-12">
                        <select name="sltKhoa" class="form-control select2" id="id_khoa">
                            
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="label-control col-sm-8">Lớp học</label>
                    <div class="col-sm-12">
                        <select name="sltKhoa" class="form-control select2" id="id_lop">
                            
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="result">
            <!-- <table id="data_table" class="table table-bordered table-condensed table-hover table-striped">
                <thead>
                <tr style="color: white; background-color: #16a291;">
                    <th>Mã_SV</th>
                    <th>Họ và tên</th>
                    <th>Học bổng</th>
                    <th>Ngày sinh</th>
                    <th>Email</th>
                    <th>Giới tính</th>
                    <th>Số điện thoại</th>
                    <th>Hình thức nộp</th>
                    <th>Trạng thái</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($sinhvien as $obj)
                    <tr>
                        <td>{{ $obj->ma_sinh_vien }}</td>
                        <td>{{ $obj->ten_sinh_vien }}</td>
                        <td>{{ $obj->ty_le_phan_tram}}%</td>
                        <td>{{ date('d-m-Y', strtotime($obj->ngay_sinh)) }}</td>
                        <td>{{ $obj->email}}</td>
                        <td>
                            @if($obj->gioi_tinh == 1 )
                                {{ "Nam" }}
                            @else 
                                {{ "Nữ" }}
                            @endif
                        </td>
                        <td>{{ $obj->sdt }}</td>
                        <td>{{ $obj->ten_hinh_thuc }}</td>
                        <td>
                            @if($obj->trang_thai == 1 )
                                <p style="color: red">{{ "Còn học" }}</p>
                            @else 
                                <p style="color: green">{{ "Đã nghỉ" }}</p>
                            @endif
                        </td>
                        <td>
                            <div align="center"><a href="{{ route('getUpdate_students',$obj->ma_sinh_vien) }}" ><i class="fas fa-edit"></i></a>
                            </div>
                        </td>
                        <td>
                            <div align="center" class="delete"><a href="{{ route('delete_students',$obj->ma_sinh_vien)}}" onclick="return false" class="adel"><i class="fas fa-times-circle"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> -->
        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
    $('.select2').select2();
    function getDataTable(id)
    {
        $.get("admins/student/ajax_sinhvien/"+id,function(data){
            
            var html='';
            html+='<table id="data_table" class="table table-bordered table-condensed table-hover table-striped"><thead><tr style="color: white; background-color: #16a291;"><th>Mã_SV</th><th>Họ và tên</th><th>Học bổng</th><th>Ngày sinh</th><th>Email</th><th>Giới tính</th><th>Số điện thoại</th><th>Hình thức nộp</th><th>Trạng thái</th><th>Sửa</th><th>Xóa</th></tr></thead><tbody>';
            if(data.length > 0){
                $.each(data,function(key,value){
                    var gt='';
                    if(value.gioi_tinh == 1) gt='Nam'; else gt='Nữ';
                    html+='<tr>';

                    var tt='';
                    if(value.trang_thai == 1) tt='<p style="color: red">Còn học</p>'; else tt='<p style="color: green">Đã nghỉ</p>';
                    html+='<td>'+value.ma_sinh_vien+'</td>';
                    html+='<td>'+value.ten_sinh_vien+'</td>';
                    html+='<td>'+value.ty_le_phan_tram+'</td>';
                    html+='<td>'+value.ngay_sinh+'</td>';
                    html+='<td>'+value.email+'</td>';
                    html+='<td>'+gt+'</td>';
                    html+='<td>'+value.sdt+'</td>';
                    html+='<td>'+value.hinh_thuc+'</td>';
                    html+='<td>'+tt+'</td>';
                    html+='<td><div align="center"><a href="admins/student/update/'+value.ma_sinh_vien+'" ><i class="fas fa-edit"></i></a></div></td>';
                    html+='<td><div align="center" class="delete"><a href="admins/student/delete/'+value.ma_sinh_vien+'" onclick="return false" class="adel"><i class="fas fa-times-circle"></i></a></div></td>';
                });
                html+='</tbody></table>';
                $('#result').html(html);
                $('#data_table').DataTable({
                    destroy:true,
                    "language": {
                        "sProcessing":   "Đang xử lý...",
                        "sLengthMenu":   "Xem _MENU_ mục",
                        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                        "sInfoPostFix":  "",
                        "sSearch":       "Tìm:",
                        "sUrl":          "",
                        "oPaginate": {
                            "sFirst":    "Đầu",
                            "sPrevious": "Trước",
                            "sNext":     "Tiếp",
                            "sLast":     "Cuối"
                        }
                    }
                });
            }else{
                html+='<tr><td colspan="11" class="text-center">Không có dữ liệu</td></tr>';
                html+='</tbody></table>';
                $('#result').html(html);
            }
        });
    }
    $(document).ready(function() {
        var ma_nganh=$("#id_nganh").val();
        $.get("admins/student/ajax_khoa/"+ma_nganh,function(data){
            var html='';
            $.each(data.khoa,function(key,value){
                var start= new Date(value.ngay_bat_dau);
                var end= new Date(value.ngay_ket_thuc);
                start=start.getFullYear();
                end=end.getFullYear();
                html+='<option value='+value.khoa_hoc_ma+'>'+ value.ten_khoa_hoc+'___Niên học:'+start+'-'+end+'</option>';
            });
            $('#id_khoa').html(html);

            var ma_khoa=$("#id_khoa").val();
            $.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
                var html='';
                $.each(data,function(key,value){
                    html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'____Sĩ số: '+value.si_so_now+'/'+value.si_so+'</option>';
                });
                $('#id_lop').html(html);

                var ma_lop=$("#id_lop").val();
                getDataTable(ma_lop);
            });
        });

        $("#id_nganh").change(function(){
            var ma_nganh = $(this).val();
            $.get("admins/student/ajax_khoa/"+ma_nganh,function(data){
                var html='';
                $.each(data.khoa,function(key,value){
                    var start= new Date(value.ngay_bat_dau);
                    var end= new Date(value.ngay_ket_thuc);
                    start=start.getFullYear();
                    end=end.getFullYear();
                    html+='<option value='+value.khoa_hoc_ma+'>'+ value.ten_khoa_hoc+'___Niên học:'+start+'-'+end+'</option>';
                });
                $('#id_khoa').html(html);

                var ma_khoa=$("#id_khoa").val();
                $.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
                    var html='';
                    $.each(data,function(key,value){
                        html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'____Sĩ số: '+value.si_so_now+'/'+value.si_so+'</option>';
                    });
                    $('#id_lop').html(html);

                    var ma_lop=$("#id_lop").val();
                    getDataTable(ma_lop);
                });
            });
        });

        $("#id_khoa").change(function(){
            var ma_khoa=$(this).val();
            $.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
                var html='';
                $.each(data,function(key,value){
                    html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'____Sĩ số: '+value.si_so_now+'/'+value.si_so+'</option>';
                });
                $('#id_lop').html(html);

                var ma_lop=$("#id_lop").val();
                getDataTable(ma_lop);
            });
        });

        $("#id_lop").change(function(){
            var ma_lop=$(this).val();
            getDataTable(ma_lop);
        });
    });
   
</script>

<script type="text/javascript">
    $(document).on('click','.delete',function(e){
        var obj = $(this);
        $(this).children('.adel').attr("onclick","");  
        swal({
          title: "Bạn chắc chắn muốn xóa sinh viên?",
          text: "Khi xóa sẽ mất hết mọi dữ liệu liên quan đến sinh viên như phiếu thu",
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