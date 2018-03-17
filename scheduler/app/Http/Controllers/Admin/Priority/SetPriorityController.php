<?php

namespace Scheduler\App\Http\Controllers\Admin\Priority;

use DB;
use Closure;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Scheduler\App\Models\Level;
use Scheduler\App\Models\Faculty;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Subject;
use Illuminate\Support\Collection;
use Scheduler\App\Models\FacultyType;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Scheduler\App\Models\FacultyPrioritySubject;
use Scheduler\App\Http\Controllers\Controller;
class SetPriorityController extends Controller
{
    
    /**
     * The value of this is faculty_id|subject_id
     * 
     * @var int
     */
    protected $primaryId;

    /**
     * The value of this is faculty_id|secondary_id
     * 
     * @var int
     */
    protected $secondaryId;

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
    	return admin_view('pages.set-priority.assign-faculty', $data);
	}

    /**
     * Get list of faculties.
     *
     * Used by datatable on ajax request
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return mixed
     */
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
     * Display assign subject view
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function assignSubjectView(Request $request)
    {

        // $subjects = Subject::with(['level', 'programs', 'subject_type'])->active()->get();
        // return $subjects;
        $data = [
            'breadcrumb' => 'Set Priority > Assign Subject',
            'page_title' => 'Lists',
            'programs'   => Program::all(),
            'levels'     => Level::all(),
            'subjects'   => Subject::all(),
        ];
        return admin_view('pages.set-priority.assign-subject', $data);
    }

    /**
     * Get list of subjects.
     *
     * Used by datatable on ajax request
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function getSubjects(Request $request)
    {
        $faculties = Subject::with(['level', 'programs', 'subject_type'])->active()->get();

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
    public function formAssignSubjectView(Request $request, $id)
    {

        if (! $this->can('can_edit_faculty')) {
            return admin_view('pages.no-permission');
        }

        $subject = Subject::find($id);
       
        $subject->level;
        $subject->programs;
        $subject->subject_type;
       
        
        $data = [
            'subject'      => $subject,
            'page_title'   => 'Subject::Update',
            'url'          => url('/admin/set-priority/subjects'),
            'form_title'   => 'Update subject priority',
            'status'       => ['Inactive', 'Active'],
            'faculties'    => Faculty::active()->get(),
            
            'id'           => $id,
            // faculty_priority_subject
            'fps'          => FacultyPrioritySubject::where('subject_id', $id)->get(),
        ];
        //return $data;
        return admin_view('pages.set-priority.form-assign-subject', $data);
    }

    /**
     * Add load/subject to faculty
     *
     * @param  \Illuminate\Http\Request
     *
     * @return  \Illuminate\Http\Response
     */
    public function formAssignSubjectToFacultyView(Request $request, $id)
    {

        if (! $this->can('can_edit_faculty')) {
            return admin_view('pages.no-permission');
        }

        $faculty = Faculty::find($id);
       
        $faculty->institution;
        $faculty->specialties;
        //$faculty->subjects;
        $faculty->faculty_type;
        $faculty->year_actives;
        $faculty->levels;
        $faculty->programs;
        
        $data = [
            'faculty'     => $faculty,
            'page_title'  => 'Faculty::Update',
            'url'         => url('/admin/set-priority'),
            'form_title'  => 'Update faculty priority',
            'status'      => ['Inactive', 'Active'],
            'programs'     => Program::all(),
            'facultytypes' => FacultyType::all(),
            'levels'       => Level::all(),
            'subjects'     => Subject::with(['subject_type'])->active()->get(),
            'id'           => $id,
            // faculty_priority_subject
            'fps'          => FacultyPrioritySubject::where('faculty_id', $id)->get(),
        ];
        
        return admin_view('pages.set-priority.form-assign-faculty', $data);
    }

    /**
     * Update faculty load
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Scheduler\App\Repositories\FacultyRepository $repo
     * 
     * @return \Illuminate\Http\Response
     *
     * Use this code later for generating faculty subject
     * using ant colony
     */
    /*public function assign(Request $request)
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

        
    }*/

    /**
     * Assign subject priority to faculty
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function assign(Request $request)
    {
        // assign faculty to subject
        if ($request->has('subjects')) {
            $request->validate(['subjects' => 'required|array']);
            return $this->setPrioritySubject($request, 'subjects');
        }elseif($request->has('faculties')) {
            $request->validate(['faculties' => 'required|array']);
            return $this->setPrioritySubject($request, 'faculties');
        }
    }

    /**
     * Set priority subject
     * 
     * @param \Illuminate\Http\Request $request
     * @param  string $entity    This must be 'faculties' and 'subjects' only
     * 
     * @return  mixed
     */
    private function setPrioritySubject(Request $request, $entity)
    {

        $ids = $this->getIdsFromDb($request, $entity);
        
        $this->delete($request);

        $collectionIds = array_merge($ids,$this->collectUniqueIdsFromArray($request, $ids, $entity));

        $data = [];
        // prepare the data for bulk insert
        foreach($collectionIds as $id){
            $data[] = array($this->primaryId => $request->id, $this->secondaryId => $id);
        }
        if (count($data) > 0) {
            FacultyPrioritySubject::insert($data);

            if ($request->has('api')) {
                return response()->json(['message' => 'Faculty load priority has been updated'], 200);
            }
            $redirect = $entity == 'subjects' ? 'faculties' : 'subjects';
            return redirect("admin/set-priority/$redirect")->with('success', 'Priority has been updated');
        }

        // no information is process
        if ($request->has('api')) {
            return response()->json(['message' => 'No priority has been set'], 422);
        }

        return redirect("admin/set-priority/$redirect")->with('success', 'Priority has not updated');
        
    }

    /**
     * Get request data and get the unique value from it
     * 
     * @param  Illuminate\Http\Request $request
     * @param  array  $ids
     * @param  string $entity
     * 
     * @return array
     */
    private function collectUniqueIdsFromArray(Request $request, $ids, $entity)
    {
        if (count($ids) > count($request->{$entity})) {
            $collection = collect($ids);
            $diff = $collection->diff($request->{$entity});
        }else{
            $collection = collect($request->{$entity});
            $diff = $collection->diff($ids);
        }
        return $diff->all();
    }

    /**
     * Get the ids to be inserted
     * in faculty_priority_subject table
     * 
     * @param  \Illumiate\Database\Query\Builder|Closure $lists
     * @param  string $nameId The foreign key name in the faculty_priority_subject table
     * 
     * @return mixed
     */
    private function getIdsFromDb($request, $entity = null)
    {

        $lists = DB::table('faculty_priority_subject');
        
        if ( $request instanceof Closure ) {
            return $request($lists);
        }

        if ( $entity == 'subjects' ) {
            $lists = $lists->whereIn('subject_id', $request->{$entity})
                  ->where('faculty_id', $request->id)
                  ->get();

            $this->secondaryId = 'subject_id';
            $this->primaryId = 'faculty_id';

        } else {
             $lists = $lists->whereIn('faculty_id', $request->{$entity})
                ->where('subject_id', $request->id)
                ->get();

            $this->secondaryId = 'faculty_id';
            $this->primaryId = 'subject_id';
        }

        return $this->getIds($lists);
    }

    /**
     * Format the ids get from DB and return it
     * 
     * @param  \Illuminate\Support\Collection $collections
     * 
     * @return array
     */
    private function getIds(Collection $collections)
    {
         $ids = [];
        foreach($collections as $collection){
            $ids[] = $collection->{$this->secondaryId};
        }
        return $ids;
    }

    /**
     * Remove assign subject prioritization
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function delete(Request $request)
    {
        
        if ($request->has('subjects')) {
            $this->primaryId = 'faculty_id';
            $this->secondaryId = 'subject_id';
            $entity = 'subjects';
        } else {
            $this->primaryId = 'subject_id';
            $this->secondaryId = 'faculty_id';
            $entity = 'faculties';
        }


        FacultyPrioritySubject::where($this->primaryId, $request->id)
                                        ->delete();  

        if ($request->has('api')) {
            return response()->json(['message' => 'Faculty load priority has been all deleted'], 200);
        }
        /*$ids = $this->getIdsFromDb(function(Builder $builder) use($request, $entity){
            $collections = $builder->where($this->primaryId, $request->id)->get();
            return $this->getIds($collections);
        });

        $collectionIds = $this->collectUniqueIdsFromArray($request, $ids, $entity);
        // @todo need to optimize this
        // it will be a bottleneck once record
        // reach more or atleast 500
        if ( count($collectionIds) > 0 ) {
            foreach($collectionIds as $id){
                FacultyPrioritySubject::where($this->primaryId, $request->id)
                                        ->where($this->secondaryId, '!=', $id)
                                        ->delete();    
            }

            if ($request->has('api')) {
                return response()->json(['message' => 'Faculty load priority has been updated'], 200);
            }
            
            return true;
        }

        // no information is process
        if ($request->has('api')) {
            return response()->json(['message' => 'No priority has been set'], 422);
        }

        return false;*/
        
    }

    /**
	 * Update faculty load
	 * 
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Illuminate\Database\Eloquent\Model $model
	 * @param  string $relation    The model's relation
     * 
	 * @return bool
     * 
     * Use this code later for generating faculty subject
     * using ant colony
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
