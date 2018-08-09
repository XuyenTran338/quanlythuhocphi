<div id="print_thu_phi" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" id="size_model" style="position: inherit;right: 280px;">
        <div class="modal-content"  style="width: 1000px;font-family:initial">
            <div class="modal-header" style="background-color:  hsl(180, 65%, 81%);color: #1e395b;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fas fa-donate"></i>&nbsp; In biên lai thu phí </h4>
            </div>
            <div class="modal-body" style="font-size: 14px;">
            	<div class="container-fluid" style="width: 900px; overflow-y: auto; max-height: 440px;">
            		<div class="row" id="content_print">
                		<div class="col-sm-12">
                			<table cellspacing="0" cellpadding="0">
                				<tr>
                					<td width="60%">
                						<p>CÔNG TY CỔ PHẨN ĐÀO TẠO, TRIỂN KHAI DỊCH VỤ CÔNG NGHỆ THÔNG TIN VÀ VIỄN THÔNG BÁCH KHOA HÀ NỘI</p>
                					</td>
                					<td width="40%" style="text-align: center;">
                						<p>
                							<b>Mẫu số: 01-TT</b><br>
                							<i>(Ban hành theo QĐ số: 15/2016/QĐ-BTC ngày 20/03/2006 của Bộ trưởng BTC)</i>
                						</p>
                					</td>
                				</tr>
                			</table>	
                		</div>
                		<div class="col-sm-12">
                			<table cellspacing="0" cellpadding="0">
                				<tr>
                					<td width="50%">
                						<p>Tầng 5, nhà A17, số 17 Tạ Quang Bửu, Phường Bách Khoa, Quận Hai Bà Trưng, Hà Nội, Việt Nam</p>
                					</td>
                					<td></td>
                				</tr>
                			</table>
                		</div>
                		<div class="col-sm-12" style="text-align: center;">
                			<h3><b> PHIẾU THU</b></h3>
                			<h4 id="date_thu"></h4>
                		</div>
                		<div class="col-sm-12" id="info">

                		</div>
                		<div class="col-sm-12">
                			<style type="text/css">
                				#ky_ten tr td{
									text-align: center;
                				}
                				#ky_ten #content_ky td{
                					height: 30px;
                				}
                			</style>
                			<table cellspacing="0" cellpadding="0" style="width: 100%" id="ky_ten">
                				<tr>
                					<td colspan="3"></td>
                					<td colspan="2" ><i>Ngày....tháng....năm.......</i></td>
                				</tr>
                				<tr style="font-size: 13px;">
                					<td><b>Giám đốc</b><br><i>(Ký,họ tên,đóng dấu)</i></td>
                					<td><b>Kế toán trưởng</b><br><i>(Ký,họ tên)</i></td>
                					<td><b>Người nộp tiền</b><br><i>(Ký,họ tên)</i></td>
                					<td><b>Người lập phiếu</b><br><i>(Ký,họ tên)</i></td>
                					<td style="color: black"><b>Thủ quỹ</b><br><i>(Ký,họ tên)</i></td>
                				</tr>
                				<tr id="content_ky">
                					<td></td><td></td><td></td><td></td><td></td>
                				</tr>
                				<tr style="font-size: 13px;">
                					<td colspan="2"></td>
                                    <td id="signature1"></td>
                                    <td id="signature2"></td>
                					<td></td>
                				</tr>
                			</table>
                		</div>
                		<div class="col-sm-12">
                			<p id="end_phieu"></p>
                			<div class="col-sm-6" style="border-top: 3px solid black">
                				<p><b><i>Lưu ý: Học phí đóng rồi Học Viện sẽ không hoàn trả lại.</i></b></p>
                			</div>
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