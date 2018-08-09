<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SinhVienModel;
use Excel;
use Input;
use Carbon\Carbon;
class ExcelController extends Controller
{
  
	public function downloadExcel($type)
	{
		$data = SinhVienModel::get()->toArray();
		$datetime= new Carbon();
		$file_name='file_excel'.$datetime;
		return Excel::create($file_name, function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
	public function importExcel()
	{
		if(Input::hasFile('import_file')){
			$data = Excel::load(Input::file('import_file'), function($reader) {
				$reader->each(function($sheet){
					foreach($sheet->toArray() as $row)
					{
						SinhVienModel::firstOrCreate($sheet->toArray());
					}
				});
			});

			return redirect()->route('thu_phi');
		}
		return back()->with('error','Lỗi!!');
	}
}
