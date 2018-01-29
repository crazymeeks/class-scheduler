<?php

namespace Scheduler\App\Http\Controllers\Admin\Subject;

use DB;
use Closure;
use App\User;
use Illuminate\Http\Request;
use Scheduler\App\Models\Subject;
use Scheduler\App\Models\Program;
use Yajra\DataTables\Facades\DataTables;
use Scheduler\App\DataTables\SubjectDataTable;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\Repositories\SubjectRepository;
use Scheduler\App\Http\Controllers\Traits\PivotSoftDelete;
class SubjectController extends Controller
{
    use PivotSoftDelete;

    public function indexView(SubjectDataTable $dataTable)
    {

    	$data = [
            'breadcrumb' => 'Subject Management',
            'page_title' => 'Lists',
        ];
    	return $dataTable->render($this->admin_view . 'pages.subjects.index', $data);
    }

    public function create()
    {
        
        $data = [
            'page_title'  => 'Subject::Create',
            'url'         => url('admin/subject/save'),
            'form_title'  => 'Create Subject',
            'programs'         => Program::all(),
        ];
            return admin_view('pages.subjects.form', $data);

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
        
        $subject = Subject::find($id);

        // getting the programs of subject. as of Laravel 5.5
        // this will automatically add programs object
        // in subject model
        $subject->programs;
        $subject_programs = [];
        foreach($subject->programs as $program){
            $subject_programs[] = $program->id;
        }
        
        $data = [
            'subject'          => $subject,
            'subject_programs' => $subject_programs,
            'page_title'       => 'Subject::Update',
            'url'              => url('admin/subject/' . $id . '/update'),
            'form_title'       => 'Update subject',
            'breadcrumb'       => 'Subject Management',
            'programs'         => Program::all(),
        ];

        
        return admin_view('pages.subjects.form', $data);
    }

    /**
     * Save new model
     * 
     * @param  \Illuminate\Http\Request    $request
     * @param  SubjectRepository           $repo
     * 
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, SubjectRepository $repo)
    {

        $this->validateRequestSubjectData($request);
        

        if ($repo->saveFromRequest($request, new Subject)) {
            return redirect('admin/subject')->with('success', 'Subject successfully added.');
        }
        return redirect('admin/subject')->with('error', 'Error while saving subject. Please try again.');
    }

    /**
     * Update the model
     */
    public function update(Request $request, SubjectRepository $repo, $id)
    {
        
        $subject = Subject::find($id);

        $this->validateRequestSubjectData($request, $id);

        if ($repo->saveFromRequest($request, $subject)) {
            return redirect('admin/subject')->with('success', 'Subject has been updated');
        }
        return redirect('admin/subject')->with('error', 'Error while updating subject. Please try again.');
    }

    /**
     * Soft delete the given model
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return  \Illuminate\Http\Response
     */
    public function delete(Request $request, Subject $subject, $id)
    {
        if ($subject->find($id)->delete()) {

            $this->softDelete('program_subject', 'subject_id', $id);
            
            return response()->json(['message' => 'Subject deleted'], 200);
        }

        return response()->json(['message' => 'Error deleting of faculty'], 500);
    }



    /**
     * Validate request
     * 
     * @param  Request $request
     * @param  null|int         If not null, subject should be updated even not changing ID
     * 
     * @return \Illuminate\Http\Request
     */
    private function validateRequestSubjectData(Request $request)
    {

        $request->validate([
            'units' => 'required|numeric',
            'subject_name' => 'required',
            'hours' => 'required|numeric',
        ]);
    }

    /**
     * Get subject's programs
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  Schedulers\App\Models\Subject  $subject
     * @param  int  $id
     * 
     * @return \Illuminate\Database\Eloquent
     */
    public function ajaxViewSubjectPrograms(Request $request, Subject $subject, $id)
    {

        $subjects = [];
        if ($request->ajax()) {            
            $subjects = DataTables::of($subject->find($id)
                            ->programs()
                            ->get())->make(true);
        }

        return $subjects;
        
    }

}
