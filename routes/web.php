<?php


Route::get('login','Admin\LoginController@getlogin')->name('login');
Route::post('login','Admin\LoginController@postlogin')->name('post_login');
Route::get('logout','Admin\LoginController@getlogout')->name('logout');


//Begin Route Group Adminstrator================================================================================

Route::group(['middleware' => 'checklogin'], function () {
	Route::group(['prefix' => 'admins','namespace' => 'Admin'], function() {

		//Route HOME
		Route::group(['prefix' => '/'], function() {
			Route::get('/','HomeController@get_home')->name('home');
		});

		// Route tài khoản cá nhân
	    Route::group(['prefix' => 'personal_account'], function() {
	       	Route::get('account/{id}','AccountController@get_acc')->name('view_user');
			Route::post('update/{id}','AccountController@post_account')->name('postUpdate_account');
			Route::post('check/{id}','AccountController@check_update')->name('check');
			Route::get('pass/{id}','AccountController@get_pass')->name('getUpdate_pass');
			Route::post('pass/{id}','AccountController@post_pass')->name('postUpdate_pass');
	    });

		// Route tài khoản
	    Route::group(['prefix' => 'user'], function() {
	       	Route::get('list','AccountController@get_user')->name('list_user');
			Route::get('insert','AccountController@get_insert')->name('getInsert_user');
			Route::post('insert','AccountController@post_insert')->name('postInsert_user');
			Route::get('update/{id}','AccountController@get_update')->name('getUpdate_user')->where(['id' => '[A-Z0-9]+']);
			Route::post('update/{id}','AccountController@post_update')->name('postUpdate_user')->where(['id' => '[A-Z0-9]+']);
			Route::get('delete/{id}','AccountController@get_delete')->name('delete_user')->where(['id' => '[A-Z0-9]+']);
	    });

	    //Route ngành
	    Route::group(['prefix' => 'major'], function() {
	       	Route::get('list','MajorsController@get_major')->name('list_majors');
			Route::get('insert','MajorsController@get_insert')->name('getInsert_majors');
			Route::post('insert','MajorsController@post_insert')->name('postInsert_majors');
			Route::get('update/{id}','MajorsController@get_update')->name('getUpdate_majors')->where(['id' => '[A-Z0-9]+']);
			Route::post('update/{id}','MajorsController@post_update')->name('postUpdate_majors')->where(['id' => '[A-Z0-9]+']);
			Route::get('delete/{id}','MajorsController@get_delete')->name('delete_majors')->where(['id' => '[A-Z0-9]+']);
	    });

	     //Route khóa học
	    Route::group(['prefix' => 'course'], function() {
	       	Route::get('list','CourseController@get_course')->name('list_course');
			Route::get('insert','CourseController@get_insert')->name('getInsert_course');
			Route::post('insert','CourseController@post_insert')->name('postInsert_course');
			Route::get('update/{id}','CourseController@get_update')->name('getUpdate_course')->where(['id' => '[A-Z0-9]+']);
			Route::post('update/{id}','CourseController@post_update')->name('postUpdate_course')->where(['id' => '[A-Z0-9]+']);
			Route::get('delete/{id}','CourseController@get_delete')->name('delete_course')->where(['id' => '[A-Z0-9]+']);
	    });

	     //Route  lớp học
	    Route::group(['prefix' => 'class'], function() {
	       	Route::get('list','ClassesController@get_class')->name('list_classes');
			Route::get('insert','ClassesController@get_insert')->name('getInsert_classes');
			Route::post('insert','ClassesController@post_insert')->name('postInsert_classes');
			Route::get('update/{id}','ClassesController@get_update')->name('getUpdate_classes')->where(['id' => '[A-Z0-9]+']);
			Route::post('update/{id}','ClassesController@post_update')->name('postUpdate_classes')->where(['id' => '[A-Z0-9]+']);
			Route::get('delete/{id}','ClassesController@get_delete')->name('delete_classes')->where(['id' => '[A-Z0-9]+']);
	    });

	     //Route  đối tượng
	    Route::group(['prefix' => 'object'], function() {
	       	Route::get('list','ObjectsController@get_object')->name('list_objects');
			Route::get('insert','ObjectsController@get_insert')->name('getInsert_objects');
			Route::post('insert','ObjectsController@post_insert')->name('postInsert_objects');
			Route::get('update/{id}','ObjectsController@get_update')->name('getUpdate_objects')->where(['id' => '[A-Z0-9]+']);
			Route::post('update/{id}','ObjectsController@post_update')->name('postUpdate_objects')->where(['id' => '[A-Z0-9]+']);
			Route::get('delete/{id}','ObjectsController@get_delete')->name('delete_objects')->where(['id' => '[A-Z0-9]+']);
	    });

	    //Route  sinh viên
	    Route::group(['prefix' => 'student'], function() {
	       	Route::get('list','StudentsController@get_student')->name('list_students');
			Route::get('insert','StudentsController@get_insert')->name('getInsert_students');
			Route::post('insert','StudentsController@post_insert')->name('postInsert_students');
			Route::get('update/{id}','StudentsController@get_update')->name('getUpdate_students')->where(['id' => '[A-Z0-9]+']);
			Route::post('update/{id}','StudentsController@post_update')->name('postUpdate_students')->where(['id' => '[A-Z0-9]+']);
			Route::get('delete/{id}','StudentsController@get_delete')->name('delete_students')->where(['id' => '[A-Z0-9]+']);

			Route::get('ajax_khoa/{id}','AjaxSinhVienController@get_khoa')->name('ajax_get_khoa');
			Route::get('ajax_lop/{id1}/{id2}','AjaxSinhVienController@get_lop')->name('ajax_get_lop');
			Route::get('ajax_sinhvien/{id}','AjaxSinhVienController@get_sinhvien')->name('ajax_get_sinh_vien');

			Route::get('ajax_search/{id}','AjaxSinhVienController@get_search');

			/*Route::get('change_class/{id}','StudentsController@get_change_class')->name('get_change_class');
			Route::post('change_class/{id}','StudentsController@post_change_class')->name('post_change_class');*/
	    });

	    //Route hinh thức nộp
	    Route::group(['prefix' => 'payment_form'], function() {
	       	Route::get('list','PaymentController@get_payment')->name('list_payment');
			Route::get('insert','PaymentController@get_insert')->name('getInsert_payment');
			Route::post('insert','PaymentController@post_insert')->name('postInsert_payment');
			Route::get('update/{id}','PaymentController@get_update')->name('getUpdate_payment')->where(['id' => '[A-Z0-9]+']);
			Route::post('update/{id}','PaymentController@post_update')->name('postUpdate_payment')->where(['id' => '[A-Z0-9]+']);
			Route::get('delete/{id}','PaymentController@get_delete')->name('delete_payment')->where(['id' => '[A-Z0-9]+']);
	    });

	    //Route mức thu
	    Route::group(['prefix' => 'fee'], function() {
	       	Route::get('list','FeeController@get_fee')->name('list_fee');
			Route::get('insert','FeeController@get_insert')->name('getInsert_fee');
			Route::post('insert','FeeController@post_insert')->name('postInsert_fee');
			Route::get('update/{id}','FeeController@get_update')->name('getUpdate_fee')->where(['id' => '[A-Z0-9]+']);
			Route::post('update/{id}','FeeController@post_update')->name('postUpdate_fee')->where(['id' => '[A-Z0-9]+']);
			Route::get('delete/{id}','FeeController@get_delete')->name('delete_fee')->where(['id' => '[A-Z0-9]+']);
	    });

	    //Route phiếu thu
	    Route::group(['prefix' => 'receipt'], function() {
	       	Route::get('list','ReceiptController@get_receipt')->name('list_receipt');
	       	Route::get('infor/{id1}/{id2}','ReceiptController@get_infor')->name('getInfor_receipt')->where(['id' => '[A-Z0-9]+']);
	       	Route::get('ajax_receipt_sinhvien/{id}','ReceiptController@get_receipt_sinhvien');
			/*Route::get('insert','ReceiptController@get_insert')->name('getInsert_receipt');
			Route::post('insert','ReceiptController@post_insert')->name('postInsert_receipt');
			Route::get('update/{id}','ReceiptController@get_update')->name('getUpdate_receipt')->where(['id' => '[A-Z0-9]+']);
			Route::post('update/{id}','ReceiptController@post_update')->name('postUpdate_receipt')->where(['id' => '[A-Z0-9]+']);*/
			/*Route::get('delete/{id}','ReceiptController@get_delete')->name('delete_receipt')->where(['id' => '[A-Z0-9]+']);*/
	    });

	});
});

