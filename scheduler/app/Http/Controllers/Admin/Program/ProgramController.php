<?php

namespace Scheduler\App\Http\Controllers\Admin\Program;

use DB;
use Closure;
use Illuminate\Http\Request;
use Scheduler\App\Models\Block;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Institution;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\DataTables\ProgramDataTable;
use Scheduler\App\Http\Controllers\Traits\Program as ProgramTrait;
class ProgramController extends Controller
{
    use ProgramTrait;


    public function __construct()
    {

    }

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

    public function create(Request $request)
    {
        $institutions = Institution::all();
        $blocks = Block::all();
        $data = [
            'breadcrumb'   => 'Program',
            'page_title'   => 'Program::create',
            'blocks'       => $blocks,
            'institutions' => $institutions,
            'url'          => url('admin/programs/save/'),
        ];

        return admin_view('pages.programs.form', $data);
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
        $program->blocks;
        $institutions = Institution::all();
        $blocks = Block::all();
        $data = [
            'breadcrumb'   => 'Program',
            'page_title'   => 'Program::update',
            'program'      => $program,
            'institutions' => $institutions,
            'blocks'       => $blocks,
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
