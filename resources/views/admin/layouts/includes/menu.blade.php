<style type="text/css">
  i{
    font-size: 18px;
  }
  
  #menu > li > .collapse> li.active>a{
      background-color: #E57373  !important;

  }
  
</style>
<ul id="menu" >
  <li class="nav-header" ><i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i> &nbsp; Menu</li>
  <li class="{{(Request::is('admins')) ? 'active' : ''}}">
    <a href="{{ route('home') }}"  class="menu">
      <i class="fas fa-home"></i><span class="link-title">&nbsp;Trang chủ</span>
    </a>
  </li>
  <li class="{{(Request::is('admins/user/*')) ? 'active' : ''}}">
    <a href="javascript:;" class="menu">
      <i class="fas fa-user-circle"></i>
      <span class="link-title">&nbsp;Tài khoản</span>
      <span class="fa arrow"></span>
    </a>
    <ul class="collapse">
      <li class="{{(Request::is('admins/user/list')) ? 'active' : ''}}">
        <a href="{{ route('list_user') }}">
          <i class="fas fa-address-book"></i>&nbsp; Danh sách tài khoản</a>
      </li>
      <li class="{{(Request::is('admins/user/insert')) ? 'active' : ''}}">
        <a href="{{ route('getInsert_user') }}">
          <i class="fas fa-user-plus"></i>&nbsp; Thêm tài khoản </a>
      </li>
    </ul>
  </li>
  <li class="{{(Request::is('admins/major/*')) ? 'active' : ''}}">
    <a href="javascript:;" class="menu">
      <i class="fab fa-readme"></i>
      <span class="link-title">&nbsp; Ngành học</span>
      <span class="fa arrow"></span>
    </a>
    <ul class="collapse">
      <li class="{{(Request::is('admins/major/list')) ? 'active' : ''}}">
        <a href="{{ route('list_majors') }}">
          <i class="fas fa-th-list"></i>&nbsp; Danh sách ngành học </a>
      </li>
      <li class="{{(Request::is('admins/major/insert')) ? 'active' : ''}}">
        <a href="{{ route('getInsert_majors') }}">
          <i class="fas fa-plus-square"></i>&nbsp; Thêm ngành học </a>
      </li>
    </ul>
  </li>
  <li class="{{(Request::is('admins/course/*')) ? 'active' : ''}}">
    <a href="javascript:;" class="menu">
      <i class="fab fa-leanpub"></i>
      <span class="link-title"> &nbsp; Khóa học </span>
      <span class="fa arrow"></span>
    </a>
    <ul class="collapse">
      <li class="{{(Request::is('admins/course/list')) ? 'active' : ''}}">
        <a href="{{ route('list_course') }}">
          <i class="fas fa-th-list"></i>&nbsp; Danh sách khóa học</a>
      </li>
      <li class="{{(Request::is('admins/course/insert')) ? 'active' : ''}}" id="insert_khoa_hoc">
        <a href="{{ route('getInsert_course') }}" onclick="return false" class="insert">
          <i class="fas fa-plus-square"></i>&nbsp; Thêm khóa học 
        </a>
      </li>
    </ul>
  </li>
  <li class="{{(Request::is('admins/class/*')) ? 'active' : ''}}">
    <a href="javascript:;" class="menu">
      <i class="fas fa-book"></i>
      <span class="link-title"> &nbsp; Lớp học</span>
      <span class="fa arrow"></span>
    </a>
    <ul class="collapse">
      <li class="{{(Request::is('admins/class/list')) ? 'active' : ''}}">
        <a href="{{ route('list_classes') }}">
          <i class="fas fa-th-list"></i>&nbsp; Danh sách lớp học </a>
      </li>
      <li class="{{(Request::is('admins/class/insert')) ? 'active' : ''}}">
        <a href="{{ route('getInsert_classes') }}">
          <i class="fas fa-plus-square"></i>&nbsp; Thêm lớp học </a>
      </li>
    </ul>
  </li>
  <li class="{{(Request::is('admins/object/*')) ? 'active' : ''}}">
    <a href="javascript:;" class="menu">
      <i class="fas fa-gift"></i>
      <span class="link-title"> &nbsp; Học bổng</span>
      <span class="fa arrow"></span>  
    </a>
    <ul class="collapse">
      <li class="{{(Request::is('admins/object/list')) ? 'active' : ''}}">
        <a href="{{ route('list_objects') }}">
          <i class="fas fa-th-list"></i>&nbsp; Danh sách học bổng </a>
      </li>
      <li class="{{(Request::is('admins/object/insert')) ? 'active' : ''}}">
        <a href="{{ route('getInsert_objects') }}">
          <i class="fas fa-plus-square"></i>&nbsp; Thêm học bổng </a>
      </li>
    </ul>
  </li>
  <li class="{{(Request::is('admins/student/*')) ? 'active' : ''}}">
    <a href="javascript:;" class="menu">
      <i class="fas fa-graduation-cap"></i>
      <span class="link-title"> &nbsp; Sinh viên</span>
      <span class="fa arrow"></span>  
    </a>
    <ul class="collapse">
      <li class="{{(Request::is('admins/student/list')) ? 'active' : ''}}">
        <a href="{{ route('list_students') }}">
          <i class="fas fa-th-list"></i>&nbsp; Danh sách sinh viên </a>
      </li>
      <li class="{{(Request::is('admins/student/insert')) ? 'active' : ''}}">
        <a href="{{ route('getInsert_students') }}">
          <i class="fas fa-plus-square"></i>&nbsp; Thêm sinh viên </a>
      </li>
    </ul>
  </li>
  <li class="{{(Request::is('admins/payment_form/*')) ? 'active' : ''}}">
    <a href="javascript:;" class="menu">
      <i class="fas fa-clipboard-list"></i>
      <span class="link-title">&nbsp; Hình thức nộp</span>
      <span class="fa arrow"></span> 
    </a>
    <ul class="collapse">
      <li class="{{(Request::is('admins/payment_form/list')) ? 'active' : ''}}">
        <a href="{{ route('list_payment') }}">
          <i class="fas fa-th-list"></i>&nbsp; Danh sách hình thức </a>
      </li>
      <li class="{{(Request::is('admins/payment_form/insert')) ? 'active' : ''}}">
        <a href="{{ route('getInsert_payment') }}">
          <i class="fas fa-plus-square"></i>&nbsp; Thêm hình thức </a>
      </li>
    </ul>
  </li>
  <li class="{{(Request::is('admins/fee/*')) ? 'active' : ''}}">
    <a href="javascript:;" class="menu">
      <i class="fas fa-donate"></i>
      <span class="link-title">&nbsp; Mức thu</span>
      <span class="fa arrow"></span> 
    </a>
    <ul class="collapse">
      <li class="{{(Request::is('admins/fee/list')) ? 'active' : ''}}">
        <a href="{{ route('list_fee') }}">
          <i class="fas fa-th-list"></i>&nbsp; Danh sách mức thu </a>
      </li>
      <li class="{{(Request::is('admins/fee/insert')) ? 'active' : ''}}">
        <a href="{{ route('getInsert_fee') }}">
          <i class="fas fa-plus-square"></i>&nbsp; Thêm mức thu </a>
      </li>
    </ul>
  </li>
  <li class="{{(Request::is('admins/receipt/*')) ? 'active' : ''}}">
    <a href="{{ route('list_receipt') }}" class="menu">
      <i class="fas fa-id-card"></i>
      <span class="link-title"> &nbsp; Phiếu thu</span>  
    </a>
  </li>
  <li class="nav-divider"></li>
</ul>

@section('script3')
<script type="text/javascript">
  function checkTime(i) 
  {
      if (i < 10) {
          i = "0" + i;
      }
      return i;
  }

  $(document).on('click','#insert_khoa_hoc',function(e){
      var today=new Date();
      var month=(today.getMonth()+1);
      month=checkTime(month);
      var obj = $(this);
      $(this).children('.insert').attr("onclick","");  
      swal({
        title: "Nhắc nhở!",
        text: "Bây giờ đang là tháng "+ month + " nên bạn không được phép thêm khóa học mới. Tiếp tục để dùng thử :D",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "green",
        confirmButtonText: "Next to!",
        cancelButtonText: "Cancel",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm){
        if (isConfirm) { 
          obj.children('.insert')[0].click();  
        } else {
          obj.children('.insert').attr("onclick","return false")
        }
      });
    });
      
</script>

@endsection