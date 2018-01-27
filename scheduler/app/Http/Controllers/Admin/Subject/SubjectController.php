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
        $specialties = Specialty::all();
        $programs = Program::all();
        $facultytypes = FacultyType::all();
        $institutions = Institution::all();

        
        $data = [
            'page_title'  => 'Faculty::Update',
            'url'         => url('admin/faculty/save'),
            'form_title'  => 'Update faculty',
            'status'      => ['Inactive', 'Active'],
            'specialties' => $specialties,
            'programs'    => $programs,
            'facultytypes' => $facultytypes,
            'institutes' => $institutions,
        ];
            return admin_view('pages.faculty.form', $data);

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
        
        $data = [
            'subject'     => $subject,
            'page_title'  => 'Subject::Update',
            'url'         => url('admin/subject/' . $id . '/update'),
            'form_title'  => 'Update subject',
            'breadcrumb'  => 'Subject Management',
        ];


        return admin_view('pages.subjects.form', $data);
    }

    public function save(Request $request, FacultyRepository $repo)
    {

        $this->validateRequestFacultyData($request);
        if (is_null($request->password)) {
            $request->request->remove('password');
        }
        
        $institution_id = $request->institution;
        $faculty_type_id = $request->faculty_type;
        $request->request->add(['years_of_experience' => is_null($request->years_of_experience) ? 0 : $request->years_of_experience]);
        $request->request->add(['basic_salary' => is_null($request->basic_salary) ? 0 : $request->basic_salary]);
        $request->request->remove('institution');
        $request->request->remove('faculty_type');

        $request->request->add(['status' => (int) $request->status]);
        $request->request->add(['faculty_type_id' => (int) $faculty_type_id]);
        $request->request->add(['institution_id' => (int) $institution_id]);
        
        //return $request->all();
        if ($repo->saveFromRequest($request, new Faculty, new User)) {
            return redirect('admin/faculty')->with('success', 'Faculty successfully updated.');
        }
        return redirect('admin/faculty')->with('error', 'Error while saving faculty. Please try again.');
    }

    /**
     * Update the model
     */
    public function update(Request $request, SubjectRepository $repo, $id)
    {
        
        $subject = Subject::find($id);

        $this->validateRequestFacultyData($request, $id);

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
    private function validateRequestFacultyData(Request $request)
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
