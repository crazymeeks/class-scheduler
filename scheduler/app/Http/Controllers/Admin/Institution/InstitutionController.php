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
    	$data = [
            'page_title' => 'Institution::Create',
            'url' => url('admin/institution/save'),
        ];
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
        $data = [
            'institution' => Institution::find($id),
            'page_title' => 'Institution::Update',
            'url' => url('admin/institution/' . $id . '/update')
        ];
        
        return admin_view('pages.institution.form', $data);
    }

    /**
     * Update the model
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionFormRequest $request, InstitutionRepository $repo, $id)
    {
        $model = Institution::find($id);
        if ($repo->saveFromRequest($request, $model)) {
           return redirect('admin/institution')->with('success', 'Institution successfully updated.'); 
        }

        return redirect('admin/institution')->with('error', 'Error occured while updating Institution. Please try again.');
    }

}
