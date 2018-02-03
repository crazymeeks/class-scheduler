<?php

namespace Scheduler\App\DataTables;

use Scheduler\App\Models\Program;
use Scheduler\App\Models\Institution;
use Yajra\DataTables\Services\DataTable;

class InstitutionProgramsDataTable extends DataTable
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
        $buttons = "<a href='" . url('admin/institution/program-manage-block/' . $query->id) . "' class='btn btn-sm blue'>Add Blocks</a>";

        return $buttons;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Scheduler\App\User $model
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Program $model)
    {
        $id = $this->id;

        return $model->where('institution_id', $id)->with('institution');
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
                    ->addAction(['width' => '80px'])
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
            'short_description',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'InstitutionPrograms_' . date('YmdHis');
    }
}
