@extends('admin/layouts.master')
@section('title','Home')
@section('heading')
	<i class="fa fa-home" style="color: #2bbbad; font-size: 30px"></i>&nbsp;Trang chủ
@endsection 	
@section('content')
<style type="text/css">
	.statis{
		background-color: #1ab394;
		color: white;
		border-radius: 10px;
		font-size: 18px;
		font-weight: bold;
		padding: 10px 20px;
		
	}
	.align{
		text-align: right;
	}
	.tab-pane{
		background-color: white;
		border: 1px solid hsl(0, 0%, 85%);
		border-top: 0px;
		border-bottom-right-radius: 10px;
		border-bottom-left-radius: 10px;
	}
</style>
<div class="container-fluid"> 
 <div class="row"> 
  <div class="col-xs-12"> 
   <ul class="nav nav-tabs nav-tabs-top nav-centered" role="tablist">
   	<li role="presentation" class="active"> <a href="#dashboard" data-toggle="tab" role="tab" class="btn btn-primary btn-line"> <i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a> 
    </li> 
   <!--  <li role="presentation" > <a href="#thong_ke" data-toggle="tab" role="tab" class="btn btn-danger btn-line"> <i class="far fa-chart-bar"></i> &nbsp; Thống kê</a> 
    </li>  -->
  <!--   <li role="presentation"> <a href="#tra_cuu" data-toggle="tab" role="tab" class="btn btn-success btn-line"> <i class="fas fa-search"></i> &nbsp; Tra cứu </a> 
    </li>  -->
   <!--  <li role="presentation"> <a href="#bao_cao" data-toggle="tab" role="tab" class="btn btn-warning btn-line"><i class="fas fa-file-alt"></i> &nbsp; Báo cáo</a>
    </li>  -->
   </ul> 

   <div id="my_side_tabs " class="tab-content side-tabs side-tabs-left">
	    <div class="tab-pane fade in active col-sm-12" id="dashboard" role="tabpanel"><div class="col-sm-12"><br><br></div> 
	    	<div class="col-sm-12">
	    		<div class="col-sm-4">
	    			<div class="col-sm-1"></div>
	    			<div class="col-sm-10 statis">	
						<i class="fa fa-user fa-3x" ></i>
						<div class="align">{{ number_format( $user,0,",",",")." "}}</div>
						<p align="right">Tài khoản</p>
	    			</div>
	    			<div class="col-sm-1"></div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="col-sm-1"></div>
					<div class="col-sm-10 statis">
						<i class="fas fa-book fa-3x"></i>
						<div class="align">{{ number_format( $lop,0,",",",")." "}}</div>
						<p align="right">Lớp học</p>
					</div>
					<div class="col-sm-1"></div>
				</div>
				<div class="col-sm-4">
	    			<div class="col-sm-1"></div>
					<div class="col-sm-10 statis">
						<i class="fas fa-graduation-cap fa-3x"></i>
						<div class="align">{{ number_format( $sinhvien,0,",",",")." "}}</div>
						<p align="right">Sinh viên</p>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div><div class="col-sm-12"><br><br></div>
			<div class="col-sm-12">
				<div class="col-sm-4">
	    			<div class="col-sm-1"></div>
					<div class="col-sm-10 statis">
						<i class="fas fa-id-card fa-3x"></i>
						<div class="align">{{ number_format( $phieuthu,0,",",",")." "}}</div>
						<p align="right">Số phiếu thu</p>
					</div>
					<div class="col-sm-1"></div>
				</div>
				<div class="col-sm-4">
	    			<div class="col-sm-1"></div>
					<div class="col-sm-10 statis">
						<i class="fas fa-dollar-sign fa-3x"></i>
						<div class="align">{{ number_format( $count_no_phi,0,",",",")." "}}</div>
						<p align="right">Tổng sinh viên nợ phí</p>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div><div class="col-sm-12"><br><br></div>
	    </div> 
	    <div class="tab-pane fade col-sm-12" id="thong_ke" role="tabpanel"> 
	     	<div class="col-sm-12"><br><br></div>
	     	<div class="col-sm-12">
	     		
	     	</div>
	     	<div class="col-sm-12"><br><br></div>
	    </div>
	   <!--  <div class="tab-pane fade col-sm-12" id="tra_cuu" role="tabpanel" > 
	     	<div class="col-sm-12"><br><br></div>
	     	<div class="col-sm-12">
	     		
	     	</div>
	     	<div class="col-sm-12"><br><br></div>
	    </div>  -->
	    <div class="tab-pane fade col-sm-12" id="bao_cao" role="tabpanel"> 
	     	<div class="col-sm-12"><br><br></div>
	     	<div class="col-sm-12">
	     		<div class="form-group col-sm-4">
					<label class="label-control col-sm-12">Ngành học</label>
					<div class="col-sm-12">
						<select name="sltNganh" id="id_nganh" class="form-control select2" style="width: 100%">
							@foreach($nganh as $obj)
								<option value="{{ $obj->ma_nganh }}" @if(old('sltNganh') == $obj->ma_nganh) selected @endif>
									{{ $obj->ten_nganh }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
	     		<div class="form-group col-sm-4">
					<label class="label-control col-sm-12">Khóa</label>
					<div class="col-sm-12">
						<select name="sltKhoa" class="form-control select2" id="id_khoa" style="width: 100%">
							
						</select>
					</div>
				</div>
				<div class="form-group col-sm-4">
					<label class="label-control col-sm-12">Lớp học</label>
					<div class="col-sm-12">
						<select name="sltKhoa" class="form-control select2" id="id_lop" style="width: 100%">
							
						</select>
					</div>
				</div>
	     	</div>
	     	<div class="col-sm-12"><br><br></div>
	    </div>
   </div> 
  </div> 
 </div>
</div> 
@endsection

@section('script')
<script type="text/javascript">
	function ajax_nganh_khoa_lop() {
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

            var html='';
            $.each(data.mucthu,function(key,value){
            	html+='<option value='+ value.ma_muc_thu +'>'+value.ten_hinh_thuc+' có phí '+value.muc_thu_qui_dinh+' (VND)</option>';
            });
            $("#id_muc_thu").html(html);

            var ma_khoa=$("#id_khoa").val();
            $.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
                var html='';
                $.each(data,function(key,value){
                    html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'</option>';
                });
                $('#id_lop').html(html);
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

                var html='';
	            $.each(data.mucthu,function(key,value){
	            	html+='<option value='+ value.ma_muc_thu +'>'+value.ten_hinh_thuc+' có phí '+value.muc_thu_qui_dinh+' (VND)</option>';
	            });
	            $("#id_muc_thu").html(html);

                var ma_khoa=$("#id_khoa").val();
                $.get("admins/student/ajax_lop/"+ma_nganh+'/'+ma_khoa,function(data){
                    var html='';
                    $.each(data,function(key,value){
                        html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'</option>';
                    });
                    $('#id_lop').html(html);
                });
            });
        });

        $("#id_khoa").change(function(){
			var ma_khoa = $(this).val();
			var ma_nganh = $("#id_nganh").val();
			$.get("admins/student/ajax_lop/"+ma_nganh+"/"+ma_khoa,function(data){
				var html='';
                $.each(data,function(key,value){
                    html+='<option value='+value.ma_lop+'>'+ value.ten_lop +'</option>';
                });
				$("#id_lop").html(html);
			});
		});
    }

    // Báo cáo
    $(document).ready(function(){
    	ajax_nganh_khoa_lop();
    	
    });
</script>

@endsection