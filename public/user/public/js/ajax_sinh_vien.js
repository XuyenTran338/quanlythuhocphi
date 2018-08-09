function getDataTable(id)
{
	$('#data_table').DataTable({
		destroy:true,
		processing:true,
        serverSide:true,
        ajax :"users/student/ajax_sinhvien/"+id,
        columns:[
        	{data : "stt"},
       		{data : "ma_sinh_vien"},
       		{data : "ten_sinh_vien"},
       		{data : "ty_le_phan_tram"},
       		{data : "ngay_sinh"},
       		{data : "email"},
       		{data : "gioi_tinh"},
       		{data : "sdt"},
       		{data : "hinh_thuc"},
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

$(document).ready(function(){
	var ma_nganh=$("#id_nganh").val();
	$.get("users/student/ajax_khoa/"+ma_nganh,function(data){
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
		$.get("users/student/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
			var html='';
            $.each(data,function(key,value){
                html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'___Sĩ số: '+ value.si_so_now+'/'+value.si_so +'</option>';
            });
            $('#id_lop').html(html);

			var ma_lop = $("#id_lop").val();
			getDataTable(ma_lop);
		});
	});

	$("#id_nganh").change(function(){
		var ma_nganh = $(this).val();
		$.get("users/student/ajax_khoa/"+ma_nganh,function(data){
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
			$.get("users/student/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
				var html='';
                $.each(data,function(key,value){
                   html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'___Sĩ số: '+ value.si_so_now+'/'+value.si_so +'</option>';
                });
                $('#id_lop').html(html);

				var ma_lop = $("#id_lop").val();
				getDataTable(ma_lop);
			});

		});
	
	});

	$("#id_khoa").change(function(){
		var ma_khoa = $(this).val();
		var ma_nganh=$("#id_nganh").val();
		$.get("users/student/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
			var html='';
            $.each(data,function(key,value){
            	html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'___Sĩ số: '+ value.si_so_now+'/'+value.si_so +'</option>';
            });
            $('#id_lop').html(html);

			var ma_lop = $("#id_lop").val();
			getDataTable(ma_lop);
		});
		
	});

	$("#id_lop").change(function(){
		var ma_lop=$(this).val();
		getDataTable(ma_lop);
	});
});
function get_date(day)
{
	var date=day.getDate();
	if(date < 10)
	{
		date='0'+date;
	}
	var month=(day.getMonth()+1);
	if(month < 10)
	{
		month='0'+month;
	}
	var year=day.getFullYear();
	var html='';
	html=date+'/'+month+'/'+year;
	return html;
}
$(document).ready(function(){
	$("#view_sv_print").on('click',function(e){
		e.preventDefault();
		$("#model_print").modal('hide');
		var ma_lop = $("#id_lop").val();
		$.get("users/student/check_sv_print/"+ma_lop,function(check){
			if(check['check'] > 0)
			{
				$("#model_print").modal('show');
				$.getJSON("users/student/list_students/"+ma_lop,function(data){
					$.get("users/student/ajax_get_print/"+ma_lop,function(title){
						$("#title").html(title);
					});
					var html='';
					$.each(data,function(key,value){
						var birth=new Date(value.ngay_sinh);
						var html_birth=get_date(birth);
						var sex='';
						if(value.gioi_tinh ==1) sex="Nam"; else sex="Nữ";
						 html +=  '<tr>';
				            html +=  '<td>' + value.ma_sinh_vien + '</td>';
				            html +=  '<td>' + value.ten_sinh_vien + '</td>';
				            html +=  '<td>' + value.ty_le_phan_tram + '%'+ '</td>';
				            html +=  '<td>' + html_birth + '</td>';
				            html +=  '<td>' + value.email + '</td>';
				            html +=  '<td>' + sex + '</td>';
				            html +=  '<td>' + value.dia_chi + '</td>';
				            html +=  '<td>' + value.sdt + '</td>';
				            html +=  '<td>' + value.ten_hinh_thuc + '</td>';
				        html +=  '</tr>';
					});
					$('#data_sv').html(html);
				});
			}else
			{
				$("#model_print").modal('hide');
				swal("Nhắc nhở!",'Lớp '+check.ten_lop+' chưa có sinh viên! Vui lòng chọn lớp khác',"warning");
			}
		});
		
	});
});
