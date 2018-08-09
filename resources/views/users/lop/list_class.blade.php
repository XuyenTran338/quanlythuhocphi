@extends('users.layouts.master')
@section('title','Danh sách Lớp học')

@section('content')
<style type="text/css">
    td:nth-child(11){
        color: hsl(0, 100%, 40%);
        font-weight: bold;
    }
</style>
<header class="header_main">
	<i class="fas fa-book"></i>&nbsp;&nbsp;Lớp Học
</header>
<div class="content_main">
	<div class="row">
		<div class="select_input col-sm-12">
			<div class="form-group col-sm-4">
				<label class="label-control col-sm-8">Ngành học</label>
				<div class="col-sm-12">
					<select name="sltNganh" class=" form-control select2"  id="id_nganh">
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
		</div>
	</div>
	<div class="row">
		<div class="button_function col-sm-12">
		<!--	<button type="button" class="btn btn_color " data-toggle="modal" data-target="#model_excel"><i class="fas fa-file-excel icon_color"></i> &nbsp; Import&nbsp; <i class="fas fa-upload"></i></button>
			<div id="model_excel" class="modal fade" tabindex="-1" role="dialog">
				<form action="{{ route('postExcel') }}" class="form-control" method="post" enctype="multipart/form-data">
		        <div class="modal-dialog ">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                    <h4 class="modal-title"><i class="fas fa-upload"></i>&nbsp; Import File Excel </h4>
		                </div>
		                <div class="modal-body">
		                   		<input type="hidden" name="_token" value="{{csrf_token()}}">
		                   		<input type="file" name="import_file">
		                   		<span> </span>
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                    <button type="submit" class="btn btn-primary">Import File</button>
		                    
		                </div>
		            </div>
		        </div>
		        </form>
		    </div> -->
			<button type="button" class="btn btn_color export" data-toggle="tooltip" data-placement="top" title="Export"><i class="fas fa-file-excel icon_color"></i> &nbsp; Export</button>
			<button type="button" id="view_ajax_lop" class="btn btn_color"  data-toggle="modal" data-target="#model_print"><i class="fas fa-print icon_color"></i> &nbsp; In</button>

			@include('users.lop.print_list')
			<!-- <button type="button" class="btn btn_color"><i class="fas fa-sync-alt icon_color"></i> &nbsp; Tải lại</button> -->
		</div>
	</div>
</div><br>
	<div class="row">
		<div class="col-sm-12"  style="background-color: white; padding-top: 10px; border: 5px solid #4a7da3; border-radius: 10px">
			<table id="data_table" class="table table-hover table-striped table-bordered table-condensed table-responsive table_lop" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr style="background-color: hsl(163, 81%, 90%);">
						<th>STT</th>
						<th>Mã Lớp</th>
		                <th>Tên Lớp</th>
		                <th>Sĩ số</th>
		                <th>Giáo viên chủ nhiệm</th>
		                <th>Ngày bắt đầu</th>
		                <th>Ngày kết thúc</th>
		                <th>Chuyên Ngành</th>
		                <th>Hệ đào tạo</th>
		                <th>Khóa học</th>
		                <th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
		    </table>
		</div>
	</div>
	
@endsection

