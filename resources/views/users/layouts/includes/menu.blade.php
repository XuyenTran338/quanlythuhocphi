<div id="wrap" class="navbar-fixed-top">
    <div id="head" >
        <div class="wrap_container">
            <div id="logo">
                <a href="{{ route('index') }}">
                    <img src="user/public/img/bkacad.png" alt="logo">
                </a>
            </div>
            <ul id="main_menu">
                <li>
                	<a><i class="fas fa-th-large icon_color"></i>&nbsp;&nbsp;Hệ thống &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-down"></i></a>
        					<ul class="sub_menu">
        						<li><a href="{{ route('list_account') }}"><i class="fas fa-user icon_color"></i>&nbsp;&nbsp;Thành viên</a></li>
        						<li><a href="{{ route('get_pass')}}"><i class="fas fa-lock icon_color "></i>&nbsp;&nbsp;Đổi mật khẩu</a></li>
        						<li><a href="{{ route('logout_user') }}"><i class="fas fa-power-off icon_color "></i>&nbsp;&nbsp;Đăng xuất</a></li>
        					</ul>
                </li>
               <!--  <li>
       					<a href="#"><i class="fas fa-list-ul icon_color"></i> &nbsp;&nbsp;Danh mục&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-down"></i></a>
       					<ul class="sub_menu">
       						<li><a href=""><i class="fab fa-readme icon_color"></i>&nbsp;&nbsp;Chuyên ngành</a></li>
       						<li><a href=""><i class="fab fa-leanpub icon_color"></i>&nbsp;&nbsp;Khóa học</a></li>
       					</ul>
       				</li> -->
        				<li><a href="{{ route('list_class') }}"><i class="fas fa-book icon_color"></i>&nbsp;&nbsp;Lớp học</a></li>
        				<li><a href="{{ route('students') }}"><i class="fas fa-graduation-cap icon_color"></i>&nbsp;&nbsp;Học viên</a></li>
        				<li><a href="{{ route('list_receipt_student') }}"><i class="fas fa-donate icon_color"></i>&nbsp;&nbsp;Thu phí</a></li>
        				<li>
        					<a><i class="fas fa-building icon_color"></i>&nbsp;&nbsp;Báo cáo&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-down"></i></a>
        					<ul class="sub_menu">
        						<!-- <li><a href="{{ route('list_receipt_nganh') }}"><i class="fas fa-building icon_color "></i>&nbsp;&nbsp;Thu phí theo ngành</a></li> -->
        						<li><a href="{{ route('list_receipt_lop') }}"><i class="fas fa-building icon_color "></i>&nbsp;&nbsp;Thu phí theo lớp</a></li>
        						<li><a href="{{ route('list_receipt_no_phi') }}"><i class="fas fa-building icon_color "></i>&nbsp;&nbsp;Học viên nợ phí</a></li>
        				   <li><a href="{{ route('list_receipt_mop_muon') }}"><i class="fas fa-building icon_color "></i>&nbsp;&nbsp;Học viên nộp muộn</a></li>
        						<!-- <li><a href=""><i class="fas fa-building icon_color "></i>&nbsp;&nbsp;Báo cáo ngành đã lập</a></li> -->
        					</ul>
        				</li>
        				<!-- <li><a href=""><i class="fas fa-clipboard-list icon_color"></i>&nbsp;&nbsp;Biên lai</a></li> -->
                        
            </ul>
        </div>
    </div>
    
</div>
<style type="text/css">
  #main_menu>li{ 
  float: left; 
  border-right: 1px solid #E8E8E8;
  display: inline-block;
  }
  /* #main_menu li:last-child{ 
    border-right: none;
  } */
  #main_menu li{ 
    position: relative;
  }
  #main_menu>li a{
    display: block; 
    text-transform: none; 
    padding: 10px;
  }

  #main_menu>li>a{ 
    display: block; 
    padding: 20px;
  }
  #main_menu li .sub_menu{ 
    display: none;
    width: 200px;
    background: hsl(0, 0%, 93%);
    margin-top:5px;
    margin-left: -1px;
  }

  #main_menu li:hover > ul { 
    display: block;
    background: white;
  }
  #main_menu li .sub_menu{
    top: 55px;
    position: absolute;
    left: 0px;
  }

  #main_menu li a:hover{ 
    background-color: hsl(0, 0%, 93%);
    text-decoration: none;
  }
</style>