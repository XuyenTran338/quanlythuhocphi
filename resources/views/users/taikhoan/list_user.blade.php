@extends('users.layouts.master')
@section('title','Danh sách tài khoản')

@section('content')
<header class="header_main">
	<i class="fas fa-user"></i>&nbsp;&nbsp;Danh sách nhân viên
</header>
<div class="content_main">
	<div class="row">
		<div class="button_function col-sm-12">
			<!-- <button type="button" class="btn btn_color " data-toggle="modal" data-target="#model_excel"><i class="fas fa-file-excel icon_color"></i> &nbsp; Import&nbsp; <i class="fas fa-upload"></i></button>
			<div id="model_excel" class="modal fade" tabindex="-1" role="dialog">
		        <div class="modal-dialog ">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                    <h4 class="modal-title"><i class="fas fa-upload"></i>&nbsp; Import File Excel </h4>
		                </div>
		                <div class="modal-body">
		                   <form action="{{ route('postExcel') }}" class="form-control" method="post" enctype="multipart/form-data">
		                   		<input type="hidden" name="_token" value="{{csrf_token()}}">
		                   		<input type="file" name="import_file">
		                   		<span> </span>
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                    <button type="submit" class="btn btn-primary">Import File</button>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div> -->
			<button type="button" class="btn btn_color export" data-toggle="tooltip" data-placement="top" title="Export"><i class="fas fa-file-excel icon_color"></i> &nbsp; Xuất File Excel</button>
			<button type="button" id="print" class="btn btn_color" data-toggle="tooltip" data-placement="top" title="Print"><i class="fas fa-print icon_color"></i> &nbsp; In</button>
			<!-- <button type="button" class="btn btn_color"><i class="fas fa-sync-alt icon_color"></i> &nbsp; Tải lại</button> -->
		</div>
	</div>
</div><br>
	<div class="row">
		<div class="col-sm-12" style="background-color: white; padding-top: 10px; border: 5px solid #4a7da3; border-radius: 10px">
			<table id="data_table" class="table table-hover table-striped table-bordered table-condensed table-responsive" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr style="background-color: hsl(163, 81%, 90%);">
						<th data-sortable="true">STT</th>
		                <th>Tên tài khoản</th>
		                <th>Email</th>
		                <th>Phân quyền</th>
		                <th>Họ và tên</th>
		                <th>Giới tính</th>
		                <th>SDT</th>
		                <th>Lần truy cập cuối</th>
		            </tr>
		            </thead>
		            <tbody>
		            	<?php $i=1 ?>
		                @foreach($list_user as $obj)
		                <tr>
		                	<td>{{ $i++ }}</td>
		                    <td>
		                        <br>
		                        <div style="text-align: center;">
		                            <img src="{{ asset('admin/public/assets/img')}}/{{ $obj->image}}" width="50" style="border-radius: 100%; border: 1px solid #ccc">
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
		                </tr>
		                @endforeach
		        </tbody>
			</table>
		</div>
	</div>

	
@endsection

@section('script')
<script type="text/javascript">
 	$(document).ready(function() {
        $('#data_table').DataTable({
                responsive: true
        });
    });

   	$(document).ready(function(){
   		$('.export').click(function(){
			$("#data_table").table2excel({
				exclude: ".noExl",
				name: "Excel Document Name",
				filename: "Danh sach TK " + new Date().toISOString().replace(/[\-\:\.]/g, ""),
				fileext: ".xls",
				exclude_img: true,
				exclude_links: true,
				exclude_inputs: true
			});
		});
	});

	function printData()
	{
	   var data_print=document.getElementById("data_table");
	   newWin= window.open("");
	   newWin.document.write("<h3 align='center'> Danh sách tài khoản </h3>");
	   newWin.document.write(data_print.outerHTML);
	   newWin.print();
	   newWin.close();
	}

	$('#print').on('click',function(){
		printData();
	});
</script>
@endsection
