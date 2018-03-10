<?php

namespace Scheduler\App\Http\Controllers\Admin\Priority;

use DB;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Http\Request;
use Scheduler\App\Models\Level;
use Scheduler\App\Models\Faculty;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Subject;
use Scheduler\App\Models\FacultyType;
use Scheduler\App\Http\Controllers\Controller;

class SetPriorityController extends Controller
{
    
    /**
     * Index view page of assign subject to faculties
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
	public function subjectToFacultyView(Request $request)
	{
		// $faculties = Faculty::with(['faculty_type', 'programs', 'subjects', 'levels'])->get();
		// return $faculties;
		$data = [
            'breadcrumb' => 'Set Priority > Assign Faculty',
            'page_title' => 'Lists',
            'programs'   => Program::all(),
            'levels'     => Level::all(),
            'subjects'   => Subject::all(),
        ];
    	return admin_view('pages.set-priority.subject-faculty-index', $data);
	}

	public function getFaculties(Request $request)
	{
		$faculties = Faculty::with(['faculty_type', 'programs', 'subjects', 'levels'])->get();

		return DataTables::of($faculties)
						->filter(function($instance) use($request){
							if ($request->has('programs') && $request->programs != 'all') {
								$instance->collection = $instance->collection->filter(function($row) use($request){
									foreach($row['programs'] as $programs){
										if ($programs['id'] == $request->programs) {
											return true;
										}
										$programs = null;
										$row = [];
									}
									return false;
								});
							}
						})
						->make(true);
	}

    /**
     * Add load/subject to faculty
     *
     * @param  \Illuminate\Http\Request
     *
     * @return  \Illuminate\Http\Response
     */
    public function assignSubjectToFacultyView(Request $request, $id)
    {

        if (! $this->can('can_edit_faculty')) {
            return admin_view('pages.no-permission');
        }

        $faculty = Faculty::find($id);
       
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
            'form_title'  => 'Update faculty load',
            'status'      => ['Inactive', 'Active'],
            'programs'     => Program::all(),
            'facultytypes' => FacultyType::all(),
            'levels'       => Level::all(),
            'subjects'     => Subject::all(),
        ];
        //return $data;
        return admin_view('pages.set-priority.subject-faculty', $data);
    }

    /**
     * Update faculty load
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Scheduler\App\Repositories\FacultyRepository $repo
     * 
     * @return \Illuminate\Http\Response
     */
    public function assignSubjectToFaculty(Request $request)
    {
        $request->validate(['faculties' => 'required']);

        $subject = Subject::find($request->id);

        if ($this->updateFacultyLoad($request, $subject)) {
            if ($request->has('api')) {
                return response()->json(['message' => 'Faculty load has been updated'], 200);
            }

            return redirect('admin/set-priority/subject/' . $request->id)->with('success', 'Faculty load has been updated.');
        }

        if ($request->has('api')) {
            return response()->json(['message' => 'Can not update faculty load.'], 422);
        }

        return redirect('admin/set-priority/subject/' . $request->id)->with('error', 'Can not update faculty load');
    }


    /**
	 * Update faculty load
	 * 
	 * @param  \Illuminate\Http\Request $request
	 * @param  Faculty $faculty
	 * 
	 * @return bool
	 */
	public function updateFacultyLoad(Request $request, Subject $subject)
	{

		try {
			$faculties = [];
			foreach($request->faculties as $faculty){
				$faculties[$faculty] = ['year_created' => date('Y')];
			}

			DB::transaction(function() use ($subject, $request, $faculties){
				$subject->faculties()->sync($faculties);
			});


		} catch (\Exception $e) {
			return false;
		}

		return true;
	}
}
