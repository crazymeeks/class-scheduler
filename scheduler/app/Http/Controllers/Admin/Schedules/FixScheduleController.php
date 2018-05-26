<?php

namespace Scheduler\App\Http\Controllers\Admin\Schedules;

use Illuminate\Http\Request;
use Scheduler\App\Models\Day;
use Scheduler\App\Models\Room;
use Scheduler\App\Models\Level;
use Scheduler\App\Models\Block;
use Yajra\DataTables\DataTables;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Subject;
use Scheduler\App\Models\Faculty;
use Scheduler\App\Models\Semester;
use Scheduler\App\Models\FixedClassSchedule;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\Exceptions\DBTransactionException;
use Scheduler\App\Repositories\FixedClassScheduleRepository;
use Scheduler\App\Http\Requests\FixedClassScheduleFormRequest;
class FixScheduleController extends Controller
{
    

    /**
     * Display index
     */
    public function indexView()
    {

    	$data = [
            'breadcrumb' => 'Fix Schedules',
            'page_title' => 'Lists',
        ];

        return admin_view('pages.schedules.index', $data);
    	
    }

    /**
     * Get data and display to datatable
     * 
     * @return DataTable
     */
    public function getData()
    {
    	return DataTables::of(FixedClassSchedule::with(['program', 'block', 'level', 'semester', 'subject', 'day', 'faculty', 'room']))->make(true);
    }

    /**
     * Display create form
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {

    	$data = [
            'breadcrumb' => 'Schedule Management',
            'page_title' => 'Fix Schedule::update',
            'url'        => url('/admin/fixed-class-schedule/save'),
           	'fixedSchedule' => new FixedClassSchedule(),
           	'semesters' => Semester::all(),
           	'programs' => Program::all(),
           	'levels' => Level::all(),
           	'blocks' => Block::all(),
           	'subjects' => Subject::all(),
           	'days' => Day::all(),
           	'rooms' => Room::all(),
           	'faculties' => Faculty::all(),
        ];


    	return admin_view('pages.schedules.form', $data);
    }

    /**
     * Edit existing model
     *
     * @param  int $id
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {

    	$fsched = FixedClassSchedule::find($id);
    	$fsched->semester;
    	$fsched->program;
    	$fsched->level;
    	$fsched->block;
    	$fsched->subject;
    	$fsched->day;
    	$fsched->room;
    	$fsched->faculty;

    	$data = [
            'breadcrumb' => 'Schedule Management',
            'page_title' => 'Fix Schedule::update',
            'url'        => url('/admin/fixed-class-schedule/' . $id . '/update'),
            'method'     => 'PUT',
           	'fixedSchedule' => $fsched,
           	'semesters' => Semester::all(),
           	'programs' => Program::all(),
           	'levels' => Level::all(),
           	'blocks' => Block::all(),
           	'subjects' => Subject::all(),
           	'days' => Day::all(),
           	'rooms' => Room::all(),
           	'faculties' => Faculty::all(),
        ];


    	return admin_view('pages.schedules.form', $data);


    }

    /**
     * Save new model
     *
     * @param  Scheduler\App\Http\Requests\FixedClassScheduleFormRequest $request
     * @param  Scheduler\App\Repositories\FixedClassScheduleRepository $repo
     * 
     * @return  \Illuminate\Http\Response
     *
     * @throws DBTransactionException
     */
    public function save(FixedClassScheduleFormRequest $request, FixedClassScheduleRepository $repo)
    {	

    	try {
    		$repo->saveFromRequest($request, new FixedClassSchedule());

    		 return redirect("admin/fixed-class-schedule")->with('success', 'Faculty fixed schedule has been saved.');
    	} catch (DBTransactionException $e) {
    		return redirect("admin/fixed-class-schedule")->with('error', $e->getMessage());
    	}
    }

    /**
     * Delete(soft) model
     *
     * @param  int $id
     * @param  Scheduler\App\Repositories\FixedClassScheduleRepository $repo
     *
     * @return  \Illuminate\Http\Response
     */
    public function delete($id, FixedClassScheduleRepository $repo)
    {
    	if ( $repo->delete($id) ) {
    		return redirect("admin/fixed-class-schedule")->with('success', 'Faculty fixed schedule has been deleted.');
    	}
    }

    /**
     * Update the model
     *
     * @param  int $id
     * @param  Scheduler\App\Http\Requests\FixedClassScheduleFormRequest $request
     * @param  Scheduler\App\Repositories\FixedClassScheduleRepository $repo
     *
     * @return  \Illuminate\Http\Response
     */
    public function update($id, FixedClassScheduleFormRequest $request, FixedClassScheduleRepository $repo)
    {

    	try {
    		$repo->saveFromRequest($request, FixedClassSchedule::find($id));

    		 return redirect("admin/fixed-class-schedule")->with('success', 'Faculty fixed schedule has been updated.');
    	} catch (DBTransactionException $e) {
    		return redirect("admin/fixed-class-schedule")->with('error', $e->getMessage());
    	}
    
    }
    
}
