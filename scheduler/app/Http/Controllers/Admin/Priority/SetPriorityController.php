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
use Illuminate\Database\Eloquent\Model;
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
		$faculties = Faculty::with(['faculty_type', 'programs', 'subjects', 'levels'])->active()->get();

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
            'url'         => url('/admin/set-priority'),
            'form_title'  => 'Update faculty load',
            'status'      => ['Inactive', 'Active'],
            'programs'     => Program::all(),
            'facultytypes' => FacultyType::all(),
            'levels'       => Level::all(),
            'subjects'     => Subject::with(['subject_type'])->active()->get(),
            'id'           => $id,
        ];
        
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
    public function assign(Request $request)
    {

        // assign faculty to subject
        if ($request->has('faculties')) {
            $request->validate(['faculties' => 'required|array']);
            $model = Subject::find($request->id);
            $relation = 'faculties';
        }elseif($request->has('subjects')) {
            $request->validate(['subjects' => 'required|array']);
            $model = Faculty::find($request->id);
            $relation = 'subjects';
        }

        $redirect = $relation == 'subjects' ? 'faculties' : $relation;

        if ($this->updateFacultyLoad($request, $model, $relation)) {
            if ($request->has('api')) {
                return response()->json(['message' => 'Faculty load has been updated'], 200);
            }
            
            return redirect("admin/set-priority/$redirect")->with('success', 'Priority has been set to ' . $model->firstname . ' ' . $model->lastname);
        }

        if ($request->has('api')) {
            return response()->json(['message' => 'Can not update faculty load.'], 422);
        }

        return redirect("admin/set-priority/$redirect")->with('error', 'Can not update faculty load');

        
    }

    /**
     * Assign subject to faculty
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    protected function faculty(Request $request)
    {
        
    }


    /**
	 * Update faculty load
	 * 
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Illuminate\Database\Eloquent\Model $model
	 * @param  string $relation    The model's relation
     * 
	 * @return bool
	 */
	private function updateFacultyLoad(Request $request, Model $model, $relation)
	{

		try {

            $ids = [];

             foreach($request->{$relation} as $id){
                $ids[$id] = ['year_created' => date('Y')];
            }

			DB::transaction(function() use ($model, $request, $ids, $relation){
				$model->{$relation}()->sync($ids);
			});


		} catch (\Exception $e) {
			return false;
		}

		return true;
	}

}
