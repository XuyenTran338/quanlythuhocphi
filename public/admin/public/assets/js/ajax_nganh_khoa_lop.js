$(document).ready(function(){
	$("#id_nganh").change(function(){
		var ma_nganh = $(this).val();
		$.get("admins/student/ajax_khoa/"+ma_nganh,function(data){
			$("#id_khoa").html(data);

			var ma_khoa = $("#id_khoa").val();
			$.get("admins/student/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
				$("#id_lop").html(data);
			});

		});
		
	});

	$("#id_khoa").change(function(){
		var ma_khoa = $(this).val();
		var ma_nganh = $("#id_nganh").val();
		$.get("admins/student/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
			$("#id_lop").html(data);
		});
	});
});