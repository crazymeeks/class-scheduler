<?php

namespace Scheduler\App\DataTables;

use Scheduler\App\Models\Program;
use Yajra\DataTables\Services\DataTable;

class ProgramDataTable extends DataTable
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

        $buttons = "<a href='" . url('admin/programs/' . $query->id) . "/edit' class='btn btn-sm green'><i class='fa fa-edit'>Edit</i></a>";
        //$buttons .= "<a data-id='" . $query->id . "' href='#basic' class='btn btn-sm btn-view-program-load blue' data-toggle='modal'>View Load<i class='fa fa-search'></i></a>";
        $buttons .= "<a href='javascript:void(0);' data-id='" . $query->id . "' class='btn btn-sm remove-program red'>Remove<i class='fa fa-times'></i></a>";

        return $buttons;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Scheduler\App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Program $model)
    {
        return $model->newQuery()->with('institution');
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
                    ->addAction(['width' => '180px'])
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
            'short_description' => ['title' => 'Description'],
            'institution.name' => ['title' => 'Institution'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Program_' . date('YmdHis');
    }
}
