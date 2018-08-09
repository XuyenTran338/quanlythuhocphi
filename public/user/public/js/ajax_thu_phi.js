function getDataTable(id)
{
	$('#data_table').DataTable({
		destroy:true,
		draw:'full-reset',
		processing:true,
        serverSide:true,
        ajax :"users/receipt/ajax_phieu_thu/"+id,
        columns:[
            {data : "dot_thu"},
       		{data : "nguoi_thu"},
       		{data : "thoi_gian_thu"},
       		{data : "ten_hinh_thuc"},
       		{data : "thuc_thu"},
       		{data : "hoc_bong"},
       		{data : "so_tien_giam"},
       		{data : "so_tien_thu"},
       		{data : "so_tien_no"},
       		{data : "tinh_trang"},
       		{data : "noi_dung"}
        ]
	});
}
$(document).ready(function(){
	var ma_nganh = $("#id_nganh").val();
	$.get("users/receipt/ajax_khoa/"+ma_nganh,function(data){
		$("#id_khoa").html(data);
		var ma_khoa = $("#id_khoa").val();
		$.get("users/receipt/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
			$("#id_lop").html(data);
			var ma_lop = $("#id_lop").val();
			$.get("users/receipt/ajax_sinhvien/"+ma_lop,function(data){
				$("#id_sinh_vien").html(data);
				var ma_sv= $("#id_sinh_vien").val();
				getDataTable(ma_sv);
			});
		});

	});

	$("#id_nganh").change(function(){
		var ma_nganh = $(this).val();
		$.get("users/receipt/ajax_khoa/"+ma_nganh,function(data){
			$("#id_khoa").html(data);
			var ma_khoa = $("#id_khoa").val();
			$.get("users/receipt/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
				$("#id_lop").html(data);
				var ma_lop = $("#id_lop").val();
				$.get("users/receipt/ajax_sinhvien/"+ma_lop,function(data){
					$("#id_sinh_vien").html(data);
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
			$("#id_lop").html(data);
			var ma_lop = $("#id_lop").val();
			$.get("users/receipt/ajax_sinhvien/"+ma_lop,function(data){
				$("#id_sinh_vien").html(data);
				var ma_sv= $("#id_sinh_vien").val();
				getDataTable(ma_sv);
			});
		});
		
	});

	$("#id_lop").change(function(){
		var ma_lop=$(this).val();
		$.get("users/receipt/ajax_sinhvien/"+ma_lop,function(data){
			$("#id_sinh_vien").html(data);
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
		var ma_sv= $("#id_sinh_vien").val();
		if(ma_sv == 0)
		{
			alert('Chưa chọn sinh viên để thu phí!')
		}else
		{
			$("#ThuPhiModal").modal('show');
			$.get("users/receipt/ajax_hinhthuc/"+ma_sv,function(data){
				$("#result_1").html(data);

				var ma_muc_thu=$("#muc_thu").val();
				$.get("users/receipt/ajax_phi_thu/"+ma_muc_thu+"/"+ma_sv,function(data){
					$("#result_2").html(data);
					
				});
				
				$("#muc_thu").change(function(){
					var ma_muc_thu=$(this).val();
					var ma_sv= $("#id_sinh_vien").val();
					$.get("users/receipt/ajax_phi_thu/"+ma_muc_thu+"/"+ma_sv,function(data){
						$("#result_2").html(data);
					});
				});

			});
		}
		$('#form_thuphi')[0].reset();
        $('#err_form').html('');
        $('#button_action').val('insert');
        $('#action').val('Save');
	});

});

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
}

$(function(){
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
				if(data.error.length > 0)
				{
					var error_html = '';
					error_html+='<div class="alert alert-danger">';
					for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += data.error[count]+'</br>';
                    }
                    error_html+='</div>';
                    $('#err_form').html(error_html);
				}else
				{
					$('#form_thuphi')[0].reset();
			        $('#button_action').val('insert');
			        $('#action').val('Save');
					$('#data_table').DataTable().ajax.reload();
					alert(data.success);
					$("#ThuPhiModal").modal('hide');
					$('body').css('padding','auto');

					$.get("users/receipt/ajax_print_phieu_thu/"+ma_sv,function(data){

						var hoc_bong =data.max_muc_thu*data.phieu_thu.ty_le_phan_tram/100 ;
						var thoi_gian_thu = new Date(data.phieu_thu.thoi_gian_thu);
						var date=thoi_gian_thu.getDate();
						var month=thoi_gian_thu.getMonth()+1;
						var year=thoi_gian_thu.getFullYear();

						var title_date='';
						title_date+='<b><i>Ngày '+date+' tháng '+month+' năm '+year+'</i></b>';

						var info='';
						info+='<p>Họ và tên người nộp tiền: ' + data.phieu_thu.ten_sinh_vien+'</p>';
						info+='<p>	Lớp: '+ data.phieu_thu.ten_lop+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ngành: '+data.phieu_thu.ten_nganh+
            				'</p>';
            			info+='<p>Địa chỉ: '+ data.phieu_thu.dia_chi +'</p>';
            			info+='<p>Nội dung nộp: '+ data.phieu_thu.ten_sinh_vien +'__'+ data.phieu_thu.noi_dung +' ,đợt ' +data.phieu_thu.dot_thu+ '('+ data.phieu_thu.ten_hinh_thuc +'__'+'<b>'+formatNumber(data.phieu_thu.so_tien_thu)+'</b>),' +'HB= '+formatNumber(hoc_bong)+' VND</p>'
            			info+='<p>Số tiền: <b>' + formatNumber(data.phieu_thu.so_tien_thu) +' VND</b></p>';
            			info+='<p>Viết bằng chữ:  <b><i>'+data.phieu_thu.bang_chu+'</i></b></p>';

            			var signature1='<b>'+data.phieu_thu.ten_sinh_vien+'</b>';
            			var signature2='<b>'+data.phieu_thu.nguoi_thu+'</b>';

            			var end_phieu='';
            			end_phieu+='Đã nhận đủ số tiền (Viết bằng chữ) : '+data.phieu_thu.bang_chu;

            			$("#date_thu").html(title_date);
            			$("#info").html(info);
            			$("#signature1").html(signature1);
            			$("#signature2").html(signature2);
            			$("#end_phieu").html(end_phieu);
            			$("#print_thu_phi").modal('show');
            			$('body').css('padding','0');
					});
					$('body').css('padding','auto');
				}
			}

		});
	});
});
