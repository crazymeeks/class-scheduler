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

    /**
     * Display edit page
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        $faculty = Faculty::find($id);
        $faculty_data = $faculty->active()
                                ->with([
                                    'institution', 'specialties',
                                    'subjects', 'faculty_type',
                                    'year_actives', 'levels',
                                    'programs',
                                ])->get();
        
        $data = [
            'faculty' => $faculty_data,
            'page_title' => 'Faculty::Update',
            'url' => url('admin/faculty/' . $id . '/update'),
            'form_title' => 'Update faculty',
        ];
        //return $data;
        return admin_view('pages.faculty.form', $data);
    }
}
