<?php

namespace Scheduler\App\Http\Controllers\Admin\Faculty;

use App\User;
use Illuminate\Http\Request;
use Scheduler\App\Models\Level;
use Scheduler\App\Models\Subject;
use Scheduler\App\Models\Faculty;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Specialty;
use Scheduler\App\Models\FacultyType;
use Scheduler\App\Models\Institution;
use Yajra\DataTables\Facades\DataTables;
use Scheduler\App\DataTables\FacultyDataTable;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\Repositories\FacultyRepository;
class FacultyController extends Controller
{
    

    public function indexView(FacultyDataTable $dataTable)
    {
    	$data = [
            'breadcrumb' => 'Faculty Management',
            'page_title' => 'Lists',
        ];
    	return $dataTable->render($this->admin_view . 'pages.faculty.index', $data);
    }

    public function create()
    {

        if (! $this->can('can_add_faculty')) {
            return admin_view('pages.no-permission');
        }

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
        if (! $this->can('can_edit_faculty')) {
            return admin_view('pages.no-permission');
        }

        $faculty = Faculty::find($id);
        $specialties = Specialty::all();
        $programs = Program::all();
        $facultytypes = FacultyType::all();
        $institutions = Institution::all();
       
        $faculty->institution;
        $faculty->specialties;
        $faculty->subjects;
        $faculty->faculty_type;
        $faculty->year_actives;
        $faculty->levels;
        $faculty->programs;
        
        $data = [
            'faculty'     => $faculty,
            'page_title'  => 'Faculty::Update',
            'url'         => url('admin/faculty/' . $id . '/update'),
            'form_title'  => 'Update faculty',
            'status'      => ['Inactive', 'Active'],
            'specialties' => $specialties,
            'programs'    => $programs,
            'facultytypes' => $facultytypes,
            'institutes' => $institutions,
        ];
        
        return admin_view('pages.faculty.form', $data);
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
        if ($repo->saveFromRequest($request, new Faculty)) {
            return redirect('admin/faculty')->with('success', 'Faculty successfully updated.');
        }
        return redirect('admin/faculty')->with('error', 'Error while saving faculty. Please try again.');
    }

    /**
     * Update the model
     */
    public function update(Request $request, FacultyRepository $repo, $id)
    {
        
        $faculty = Faculty::find($id);

        $this->validateRequestFacultyData($request, $id);
        if (is_null($request->password)) {
            $request->request->remove('password');
        }

        $institution_id = $request->institution;
        $faculty_type_id = $request->faculty_type;

        $request->request->remove('institution');
        $request->request->remove('faculty_type');

        $request->request->add(['status' => (int) $request->status]);
        $request->request->add(['faculty_type_id' => (int) $faculty_type_id]);
        $request->request->add(['institution_id' => (int) $institution_id]);
        
        if ($repo->saveFromRequest($request, $faculty)) {
            return redirect('admin/faculty')->with('success', 'Faculty successfully updated.');
        }
        return redirect('admin/faculty')->with('error', 'Error while updating faculty. Please try again.');
    }

    /**
     * Soft delete the given model
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return  \Illuminate\Http\Response
     */
    public function delete(Request $request, Faculty $faculty, $id)
    {
        if ($faculty->find($id)->delete()) {
            return response()->json(['message' => 'Faculty deleted'], 200);
        }

        return response()->json(['message' => 'Error deleting of faculty'], 500);
    }


    /**
     * Validate request
     * 
     * @param  Request $request
     * @param  null|int         If not null, faculty should be updated even not changing ID
     * 
     * @return \Illuminate\Http\Request
     */
    private function validateRequestFacultyData(Request $request, $id = null)
    {
        // $id_validate = !is_null($id)
        //             ? 'required|unique:faculties,faculty_id_number,' . $id . ',id'
        //             : 'required|unique:faculties';
        
        $id_validate = 'required|unique:faculties';
        $email_validate = 'required|email|unique:faculties';

        if (!is_null($id)) {
            $id_validate = 'required|unique:faculties,faculty_id_number,' . $id . ',id';
            $email_validate = 'required|email|unique:faculties,email,' . $id . ',id';
        }

        //echo $id_validate;exit;

        $request->validate([
            'faculty_id_number' => $id_validate,
            'faculty_type' => 'required',
            'institution' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,bmp,png,jpg',
            'lastname' => 'required',
            'firstname' => 'required',
            'email'     => $email_validate,
            'gender' => 'required',
            'graduated_school_name' => 'required',
            'degree' => 'required',
            'major' => 'required',
            'minor' => 'required',
            'minimum_units' => 'required',
            'maximum_units' => 'required',
        ]);
    }

    /**
     * Get faculty load
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  Schedulers\App\Faculty $faculty
     * @param  int  $id
     * 
     * @return \Illuminate\Database\Eloquent
     */
    public function ajaxViewFacultyLoad(Request $request, Faculty $faculty, $id)
    {

        $faculty = [];
        if ($request->ajax()) {            
            // if (! $this->can('can_add_faculty')) {
            //     return response()->json(['message' => 'Sorry you have no permission to view this resource.'], 500);
            // }
            $faculty = DataTables::of(Faculty::find($id)
                            ->subjects()
                            ->get())->make(true);
        }

        return $faculty;
        
    }

}
