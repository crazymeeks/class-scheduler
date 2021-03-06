<?php

namespace Scheduler\App\DataTables;

use Scheduler\App\Models\Institution;
use Yajra\DataTables\Services\DataTable;

class InstitutionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * 
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
        /*$buttons = "<a href='" . url('admin/institution/' . $query->id) . "/edit' class='btn btn-icon-only green'><i class='fa fa-edit'></i></a>";
        $buttons .= "<a href='" . url('admin/institution/' . $query->id) . "/view-program' class='btn btn-icon-only blue'><i class='fa fa-search'></i></a>";
        $buttons .= "<a href='javascript:void;' data-id='" . $query->id . "' class='btn btn-icon-only remove-institute red'><i class='fa fa-times'></i></a>";*/

        $buttons = "<a href='" . url('admin/institution/' . $query->id) . "/edit' class='btn btn-sm green'><i class='fa fa-edit'>Edit</i></a>";

        $buttons .= "<a href='" . url('admin/institution/' . $query->id) . "/view-program' class='btn btn-sm blue'>View Programs<i class='fa fa-search'></i></a>";

        $buttons .= "<a href='#' data-id='" . $query->id . "' class='btn btn-sm remove-institute red'>Remove<i class='fa fa-times'></i></a>";

        return $buttons;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Scheduler\App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Institution $model)
    {
        return $model->newQuery()->select('id', 'name', 'created_at', 'updated_at');
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
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Institution_' . date('YmdHis');
    }
}
