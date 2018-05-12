<?php

namespace Scheduler\App\Http\Controllers\Admin\Semester;

use Illuminate\Http\Request;
use Scheduler\App\Models\Level;
use Scheduler\App\Models\Block;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Semester;
use Scheduler\App\Models\ClassSize;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\Repositories\ClassSizeRepository;
use Scheduler\App\Http\Requests\ClassSizeFormRequest;
use Scheduler\App\Exceptions\DBTransactionException;

class ClassSizeController extends Controller
{

	/**
	 * Display create from
	 * 
	 */
	public function create()
	{
		$data = [
            'breadcrumb' => 'Class size Management',
            'page_title' => 'Class size::create',
            'url'        => url('/admin/class-size/'),
            'programs'   => Program::all(),
            'blocks'     => Block::all(),
            'semesters'  => Semester::all(),
            'levels'     => Level::all(),
            'classSize'  => new ClassSize(),
        ];

        return admin_view('pages.semester.class-size.form', $data);
	}

	/**
	 * Edit model
	 *
	 * @param int $id
	 *
	 * @return  \Illuminate\Http\Response
	 */
	public function edit($id)
	{

		$classSize = ClassSize::find($id);
		$classSize->program;
		$data = [
            'breadcrumb' => 'Class size Management',
            'page_title' => 'Class size::create',
            'url'        => url('/admin/class-size/'),
            'programs'   => Program::all(),
            'blocks'     => Block::all(),
            'semesters'  => Semester::all(),
            'levels'     => Level::all(),
            'classSize'  => $classSize,
        ];
        return $data;
		return admin_view('pages.semester.class-size.form', $data);
	}
    
	/**
	 * Save new model
	 * 
	 * @param  ClassSizeFormRequest $request
	 * @param  ClassSizeRepository  $repo
	 * 
	 * @return \Illuminate\Http\Response
	 */
    public function save(ClassSizeFormRequest $request, ClassSizeRepository $repo)
    {

    	try {
    		$repo->saveFromRequest($request, new ClassSize());

    		return redirect('/admin/class-size')->with('success', 'Class size has been added');

    	} catch (DBTransactionException $e) {

    		return redirect('/admin/class-size')->with('error', $e->getMessage());
    	}

    }

    /**
     * Update the model
     *
     * @param  int $id
     * @param  ClassSizeFormRequest $request
     * @param  ClassSizeRepository $repo
     *
     * @return  \Illuminate\Http\Response
     */
    public function update($id, ClassSizeFormRequest $request, ClassSizeRepository $repo)
    {
    	try {
    		$repo->saveFromRequest($request, ClassSize::find($id));
    		return redirect('/admin/class-size')->with('success', 'Class size has been updated');
    	} catch (DBTransactionException $e) {
    		return redirect('/admin/class-size')->with('error', $e->getMessage());
    	}
    }

    /**
     * Delete the given model
     *
     * @param  int $id
     * @param  ClassSizeRepository $repo
     * 
     * @return  \Illuminate\Http\Response
     */
    public function delete($id, ClassSizeRepository $repo)
    {
    	$repo->delete($id);

    	return redirect('/admin/class-size')->with('success', 'Class size has been deleted');
    }
}
