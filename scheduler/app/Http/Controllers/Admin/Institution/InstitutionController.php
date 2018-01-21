<?php

namespace Scheduler\App\Http\Controllers\Admin\Institution;

use Illuminate\Http\Request;
use Scheduler\App\Models\Institution;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\DataTables\InstitutionDataTable;
use Scheduler\App\Repositories\InstitutionRepository;
use Scheduler\App\Http\Requests\InstitutionFormRequest;
class InstitutionController extends Controller
{
    
 	/**
 	 * Display instution index page
 	 * 
 	 * @param  InstitutionDataTable $dataTable
 	 * 
 	 * @return \Illuminate\Http\Response
 	 */
    public function indexView(InstitutionDataTable $dataTable)
    {
    	
    	return $dataTable->render($this->admin_view . 'pages.institution.index', ['page_title' => 'Institution']);
    }

    /**
     * Create a new resource
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	$data = ['page_title' => 'Institution::Create'];
    	return admin_view('pages.institution.form', $data);
    }

    /**
     * Save the given model
     * 
     * @param  Scheduler\App\Http\Requests\InstitutionFormRequest;
     * 
     * @return \Illuminate\Http\Response
     */
    public function save(InstitutionFormRequest $request, InstitutionRepository $repo)
    {
    	if ($repo->saveFromRequest($request, new Institution())) {
    		return redirect('admin/institution')->with('success', 'New institution has been saved.');
    	}
    	return redirect('admin/institution')->with('error', 'Error occured while saving Institution. Please try again.');
    }

    /**
     * Soft delete the model
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return bool
     */
    public function delete(Request $request)
    {
        if (Institution::find($request->id)->delete()) {
            return 'Institution successfully deleted.';
        }

        return false;
    }
}
