<!-- The modal -->
<div class="modal fade model_top" id="ThuPhiModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" id="form_thuphi">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="modal-header" style="background-color: hsl(180, 65%, 81%);color: #1e395b; border-top-left-radius: 7px;border-top-right-radius: 5px;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="modalLabel"><i class="fas fa-donate"></i> &nbsp;Thu phí</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12" id="err_form_submit">
								
							</div>
							<div class="col-sm-12">
								<div id="result_1">
									
					        	</div>
					        	<div id="result_2">
						           
					        	</div>
					            <div class="form-group col-sm-12">
						            <label>Bằng chữ:</label>
						           <textarea class="form-control" rows="1" name="txtTienChu" id="doctien" placeholder="Tiền bằng chữ" readonly>
						           	
						           </textarea>
					            </div>
					            <div class="form-group col-sm-12">
						            <label>Đợt thu phí:</label>
						            <textarea class="form-control" rows="1" id="noi_dung" name="txtContent" readonly></textarea>
					            </div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color: hsl(180, 65%, 81%);color: #1e395b; border-bottom-left-radius: 7px;border-bottom-right-radius: 5px;">
					<!--<button id="insert_thu" name="button_insert" type="submit" class="btn btn-primary btn_line" value="insert"> <i class="far fa-save"></i> &nbsp; Lưu</button> -->
					<input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Save" class="btn btn-primary btn_line" />
					<button type="button" class="btn btn-danger btn_line" data-dismiss="modal"><i class="far fa-times-circle"></i>&nbsp; Đóng</button>
				</div>
			</form>
		</div>
	</div>
</div>
