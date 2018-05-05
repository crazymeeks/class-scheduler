<?php

namespace Scheduler\App\DataTables;

use Scheduler\App\Models\Block;
use Yajra\DataTables\Services\DataTable;

class BlockDatableDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function($query){
                return $this->dataTableActionButtons($query);
            })
            ->addColumn('levels', function(Block $block){
                return $block->levels->map(function($level){
                    return $level->level;
                })->implode(',');
            });
    }


    /**
     * Datatable Action buttons
     *
     * @param mixed $query Results from query() method.
     * 
     * @return string
     */
    protected function dataTableActionButtons($query)
    {

        $buttons = "<a href='" . url('admin/blocks/' . $query->id) . "/edit' class='btn btn-xs green'><i class='fa fa-edit'>Edit</i></a>";
        
        // $buttons .= "<a href='" . url('admin/faculty/' . $query->id) . "/load' class='btn btn-xs green faculty-assign-load'>Assign Load<i class='fa fa-plus'></i></a>";

        $buttons .= "<a href='#' data-id='" . $query->id . "' class='btn btn-xs red remove-faculty'>Remove<i class='fa fa-times'></i></a>";

        return $buttons;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Scheduler\App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Block $model)
    {
        return $model->newQuery()
                     ->with(['levels']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '220px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'code',
            'levels',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BlockDatable_' . date('YmdHis');
    }
}
