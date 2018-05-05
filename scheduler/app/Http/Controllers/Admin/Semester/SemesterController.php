<?php

namespace Scheduler\App\Http\Controllers\Admin\Semester;

use Illuminate\Http\Request;
use Scheduler\App\Models\Semester;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\Repositories\SemesterRepository;
use Scheduler\App\Http\Requests\SemesterFormRequest;
use Scheduler\App\Exceptions\DBTransactionException;
class SemesterController extends Controller
{
    

    /**
     * Save new model
     *
     * @param  Scheduler\App\Http\Requests\SemesterFormRequest $request
     */
    public function save(SemesterFormRequest $request, SemesterRepository $repo)
    {
    	try {

    		$repo->saveFromRequest($request, new Semester());

    		return redirect('/admin/semesters')->with('success', 'Semester has been added');

    	} catch (DBTransactionException $e) {

    		return redirect('/admin/semesters')->with('error', $e->getMessage());
    	}
    }

    /**
     * Update the model
     *
     * @param  int $id     The model id
     * @param  Scheduler\App\Http\Requests\SemesterFormRequest $request
     *
     * @return  \Illuminate\Http\Response
     */
    public function update($id, SemesterFormRequest $request, SemesterRepository $repo)
    {
    	try {

    		$repo->saveFromRequest($request, Semester::find($id));

    		return redirect('/admin/semesters')->with('success', 'Semester has been updated');

    	} catch (DBTransactionException $e) {

    		return redirect('/admin/semesters')->with('error', $e->getMessage());
    	}

    }

    /**
     * Delete the model
     *
     * @param  int $id     The model id
     * @param  Scheduler\App\Repositories\SemesterRepository $repo
     *
     * @return  \Illuminate\Http\Response
     */
    public function delete($id, SemesterRepository $repo)
    {
    	if ( $repo->delete($id) ) {
    		
            return redirect("admin/semesters")->with('success', 'Semester has been deleted');
        }

    }
}
