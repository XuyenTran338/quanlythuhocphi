@extends('admin/layouts.master')
@section('title','Phiếu thu')
@section('heading') 
    <i class="fas fa-id-card" style="color:#16a291; font-size: 30px"></i>&nbsp;Phiếu thu
@endsection 
	
@section('content')

@if(session('messages'))
    <div class="alert alert-success alert-dismissible fade in">
        {{session('messages')}}
    </div>
@endif
<div class="box">
    <header>
        <div class="icons"><i class="fas fa-th-list"></i></div>
        <h5>Danh sách phiếu thu</h5>
        <!-- .toolbar -->
        <div class="toolbar">
          <nav style="padding: 8px;">
              <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                  <i class="fa fa-minus"></i>
              </a>
              <a href="javascript:;" class="btn btn-default btn-xs full-box">
                  <i class="fa fa-expand"></i>
              </a>
              <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                  <i class="fa fa-times"></i>
              </a>
          </nav>
        </div>
        <!-- /.toolbar -->
    </header>
    <div id="collapse4" class="body">
        <table id="data_table" class="table table-bordered table-condensed table-hover table-striped">
            <thead>
            <tr style="color: white; background-color: #16a291;">
                <th>Học viên</th>
                <th>Tên lớp</th>
                <th>Ngày đóng</th>
                <th>Tiền cần nộp</th>
                <th>Lần thu</th>
                <th>Nhân viên thu</th>
                <th>Số tiền đã nộp</th>
                <th>Nội dung</th>
                <th>Chi tiết</th>
            </tr>
            </thead>
            <tbody>
                @foreach($phieuthu as $obj)
                <tr>
                    <td>{{ $obj->ten_sinh_vien }}</td>
                    <td>{{ $obj->ten_lop }}</td>
                    <td>
                        <?php \Carbon\Carbon::setLocale('vi') ?>
                        {{date('d-m-Y', strtotime($obj->thoi_gian_thu))}}<br>
                        {!! \Carbon\Carbon::createFromTimeStamp(strtotime($obj->thoi_gian_thu))->diffForHumans() !!}
                    </td>
                    <td>
                        <?php 
                            $hoc_bong=$obj->ty_le_phan_tram/100;
                            $ty_le_uu_dai=$obj->ty_le_giam/100;
                            $phi_qui_dinh=$obj->muc_thu_qui_dinh;
                            $thucthu=$phi_qui_dinh-($phi_qui_dinh*($hoc_bong+$ty_le_uu_dai));
                            $thucthu=round($thucthu, -3, PHP_ROUND_HALF_UP);
                        ?>
                        <b style="color: hsl(0, 100%, 40%)">{{ number_format($thucthu,0,",",".")." "}}</b> <u>VND</u>
                    </td>
                    <td>{{ $obj->lan_thu}}</td>
                    <td>{{ $obj->nguoi_thu }}</td>
                    <td><b><p style="color: hsl(0, 100%, 40%)">{{ number_format($obj->so_tien_thu,0,",",".")." "}}</p></b> <u>VND</u></td>
                    <td>{{ $obj->noi_dung}}</td>
                    <td>
                        <div align="center"><a href="{{ route('getInfor_receipt',[$obj->sinh_vien_ma,$obj->lan_thu]) }}" ><i class="fas fa-info-circle"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection