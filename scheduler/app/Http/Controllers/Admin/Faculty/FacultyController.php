<?php

namespace Scheduler\App\Http\Controllers\Admin\Faculty;

use Illuminate\Http\Request;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\DataTables\FacultyDataTable;
use Yajra\DataTables\Facades\DataTables;
use Scheduler\App\Models\Faculty;
class FacultyController extends Controller
{
    

    public function indexView(FacultyDataTable $dataTable)
    {

    	// $faculties = Faculty::select(['id_number']);
    	// return [$faculties];
    	// return DataTables::of($faculties)
    	// 				->addColumn('institution', function($faculties){
    	// 					return $faculties->institution;
    	// 				})->make(true);
    	$data = [
            'breadcrumb' => 'Faculty Management',
            'page_title' => 'Lists',
        ];
    	return $dataTable->render($this->admin_view . 'pages.faculty.index', $data);
    }
}