// End Route Admin==============================================================================================

//Route Users===================================================================================================
Route::get('sign_in','User\LoginController@getlogin')->name('login_user');
Route::post('sign_in','User\LoginController@postlogin')->name('post_login_user');
Route::get('sign_off','User\LoginController@getlogout')->name('logout_user');

Route::group(['middleware' => 'checksignin'], function () {
	Route::group(['prefix' => 'users','namespace' => 'User'], function() {

		//Route HOME
		Route::group(['prefix' => '/'], function() {
			Route::get('/','HomeController@get_home')->name('index');
		});

		// Route tài khoản
	    Route::group(['prefix' => 'account'], function() {
	       	Route::get('list','AccountController@get_user')->name('list_account');
			Route::get('personal/{id}','AccountController@get_acc')->name('view_account')->where(['id' => '[A-Z0-9]+']);
			
			Route::post('update/{id}','AccountController@post_account')->name('update_account')->where(['id' => '[A-Z0-9]+']);
			Route::post('check/{id}','AccountController@check_update')->name('check_update');
			Route::get('pass','AccountController@get_pass')->name('get_pass');
			Route::post('pass/{id}','AccountController@post_pass')->name('post_pass')->where(['id' => '[A-Z0-9]+']);
	    });

	    //Route  lớp học
	    Route::group(['prefix' => 'class'], function() {
	    	Route::get('classes','ClassesController@list_class')->name('list_class');
	    	Route::get('list_class','ClassesController@get_class')->name('classes');
	    	/*Route::get('list_class_print','ClassesController@get_class_print');*/
	    	Route::get('ajax_khoa/{id}','AjaxLopController@get_khoa');
	    	Route::get('ajax_lop/{id1}/{id2}','AjaxLopController@get_lop_chi_tiet')->name('ajax_lop_chi_tiet');
	    	Route::get('list_class_print/{id1}/{id2}','AjaxLopController@get_class_print');
	    	Route::get('ajax_khoa/{id1}/{id2}','AjaxLopController@get_title');
	    }); 	
	    //Route  sinh viên
	    Route::group(['prefix' => 'student'], function() {
	   		Route::get('students','StudentsController@list_student')->name('students');
	   		Route::get('list_students/{id}','StudentsController@get_student')->name('list_student');
	   		Route::get('check_sv_print/{id}','StudentsController@check_student');

	   		Route::get('ajax_khoa/{id}','StudentsController@get_khoa');
	    	Route::get('ajax_lop/{id1}/{id2}','StudentsController@get_lop');
	    	Route::get('ajax_sinhvien/{id}','StudentsController@get_sinhvien');
	    	Route::get('ajax_get_print/{id}','StudentsController@get_title');
	    });
	    //Route Thu phí
	    Route::group(['prefix' => 'receipt'], function() {
	       	Route::get('list_receipt','ReceiptController@get_receipt')->name('list_receipt_student');

	       	Route::get('ajax_khoa/{id}','AjaxReceiptController@get_khoa');
	    	Route::get('ajax_lop/{id1}/{id2}','AjaxReceiptController@get_lop');
	    	Route::get('ajax_sinhvien/{id}','AjaxReceiptController@get_sinhvien');
	    	Route::get('ajax_hinhthuc/{id}','AjaxReceiptController@get_hinh_thuc');
	    	Route::get('ajax_phi_thu/{id1}/{id2}','AjaxReceiptController@get_phi_thu');

	    	Route::get('ajax_phieu_thu/{id}','AjaxReceiptController@get_phieu_thu');
	    	Route::get('check/{id}','AjaxReceiptController@check');

			Route::post('insert/{id1}/{id2}','ReceiptController@post_insert')->name('postInsert_receipt');
			Route::get('ajax_print_phieu_thu/{id}','ReceiptController@get_print');
			Route::get('delete/{id}','ReceiptController@get_delete')->name('delete_receipt')->where(['id' => '[A-Z0-9]+']);

			Route::get('search/{keyword}','AjaxReceiptController@search')->name('search_sinh_vien_no_phi');
		});

		Route::group(['prefix' => 'statistical'], function() {
			Route::get('bao_cao_thu_phi_theo_nganh','ReceiptController@get_phi_nganh')->name('list_receipt_nganh');

			Route::get('bao_cao_thu_phi_theo_lop','ReceiptController@get_phi_lop')->name('list_receipt_lop');
			Route::get('bao_cao_theo_lop/{id1}/{id2}/{id3}','ReceiptController@bao_cao_theo_lop');

			Route::get('danh_sach_no_phi','ReceiptController@get_no_phi')->name('list_receipt_no_phi');
			Route::get('chua_nop/{id1}/{id2}','ReceiptController@list_chua_nop');

			Route::get('hoc_vien_nop_muon','ReceiptController@get_mop_muon')->name('list_receipt_mop_muon');
			Route::get('nop_muon/{id1}/{id2}/{id3}','ReceiptController@nop_hp_muon');
			

		});

		//Route Import Excel
		Route::post('importExcel', 'User\ExcelController@importExcel')->name('postExcel');
	});
});


