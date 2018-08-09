<div id="model_print" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" id="size_model" style="position: inherit;right: 280px;">
        <div class="modal-content"  style="width: 1000px;font-family:initial; ">
            <div class="modal-header" style="background-color:  hsl(180, 65%, 81%);color: #1e395b;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fas fa-book"></i>&nbsp; Danh sách lớp học </h4>
            </div>
            <div class="modal-body" style="font-size: 14px;">
            	<div class="container-fluid" style="width: 900px; overflow-y: auto; max-height: 440px;">
            		<div class="row" id="content_print">
                		<div class="col-sm-12">
                			<h4 align="center" style="font-weight: bold;"> DANH SÁCH LỚP HỌC</h4>
                		</div>
                		<div class="col-sm-12">
                			<p><b>Chi nhánh:&nbsp;</b>Học viên công nghệ thông tin Bách Khoa Hà Nội</p>
							<p id="title">
								
							</p>
                		</div>
                		<div class="col-sm-12" style="text-align: center;" id="data_all">
                		
            				<table id="table_print" class="table table-hover table-striped table-bordered table-condensed table-responsive table_export" border="1" cellpadding="5" cellspacing="0" align="center">
								<thead>
									<tr style="background-color: hsl(163, 81%, 90%);">
										<th>STT</th>
										<th>Mã Lớp</th>
						                <th>Tên Lớp</th>
						                <th>Sĩ số</th>
						                <th>Giáo viên chủ nhiệm</th>
						                <th>Ngày nhập học</th>
						                <th>Ngày kết thúc</th>
                                        <th>Trạng thái</th> 
									</tr>
								</thead>
								<tbody id="data_lop">
						         
						        </tbody>
							</table>
            
                		</div>
            		</div>
            	</div>
            </div>
            <div class="modal-footer" style="background-color:  hsl(180, 65%, 81%);color: #1e395b;">
            	<a class="btn btn-info btn-lg btn_color" id="print" data-toggle="tooltip" data-placement="top" title="Print">
		          <span class="glyphicon glyphicon-print" ></span> In
		        </a>
		        <a class="btn btn-success" id="save_excel" data-toggle="tooltip" data-placement="top" title="Export File Excel" data-dismiss="modal"><i class="fas fa-save"></i> &nbsp;Lưu</a> 
                <a class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp;Đóng</a> 
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    th{
        text-align: center
    }
</style>