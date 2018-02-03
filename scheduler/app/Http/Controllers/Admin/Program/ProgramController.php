<?php

namespace Scheduler\App\Http\Controllers\Admin\Program;

use DB;
use Closure;
use Illuminate\Http\Request;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Institution;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\DataTables\ProgramDataTable;
use Scheduler\App\Http\Controllers\Traits\Program as ProgramTrait;
class ProgramController extends Controller
{
    use ProgramTrait;


    /**
     * Display list of programs
     *
     * @param  Scheduler\App\DataTables\ProgramDataTable
     * 
     * @return \Illuminate\Http\Response
     */
    public function indexView(ProgramDataTable $dataTable)
    {
        $data = [
            'breadcrumb' => 'Program Management',
            'page_title' => 'Lists of programs',
        ];
        return $dataTable->render($this->admin_view . 'pages.programs.index', $data);
    }

    /**
     * Edit Program
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $program = Program::find($id);
        $institutions = Institution::all();
        $data = [
            'page_title'   => 'Program::Create',
            'program'      => $program,
            'institutions' => $institutions,
            'url'          => url('admin/programs/save/' . $id),
        ];

        return admin_view('pages.programs.form', $data);
    }


    /**
     * Soft delete the given model
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return  \Illuminate\Http\Response
     */
    public function delete(Request $request, Program $subject, $id)
    {
        if ($subject->find($id)->delete()) {
            
            return response()->json(['message' => 'Program deleted'], 200);
        }

        return response()->json(['message' => 'Error deleting of program'], 500);
    }
}