//End Route Users===============================================================================================

//--------------------------------------------------------------
//Route test
use App\Models\SinhVienModel;
use App\Models\NganhModel;
use App\Models\KhoaHocModel;
use App\Models\LopModel;
use App\Models\TaiKhoanModel;
use App\Models\PhieuThuModel;
use App\Models\MucThuModel;
use App\Models\HinhThucModel;
use Carbon\Carbon;
/*
Route::get('downloadExcel/{type}', 'User\ExcelController@downloadExcel')->name('getDowExcel');
Route::post('importExcel', 'User\ExcelController@importExcel')->name('postExcel');*/

Route::get('test', function() {
	$sinh_vien=SinhVienModel::getAll_TinhTrang();
        $data=array();
        $nested=array();
        $count=count($sinh_vien);
        if($count > 0)
        {
            $month_now=date('m');
            $year_now=date('Y');
            $arr_sinh_vien=array();
            foreach ($sinh_vien as $value) {
                $arr_sinh_vien[]=$value->ma_sinh_vien;
            }
            for($i=0; $i<count($arr_sinh_vien); $i++)
            {
                $obj=SinhVienModel::getByID($arr_sinh_vien[$i]);
                $hoc_phi=MucThuModel::get_muc_thu_thang($obj->ma_nganh,1);
                $phi_qui_dinh=$hoc_phi->muc_thu_qui_dinh;
                $hoc_bong=$obj->ty_le_phan_tram/100;
                $phi_giam=$hoc_phi->ty_le_giam/100;
                $so_tien_can_nop=$phi_qui_dinh-($phi_qui_dinh*($hoc_bong+$phi_giam));

                $dot_thu_max=PhieuThuModel::where('sinh_vien_ma',$obj->ma_sinh_vien)->max('dot_thu');
                if(count($dot_thu_max) >0)
                {
                    $date=PhieuThuModel::select('thang_da_nop','nam_hoc')->where('dot_thu',$dot_thu_max)->first();
                    $thang_da_nop=$date->thang_da_nop;
                    $nam_hoc=$date->nam_hoc;
                    if($thang_da_nop < 10)
                    {
                        $thang_da_nop='0'.$thang_da_nop;
                    }
                    $date_string=$nam_hoc.'-'.$thang_da_nop.'01';
                    $today= date('Y-m-d');

                    if($today <= $date_string)
                    {
                       $nested=0;
                    }else {
                        if($month_now > 5 && $month_now < 8)
                        {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_num=5-$thang_da_nop;
                            $so_thang_chua_nop=$year_num+$month_num;
                            $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }
                        else {
                            if($month_now >=8)
                            {
                                $year_num=($year_now-$nam_hoc)*12;
                                $month_du=2;
                                if($year_now-$nam_hoc == 2)
                                {
                                    $month_num=$month_now-$thang_da_nop-($month_du*2);
                                }elseif ($year_now-$nam_hoc == 3) {
                                    $month_num=$month_now-$thang_da_nop-($month_du*3);
                                }else {
                                    $month_num=$month_now-$thang_da_nop-$month_du;
                                }
                                $so_thang_chua_nop=$year_num+$month_num;
                                $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }else {
                                $year_num=($year_now-$nam_hoc)*12;
                                $month_num=$month_now-$thang_da_nop;
                                $so_thang_chua_nop=$year_num+$month_num;
                                $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                            }
                        }    
                    }
                    
                    
                }else {
                    $date=SinhVienModel::getByID($obj->ma_sinh_vien);
                    $thang_bat_dau=date('m',strtotime($date->ngay_bat_dau));
                    $nam_hoc=date('Y',strtotime($date->ngay_bat_dau));
                    if($month_now > 5 && $month_now < 8)
                    {
                        $year_num=($year_now-$nam_hoc)*12;
                        $month_num=5-$thang_bat_dau;
                        $so_thang_chua_nop=$year_num+$month_num+1;
                        $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                    }else {
                        if($month_now >=8)
                        {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_du=2;
                            if($year_now-$nam_hoc == 2)
                            {
                                $month_num=$month_now-$thang_bat_dau-($month_du*2);
                            }elseif ($year_now-$nam_hoc == 3) {
                                $month_num=$month_now-$thang_bat_dau-($month_du*3);
                            }else {
                                $month_num=$month_now-$thang_bat_dau-$month_du;
                            }
                            $so_thang_chua_nop=$year_num+$month_num+1;
                            $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }else {
                            $year_num=($year_now-$nam_hoc)*12;
                            $month_num=$month_now-$thang_bat_dau;
                            $so_thang_chua_nop=$year_num+$month_num+1;
                            $nested=number_format(round($so_tien_can_nop*$so_thang_chua_nop, -3, PHP_ROUND_HALF_UP),0,",",".");
                        }
                    }   

                }
                $data[]=$nested;
            }
            $arr_no=array();
            for($i=0; $i<count($data); $i++)
            {
                if($data[$i] != 0)
                {
                    $arr_no[]=$data[$i];
                }
            }
            $count_no_phi=count($arr_no);
        }else {
            $count_no_phi=0;
        }

        return response()->json($count_no_phi);
        
});
//=============================================================