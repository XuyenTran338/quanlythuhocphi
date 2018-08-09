<div id="model_print" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" id="size_model" style="position: inherit;right: 280px;">
        <div class="modal-content"  style="width: 1000px;font-family:initial">
            <div class="modal-header" style="background-color:  hsl(180, 65%, 81%);color: #1e395b;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fas fa-graduation-cap font-icon"></i>&nbsp; Danh sách học viên </h4>
            </div>
            <div class="modal-body" style="font-size: 14px;">
            	<div class="container-fluid" style="width: 900px; overflow-y: auto; max-height: 440px;">
            		<div class="row" id="content_print">
                		<div class="col-sm-12">
                			<h4 align="center" style="font-weight: bold;"> DANH SÁCH HỌC VIÊN </h4>
                		</div>
                		<div class="col-sm-12">
                			<p><b>Chi nhánh:&nbsp;</b>Học viên công nghệ thông tin Bách Khoa Hà Nội</p>
                            <p id="title">
    						
                            </p>
                		</div>
                		<div class="col-sm-12">
                		
            				<table id="table_print" class="table table-hover table-striped table-bordered table-condensed table-responsive table_export" border="1" cellpadding="5" cellspacing="0">
								<thead>
									<tr style="background-color: hsl(163, 81%, 90%);">
										<th>Mã_SV</th>
						                <th>Họ và tên</th>
						                <th>Học bổng</th>
						                <th>Ngày sinh</th>
						                <th>Email</th>
						                <th>Giới tính</th>
                                        <th>Địa chỉ</th>
						                <th>Số điện thoại</th> 
                                        <th>Hình thức nộp</th>
									</tr>
								</thead>
								<tbody id="data_sv">
						            
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