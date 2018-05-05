<?php

namespace Scheduler\App\Http\Controllers\Admin\Block;

use Illuminate\Http\Request;
use Scheduler\App\Models\Block;
use Scheduler\App\Models\Level;
use Scheduler\App\Http\Controllers\Controller;
use Scheduler\App\Repositories\BlockRepository;
use Scheduler\App\Http\Requests\BlockFormRequest;
use Scheduler\App\DataTables\BlockDatableDataTable;
use Scheduler\App\Exceptions\DBTransactionException;

class BlockController extends Controller
{
    

    /**
     * Display index page
     */
    public function indexView(BlockDatableDataTable $dataTable)
    {
    	$data = [
            'breadcrumb' => 'Block Management',
            'page_title' => 'Lists',
        ];
    	return $dataTable->render($this->admin_view . 'pages.block.index', $data);
    }

    /**
     * Create new model
     * 
     */
    public function create()
    {
        $data = [
            'block'         => new Block(),
            'method'        => 'POST',
            'page_title'    => 'Block::Create',
            'url'           => url('admin/blocks/save'),
            'form_title'    => 'Create block',
            'breadcrumb'    => 'Block Management',
            'levels'        => Level::all(),
        ];
        
        return admin_view('pages.block.form', $data);
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
        
        $block = Block::find($id);

        // getting the programs of subject. as of Laravel 5.5
        // this will automatically add programs object
        // in subject model
        $block->levels;

        $data = [
            'block'         => $block,
            'method'        => 'PUT',
            'page_title'    => 'Block::Update',
            'url'           => url('admin/blocks/' . $id . '/update'),
            'form_title'    => 'Update block',
            'breadcrumb'    => 'Block Management',
            'levels'        => Level::all(),
        ];
        
        return admin_view('pages.block.form', $data);
    }

    /**
     * Save bock
     *
     * @param Scheduler\App\Http\Requests\BlockFormRequest $request
     * @param Scheduler\App\Repositories\BlockRepository $repo
     * 
     * @return  \Illuminate\Http\Response
     */
    public function save(BlockFormRequest $request, BlockRepository $repo)
    {
        
        try {

            $repo->saveFromRequest($request, new Block());

            return redirect("admin/blocks")->with('success', 'Block has been added');
            
        } catch (DBTransactionException $e) {

            return redirect("admin/blocks")->with('error', $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update block
     *
     * @param Scheduler\App\Http\Requests\BlockFormRequest $request
     * @param Scheduler\App\Repositories\BlockRepository $repo
     *
     * @return  \Illuminate\Http\Response
     * , 
     */
    public function update($id, BlockFormRequest $request, BlockRepository $repo)
    {
        try {

            $repo->saveFromRequest($request, Block::find($id));

            return redirect("admin/blocks")->with('success', 'Block has been updated');
        } catch (DBTransactionException $e) {

            return redirect("admin/blocks")->with('error', $e->getMessage(), $e->getCode());

        }
    }

    /**
     * Delete the model
     *
     * @param  int $id     The model to be deleted
     *
     * @return  \Illuminate\Http\Response
     */
    public function delete($id, BlockRepository $repo)
    {
        if ($repo->delete($id)) {
            return redirect("admin/blocks")->with('success', 'Block has been deleted');
        }
    }
}
