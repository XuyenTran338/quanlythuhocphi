@extends('users.layouts.master')
@section('title','Thu phí')
@section('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
@endsection
@section('content')
<style type="text/css">
    td:nth-child(n+6):nth-child(-n+8) {
        color: hsl(0, 100%, 40%);
        font-weight: bold;
    }
</style>
<header class="header_main">
	<i class="fas fa-donate"></i>&nbsp;&nbsp;Thu phí
</header>
<div class="content_main">
	<div class="row">
		<div class="select_input col-sm-12">
			<div class="form-group col-sm-4">
				<label class="label-control col-sm-8">Ngành học</label>
				<div class="col-sm-12">
					<select name="sltNganh" id="id_nganh" class="form-control select2" >
						@foreach($nganh as $obj)
							<option value="{{ $obj->ma_nganh }}" >
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
					<select name="sltLop" class="form-control select2"   id="id_lop">
						
					</select>
				</div>
			</div>
		</div>
		<div class="select_input col-sm-12">
			<div class="form-group col-sm-5">
				<label class="label-control col-sm-4">Học viên</label>
				<div class="col-sm-12" >
					<select name="sltSV" class="form-control select2"  id="id_sinh_vien">

					</select>
				</div>
			</div>
			<div class="form-group col-sm-4">
				<label class="label-control col-sm-5">Ngày thu</label>
				<div class="col-sm-8">
					<?php 
						$today= new \Carbon\Carbon;
					?>
					<input type="text" name="today" class="form-control" value="{{ date('d-m-Y', strtotime($today)) }}" readonly id="today">
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="button_function col-sm-12">
			<button type="button" id="button_thu" class="btn btn_color "><i class="fas fa-hand-holding-usd icon_color"></i> &nbsp; Thu phí</button>
			@include('users/thuphi/insert')
			@include('users/thuphi/in_phieu_thu')
			<!-- <button type="button" class="btn btn_color " data-toggle="tooltip" data-placement="top" title="Export File Excel"><i class="fas fa-file-excel icon_color"></i> &nbsp; Export</button>-->
			<!-- <button type="button" id="print" class="btn btn_color" data-toggle="tooltip" data-placement="top" title="Print"><i class="fas fa-print icon_color"></i> &nbsp; In</button> -->
			<!--<button type="button" class="btn btn_color"><i class="fas fa-sync-alt icon_color"></i> &nbsp; Tải lại</button> -->
		</div>
	</div>
</div><br>
	<div class="row">
		<div class="col-sm-12" style="background-color: white; padding-top: 13px; border: 5px solid #4a7da3; border-radius: 10px">
			<table id="data_table" class="table table-hover table-striped table-bordered table-condensed table-responsive" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr style="background-color: hsl(163, 81%, 90%);">
						<th>Lần thu</th>
						<th width="15%">Đợt thu</th>
						<th>Nhân viên thu</th>
				        <th>Ngày đóng</th>
				        <th>Hình thức nộp</th>
				        <!-- <th>Tiền qui định</th>-->
				        <th>Học bổng</th>
				        <th>Phí giảm</th>
				        <th>Số tiền đã nộp</th>
				      <!--   <th>Nội dung</th> -->
				    </tr>
			    </thead>
			    <tbody id="tbody">

			    </tbody>
			    <tfoot>
					<tr style="background-color: hsl(163, 81%, 90%);">
						<th>Lần thu</th>
						<th width="20%">Đợt thu</th>
						<th>Nhân viên thu</th>
				        <th>Ngày đóng</th>
				        <th>Hình thức nộp</th>
				        <!-- <th>Tiền qui định</th>-->
				        <th>Học bổng</th>
				        <th>Phí giảm</th>
				        <th>Số tiền đã nộp</th>
				       <!--  <th>Nội dung</th> -->
					</tr>
				</tfoot>

			</table>
		</div>
	</div>

	<!-- <div class="row" style="background-color: white; border: 2px solid #ccc; border-radius: 10px; margin-top: 10px;margin-bottom: 10px;">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<table class="table table-hover table-responsive" >
				<tr>
					<th>Tổng số tiền đã nộp</th>
					<td></td>
				</tr>
				<tr>
					<th>Tổng số tiền nộp thiếu</th>
					<td></td>
				</tr>
				<tr>
					<th>Tổng số phiếu thu</th>
					<td></td>
				</tr>
			</table>
		</div>
		<div class="col-sm-2"></div>
	</div>
	 -->
@endsection

@section('script')
<script src="{{ asset('user/public/js/doc_tien.js') }}"></script>
<script >
	$('body').css('padding','auto');
	function getDataTable(id)
	{
		$('#data_table').DataTable({
			destroy:true,
			draw:'full-reset',
			processing:true,
	        serverSide:true,
	        ajax :"users/receipt/ajax_phieu_thu/"+id,
	        columns:[
	        	{data : "lan_thu"},
	            {data : "noi_dung"},
	       		{data : "nguoi_thu"},
	       		{data : "thoi_gian_thu"},
	       		{data : "ten_hinh_thuc"},
	       		{data : "hoc_bong"},
	       		{data : "so_tien_giam"},
	       		{data : "so_tien_thu"}
	       		
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

	function formatNumber(num) {
	    return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
	}

	$(document).ready(function(){
		var ma_nganh = $("#id_nganh").val();
		$.get("users/receipt/ajax_khoa/"+ma_nganh,function(data){
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
			$.get("users/receipt/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
				var html='';
                $.each(data,function(key,value){
                    html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'</option>';
                });
                $('#id_lop').html(html);

				var ma_lop = $("#id_lop").val();
				$.get("users/receipt/ajax_sinhvien/"+ma_lop,function(data){
					if(data.check > 0)
					{
						var html='';
						$.each(data.sinhvien,function(key,value){
				            html+='<option value='+value.ma_sinh_vien+'>'+ value.ten_sinh_vien+'___'+value.ngay_sinh+'___SĐT:'+value.sdt+'</option>';
				        });
						$("#id_sinh_vien").html(html);						
					}else
					{
						var html='<option value=0>---Chưa có sinh viên---</option>';
						$("#id_sinh_vien").html(html);
					}
					var ma_sv= $("#id_sinh_vien").val();
					getDataTable(ma_sv);
				});
			});

		});

		$("#id_nganh").change(function(){
			var ma_nganh = $(this).val();
			$.get("users/receipt/ajax_khoa/"+ma_nganh,function(data){
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
				$.get("users/receipt/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
					var html='';
	                $.each(data,function(key,value){
	                    html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'</option>';
	                });
	                $('#id_lop').html(html);

					var ma_lop = $("#id_lop").val();
					$.get("users/receipt/ajax_sinhvien/"+ma_lop,function(data){
						if(data.check > 0)
						{
							var html='';
							$.each(data.sinhvien,function(key,value){
					            html+='<option value='+value.ma_sinh_vien+'>'+ value.ten_sinh_vien+'___'+value.ngay_sinh+'___SĐT:'+value.sdt+'</option>';
					        });
							$("#id_sinh_vien").html(html);						
						}else
						{
							var html='<option value=0>---Chưa có sinh viên---</option>';
							$("#id_sinh_vien").html(html);
						}

						var ma_sv= $("#id_sinh_vien").val();
						getDataTable(ma_sv);
					});
				});

			});
		
		});

		$("#id_khoa").change(function(){
			var ma_khoa = $(this).val();
			var ma_nganh=$("#id_nganh").val();
			$.get("users/receipt/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
				var html='';
                $.each(data,function(key,value){
                    html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'</option>';
                });
                $('#id_lop').html(html);

				var ma_lop = $("#id_lop").val();
				$.get("users/receipt/ajax_sinhvien/"+ma_lop,function(data){
					if(data.check > 0)
					{
						var html='';
						$.each(data.sinhvien,function(key,value){
				            html+='<option value='+value.ma_sinh_vien+'>'+ value.ten_sinh_vien+'___'+value.ngay_sinh+'___SĐT:'+value.sdt+'</option>';
				        });
						$("#id_sinh_vien").html(html);						
					}else
					{
						var html='<option value=0>---Chưa có sinh viên---</option>';
						$("#id_sinh_vien").html(html);
					}

					var ma_sv= $("#id_sinh_vien").val();
					getDataTable(ma_sv);
				});
			});
			
		});

		$("#id_lop").change(function(){
			var ma_lop=$(this).val();
			$.get("users/receipt/ajax_sinhvien/"+ma_lop,function(data){
				if(data.check > 0)
				{
					var html='';
					$.each(data.sinhvien,function(key,value){
			            html+='<option value='+value.ma_sinh_vien+'>'+ value.ten_sinh_vien+'___'+value.ngay_sinh+'___SĐT:'+value.sdt+'</option>';
			        });
					$("#id_sinh_vien").html(html);						
				}else
				{
					var html='<option value=0>---Chưa có sinh viên---</option>';
					$("#id_sinh_vien").html(html);
				}
				var ma_sv= $("#id_sinh_vien").val();
				getDataTable(ma_sv);
			});
		});

		$("#id_sinh_vien").change(function(){
			var ma_sv=$(this).val();
			getDataTable(ma_sv);
		});
	});

	$(document).ready(function(){
		$("#button_thu").click(function(){
			var today= new Date();
			var month=(today.getMonth()+1);
			// if(month > 5 && month <8)
			// {
			// 	swal("Nhắc nhở!",'Đây không phải là thời điểm để thu phí', "warning");
			// }else{
				var ma_sv= $("#id_sinh_vien").val();
				$.get("users/receipt/check/"+ma_sv,function(data){
					var dot_thu=data;
				
				if(ma_sv == 0)
				{
					swal("Nhắc nhở!",'Chưa chọn sinh viên để thu phí!', "warning");
				}else if(dot_thu == 30)
				{
					swal("Nhắc nhở!",'Học viên đã đóng học phí đủ 30 đợt thu!', "warning");
				}
				else
				{
					$("#ThuPhiModal").modal('show');
					$.get("users/receipt/ajax_hinhthuc/"+ma_sv,function(data){
						var html='';
						html+='<div class="form-group col-sm-9"><label>Học viên-Lớp học</label><input type="text" value="'+data.sinh_vien.ten_sinh_vien+'___ Lớp: '+data.sinh_vien.ten_lop+'" class="form-control" readonly placeholder="Tên Học Viên"></div>';
						html+='<div class="form-group col-sm-3"><label>Học bổng:</label><input type="text" id="hoc_bong" value='+data.sinh_vien.ty_le_phan_tram+'% class="form-control" readonly placeholder="Học bổng (VND)"></div>';
						html+='<div class="form-group col-sm-9"><label>Hình thức nộp:</label><select name="txtHinhThuc" class="form-control selectpicker" data-live-search="true" id="muc_thu">';
						if(data.count > 0)
						{
							$.each(data.hinh_thuc,function(key,value){
								html+='<option value ='+value.ma_muc_thu;
								if(value.ma_muc_thu == data.sinh_vien.muc_thu_ma)
								{
									html+=" selected";
								}
								html+='>'+value.ten_hinh_thuc+' có phí '+formatNumber(value.muc_thu_qui_dinh)+'(VND)</option>';
							});
			            	
						}/*else if(data.count ==1)
						{
							html+='<option value ='+data.hinh_thuc.ma_muc_thu+'>'+data.hinh_thuc.ten_hinh_thuc+' có phí '+formatNumber(data.hinh_thuc.muc_thu_qui_dinh)+'(VND)</option>';
						}*/else
						{
							html+='<option value ="0">---Chưa có hình thức thu---</option>';
						}
						html+='</select></div>';
	        			
		            	$("#result_1").html(html);
		            	$('.selectpicker').selectpicker();
						var ma_muc_thu=$("#muc_thu").val();
						$.get("users/receipt/ajax_phi_thu/"+ma_muc_thu+"/"+ma_sv,function(data){
							var html='';
							html+='<div class="form-group col-sm-3"><label>Tỷ lệ ưu đãi:</label><input type="text" value='+data.muc_thu.ty_le_giam+'% class="form-control" readonly placeholder="Ưu đãi(%)"></div>';
							html+='<div class="form-group col-sm-12"><label>Số tiền đã nộp - Số tiền cần nộp còn lại:</label><input type="text" value="'+data.da_nop+' VND - '+ data.con_lai+' VND" class="form-control" readonly style="font-size:20px;"></div>';
							html+='<div class="form-group col-sm-12"><label>Số tiền cần nộp:</label><input type="text" name="thuc_thu" id="so_tien_thu" value="'+data.thucthu+' VND" class="form-control" readonly placeholder="Số tiền cần nộp (VND)"  style="font-size:20px;"></div>';
							html+='<input type="hidden" name="txtSoTienThu" value="'+data.thuc_thu+'" >';
							$("#result_2").html(html);

							var sotienthu=data.thuc_thu;
			
							var tien_thu=doc_tien.convert(sotienthu)+' đồng chẵn';
							tien_thu=tien_thu.charAt(0).toUpperCase() + tien_thu.slice(1);
							$("#doctien").html(tien_thu);
							$("#noi_dung").html(data.noi_dung);
							
						});

						$("#muc_thu").change(function(){
							var ma_muc_thu=$(this).val();
							var ma_sv= $("#id_sinh_vien").val();
							$.get("users/receipt/ajax_phi_thu/"+ma_muc_thu+"/"+ma_sv,function(data){
								if(data.so_thang_sv < data.muc_thu.so_thang)
								{
									swal("Nhắc nhở!",'Bạn có chắc chắn muốn thay đổi sang hình thức thu: '+data.muc_thu.ten_hinh_thuc+' có phí '+formatNumber(data.muc_thu.muc_thu_qui_dinh)+'(VND).'+' Một khi đã thu phí,sẽ không thể quay lại hình thức ban đầu', "warning");
									/*alert('Bạn có chắc chắn muốn thay đổi sang hình thức thu: '+data.muc_thu.ten_hinh_thuc+' có phí '+formatNumber(data.muc_thu.muc_thu_qui_dinh)+'(VND).'+' Một khi thay đổi hình thức thu mới,sẽ không thể quay lại hình thức ban đầu');*/
									var html='';
									html+='<div class="form-group col-sm-3"><label>Tỷ lệ ưu đãi:</label><input type="text" value='+data.muc_thu.ty_le_giam+'% class="form-control" readonly placeholder="Ưu đãi(%)"></div>';
									html+='<div class="form-group col-sm-12"><label>Số tiền đã nộp - Số tiền cần nộp còn lại:</label><input type="text" value="'+data.da_nop+' VND - '+ data.con_lai+' VND" class="form-control" readonly style="font-size:20px;"></div>';
									html+='<div class="form-group col-sm-12"><label>Số tiền cần nộp:</label><input type="text" name="thuc_thu" id="so_tien_thu" value="'+data.thucthu+' VND" class="form-control" readonly placeholder="Số tiền cần nộp (VND)"  style="font-size:20px;"></div>';
									html+='<input type="hidden" name="txtSoTienThu" value="'+data.thuc_thu+'" >';
									$("#result_2").html(html);

									var sotienthu=data.thuc_thu;
					
									var tien_thu=doc_tien.convert(sotienthu)+' đồng chẵn';
									tien_thu=tien_thu.charAt(0).toUpperCase() + tien_thu.slice(1);
									$("#doctien").html(tien_thu);
									$("#noi_dung").html(data.noi_dung);
								}else if(data.so_thang_sv == data.muc_thu.so_thang)
								{
									var html='';
									html+='<div class="form-group col-sm-3"><label>Tỷ lệ ưu đãi:</label><input type="text" value='+data.muc_thu.ty_le_giam+'% class="form-control" readonly placeholder="Ưu đãi(%)"></div>';
									html+='<div class="form-group col-sm-12"><label>Số tiền đã nộp - Số tiền cần nộp còn lại:</label><input type="text" value="'+data.da_nop+' VND - '+ data.con_lai+' VND" class="form-control" readonly style="font-size:20px;"></div>';
									html+='<div class="form-group col-sm-12"><label>Số tiền cần nộp:</label><input type="text" name="thuc_thu" id="so_tien_thu" value="'+data.thucthu+' VND" class="form-control" readonly placeholder="Số tiền cần nộp (VND)"  style="font-size:20px;"></div>';
									html+='<input type="hidden" name="txtSoTienThu" value="'+data.thuc_thu+'" >';
									$("#result_2").html(html);

									var sotienthu=data.thuc_thu;
					
									var tien_thu=doc_tien.convert(sotienthu)+' đồng chẵn';
									tien_thu=tien_thu.charAt(0).toUpperCase() + tien_thu.slice(1);
									$("#doctien").html(tien_thu);
									$("#noi_dung").html(data.noi_dung);
								}
							});
						});

					});
				}
			});
				$('#form_thuphi')[0].reset();
		       /* $('#err_form_submit').html('');*/
		        $('#button_action').val('insert');
		        $('#action').val('Save');

			// }
			
		});

	});

	$(function(){
		$('body').css('padding','auto');
		$("#form_thuphi").on('submit',function(event){
			event.preventDefault();
			var ma_sv= $("#id_sinh_vien").val();
			var ma_muc_thu= $("#muc_thu").val();
			var form_data = $(this).serialize();
			$.ajax({
				url : 'users/receipt/insert/'+ma_muc_thu+"/"+ma_sv,
				data :form_data,
				type : 'POST',
				dataType: 'json',
				success: function(data){
					/*if(data.error.length > 0)
					{
						var error_html = '';
						error_html+='<div class="alert alert-danger">';
						for(var count = 0; count < data.error.length; count++)
	                    {
	                        error_html += data.error[count]+'</br>';
	                    }
	                    error_html+='</div>';
	                    $('#err_form_submit').html(error_html);
					}else
					{*/
						$('#form_thuphi')[0].reset();
				        $('#button_action').val('insert');
				        $('#action').val('Save');
				        swal("Thành công",'Bạn đã '+data.success, "success");
						$('#data_table').DataTable().ajax.reload();
						$('body').css('padding','auto');
						$("#ThuPhiModal").modal('hide');
						$('body').css('padding','auto');

						$.get("users/receipt/ajax_print_phieu_thu/"+ma_sv,function(data){

							var hoc_bong =data.max_muc_thu*data.phieu_thu.ty_le_phan_tram/100 ;
							var thoi_gian_thu = new Date(data.phieu_thu.thoi_gian_thu);
							var date=thoi_gian_thu.getDate();
							var month=thoi_gian_thu.getMonth()+1;
							var year=thoi_gian_thu.getFullYear();
							var tien_thu=doc_tien.convert(data.phieu_thu.so_tien_thu)+' đồng chẵn';
							tien_thu=tien_thu.charAt(0).toUpperCase() + tien_thu.slice(1);

							var title_date='';
							title_date+='<b><i>Ngày '+date+' tháng '+month+' năm '+year+'</i></b>';
							var info='';
							info+='<p>Họ và tên người nộp tiền: ' + data.phieu_thu.ten_sinh_vien+'</p>';
							info+='<p>	Lớp: '+ data.phieu_thu.ten_lop+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ngành: '+data.phieu_thu.ten_nganh+
	            				'</p>';
	            			info+='<p>Địa chỉ: '+ data.phieu_thu.dia_chi +'</p>';
	            			info+='<p>Nội dung nộp: '+ data.phieu_thu.ten_sinh_vien +'__Nộp học phí: ' +data.phieu_thu.noi_dung+ '('+ data.phieu_thu.ten_hinh_thuc +'__'+'<b>'+formatNumber(data.phieu_thu.so_tien_thu)+'</b>),' +'HB= '+formatNumber(hoc_bong)+' VND</p>'
	            			info+='<p>Số tiền: <b>' + formatNumber(data.phieu_thu.so_tien_thu) +' VND</b></p>';
	            			info+='<p>Viết bằng chữ:  <b><i>'+tien_thu+'</i></b></p>';

	            			var signature1='<b>'+data.phieu_thu.ten_sinh_vien+'</b>';
	            			var signature2='<b>'+data.phieu_thu.nguoi_thu+'</b>';

	            			var end_phieu='';
	            			var tien_thu=doc_tien.convert(data.phieu_thu.so_tien_thu)+' đồng chẵn';
								tien_thu=tien_thu.charAt(0).toUpperCase() + tien_thu.slice(1);
	            			end_phieu+='Đã nhận đủ số tiền (Viết bằng chữ) : '+tien_thu;

	            			$("#date_thu").html(title_date);
	            			$("#info").html(info);
	            			$("#signature1").html(signature1);
	            			$("#signature2").html(signature2);
	            			$("#end_phieu").html(end_phieu);
	            			$("#print_thu_phi").modal('show');
	            			$('body').css('padding','0');
						});
						$('body').css('padding','0');
					}
				/*}*/

			});
		});
		$('body').css('padding','0');
	});
	$('body').css('padding','0');
</script>
<script type="text/javascript">
	$(document).ready(function(){
   		$('#save_excel').click(function(){
			$("#content_print").table2excel({
				exclude: ".noExl",
				name: "Excel Document Name",
				filename: "Bien lai" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
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
		$('body').css('padding','auto');
	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
@endsection
