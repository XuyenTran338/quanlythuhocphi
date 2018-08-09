function getDataTable(id1,id2)
{
	$('#data_table').DataTable({
		destroy:true,
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
        ]
	});
}

function getAllData()
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
}
if($("#id_nganh").val() == 'all')
{
	$(document).ready(function(){
		getAllData();
	});
}
$(document).ready(function(){
	$("#id_nganh").change(function(){
		var ma_nganh=$(this).val();
		if(ma_nganh == 'all')
		{
			$("#id_khoa").html('');
			getAllData();
		}
		else{
			$.get("users/class/ajax_khoa/"+ma_nganh,function(data){
				$("#id_khoa").html(data);
				var ma_khoa = $("#id_khoa").val();
				getDataTable(ma_nganh,ma_khoa);
			});
		}
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
	if(ma_nganh == 'all')
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
	}

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
	            html +=  '<td>' + tt + '</td>';
	        html +=  '</tr>';
		});
		$('#data_lop').html(html);
	});
	
});