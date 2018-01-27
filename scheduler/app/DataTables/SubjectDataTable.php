<?php

namespace Scheduler\App\DataTables;

use Scheduler\App\Models\Subject;
use Yajra\DataTables\Services\DataTable;

class SubjectDataTable extends DataTable
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
        $buttons = "<a href='" . url('admin/subject/' . $query->id) . "/edit' class='btn btn-icon-only green'><i class='fa fa-edit'></i></a>";
        $buttons .= "<a data-id='" . $query->id . "' href='#basic' class='btn btn-view-subject-programs btn-icon-only blue' data-toggle='modal'><i class='fa fa-search'></i></a>";
        $buttons .= "<a href='#' data-id='" . $query->id . "' class='btn btn-icon-only remove-subject red'><i class='fa fa-times'></i></a>";

        return $buttons;

        
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Scheduler\App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subject $model)
    {
        return $model->newQuery()->with(['programs']);
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
                    ->addAction(['width' => '120px'])
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
            'name',
            'units',
            'hours',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Subject_' . date('YmdHis');
    }
}