@section('script')
<script>
	function getDataTable(id1,id2)
	{
		$('#data_table').DataTable({
			destroy:true,
			processing:true,
	        serverSide:true,
	        ajax :"users/class/ajax_lop/"+id1+"/"+id2,
	        columns:[
	        	{data : "stt"},
	       		{data : "ma_lop"},
	       		{data : "ten_lop"},
	       		{data : "si_so"},
	       		{data : "giao_vien_chu_nhiem"},
	       		{data : "ngay_bat_dau"},
	       		{data : "ngay_ket_thuc"},
	       		{data : "ten_nganh"},
	       		{data : "he_dao_tao"},
	       		{data : "ten_khoa_hoc"},
	       		{data : "trang_thai"}
	        ],
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
	}

	/*function getAllData()
	{
		$('#data_table').DataTable({
			destroy:true,
	        serverSide:true,
	        ajax :"users/class/list_class",
	        columns:[
	        	{data : "stt"},
	       		{data : "ma_lop"},
	       		{data : "ten_lop"},
	       		{data : "si_so"},
	       		{data : "giao_vien_chu_nhiem"},
	       		{data : "ngay_bat_dau"},
	       		{data : "ngay_ket_thuc"},
	       		{data : "ten_nganh"},
	       		{data : "he_dao_tao"},
	       		{data : "ten_khoa_hoc"},
	       		{data : "trang_thai"}
	        ],
		});
	}*/
	/*if($("#id_nganh").val() == 'all')
	{
		$(document).ready(function(){
			getAllData();
		});
	}*/
	$(document).ready(function(){
		var ma_nganh=$("#id_nganh").val();
		$.get("users/class/ajax_khoa/"+ma_nganh,function(data){
			var html='';
			$.each(data,function(key,value){
                var start= new Date(value.ngay_bat_dau);
                var end= new Date(value.ngay_ket_thuc);
                start=start.getFullYear();
                end=end.getFullYear();
                html+='<option value='+value.khoa_hoc_ma+'>'+ value.ten_khoa_hoc+'___Niên học:'+start+'-'+end+'</option>';
            });
			$("#id_khoa").html(html);
			var ma_khoa = $("#id_khoa").val();
			getDataTable(ma_nganh,ma_khoa);
		});

		$("#id_nganh").change(function(){
			var ma_nganh=$(this).val();
			/*if(ma_nganh == 'all')
			{
				$("#id_khoa").html('');
				getAllData();
			}
			else{*/
				$.get("users/class/ajax_khoa/"+ma_nganh,function(data){
					var html='';
					$.each(data,function(key,value){
		                var start= new Date(value.ngay_bat_dau);
		                var end= new Date(value.ngay_ket_thuc);
		                start=start.getFullYear();
		                end=end.getFullYear();
		                html+='<option value='+value.khoa_hoc_ma+'>'+ value.ten_khoa_hoc+'___Niên học:'+start+'-'+end+'</option>';
		            });
					$("#id_khoa").html(html);
					var ma_khoa = $("#id_khoa").val();
					getDataTable(ma_nganh,ma_khoa);
				});
			// }
		});

		$("#id_khoa").change(function(){
			var ma_khoa = $(this).val();
			var ma_nganh = $("#id_nganh").val();
			getDataTable(ma_nganh,ma_khoa);
		});
	});

	$("#view_ajax_lop").on('click',function(){
		var ma_nganh=$("#id_nganh").val();
		var ma_khoa = $("#id_khoa").val();
		/*if(ma_nganh == 'all')
		{
			$.getJSON("users/class/list_class_print",function(data){
				var html='';
				html+='<table id="table_print" class="table table-hover table-striped table-bordered table-condensed table-responsive table_export" border="1" cellpadding="5" cellspacing="0" align="center">';
				html+='<thead>';
					html+='<tr style="background-color: hsl(163, 81%, 90%);">';
						html+='<th>STT</th>';
						html+='<th>Mã Lớp</th>';
						html+='<th>Tên Lớp</th>';
						html+='<th>Sĩ số</th>';
						html+='<th>Giáo viên chủ nhiệm</th>';
						html+='<th>Ngày nhập học</th>';
						html+='<th>Ngày kết thúc</th>';
						html+='<th>Chuyên Ngành</th>';
						html+='<th>Hệ đào tạo</th>';
						html+='<th>Khóa học</th>';
						html+='<th>Trạng thái</th>';
					html+='</tr>';
				html+='</thead>';
				html+='<tbody>';
				$.each(data,function(key,value){
					var tt="";
					var gv="";
					if(value.trang_thai == 1)
						tt="Còn học";
					else tt="Kết thúc";

					if(value.giao_vien_chu_nhiem == 1)
						gv="Phạm Văn Hiệp";
					else if(value.giao_vien_chu_nhiem == 2)
						gv="Nguyễn Thị Nga";
					else if(value.giao_vien_chu_nhiem == 3)
						gv="Vũ Thị Lan Anh";
					else if(value.giao_vien_chu_nhiem == 4)
						gv="Trần Quốc Tuấn";
					else gv="Nguyễn Văn Duy";
					var start=value.ngay_bat_dau;
					var end=value.ngay_ket_thuc;
					 html +=  '<tr>';
	                    html +=  '<td>';
	                    	html+= (key+1);
	                    html +=  '</td>';
	                    html +=  '<td>' + value.ma_lop + '</td>';
	                    html +=  '<td>' + value.ten_lop + '</td>';
	                    html +=  '<td>' + value.si_so + '</td>';
	                    html +=  '<td>' + gv + '</td>';
	                    html +=  '<td>' + start + '</td>';
	                    html +=  '<td>' + end +'</td>';
	                    html +=  '<td>' + value.ten_nganh + '</td>';
	                    html +=  '<td>' + value.he_dao_tao + '</td>';
	                    html +=  '<td>' + value.ten_khoa_hoc + '</td>';
	                    html +=  '<td>' + tt + '</td>';
	                html +=  '</tr>';
				});
				html+='</tbody>';
				$('#data_all').html(html);
			});
		}*/

		$.getJSON("users/class/list_class_print/"+ma_nganh+"/"+ma_khoa,function(data){
			$.get("users/class/ajax_khoa/"+ma_nganh+"/"+ma_khoa,function(title){
				$("#title").html(title);
			});
			var html='';
			$.each(data,function(key,value){
				var tt="";
				var gv="";
				if(value.trang_thai == 1)
					tt="Còn học";
				else tt="Kết thúc";

				if(value.giao_vien_chu_nhiem == 1)
					gv="Phạm Văn Hiệp";
				else if(value.giao_vien_chu_nhiem == 2)
					gv="Nguyễn Thị Nga";
				else if(value.giao_vien_chu_nhiem == 3)
					gv="Vũ Thị Lan Anh";
				else if(value.giao_vien_chu_nhiem == 4)
					gv="Trần Quốc Tuấn";
				else gv="Nguyễn Văn Duy";
				var start=new Date(value.ngay_bat_dau);
				start = start.getDate() + '/' +(start.getMonth()+1) + '/' + start.getFullYear();
				var end= new Date(value.ngay_ket_thuc);
				end = end.getDate() + '/' +(end.getMonth()+1)+ '/' + end.getFullYear();

				 html +=  '<tr>';
		            html +=  '<td>';
		            	html+= (key+1);
		            html +=  '</td>';
		            html +=  '<td>' + value.ma_lop + '</td>';
		            html +=  '<td>' + value.ten_lop + '</td>';
		            html +=  '<td>' + value.si_so + '</td>';
		            html +=  '<td>' + gv + '</td>';
		            html +=  '<td>' + start + '</td>';
		            html +=  '<td>' + end +'</td>';
		            html +=  '<td>' + tt + '</td>';
		        html +=  '</tr>';
			});
			$('#data_lop').html(html);
		});
		
	});
</script>

<script type="text/javascript">
   	$(document).ready(function(){
   		$('.export').click(function(){
			$("#data_table").table2excel({
				exclude: ".noExl",
				name: "Excel Document Name",
				filename: "Danh sach lop" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
				fileext: ".xls",
				exclude_img: true,
				exclude_links: true,
				exclude_inputs: true
			});
		});
	});

	$(document).ready(function(){
   		$('#save_excel').click(function(){
			$("#table_print").table2excel({
				exclude: ".noExl",
				name: "Excel Document Name",
				filename: "Danh sach lop" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
				fileext: ".xls",
				exclude_img: true,
				exclude_links: true,
				exclude_inputs: true
			});
		});
	});

	function printData()
	{
	   var data_print=document.getElementById("content_print");
	   newWin= window.open("");
	   newWin.document.write(data_print.outerHTML);
	   newWin.print();
	   newWin.close();
	}

	$('#print').on('click',function(){
		printData();
	});

</script>


@endsection
