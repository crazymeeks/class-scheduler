<?php

namespace Scheduler\App\DataTables;

use Scheduler\App\Models\Faculty;
use Yajra\DataTables\Services\DataTable;

class FacultyDataTable extends DataTable
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
            ->editColumn('email', function(Faculty $faculty){
                return $faculty->user->email;
            })
            ->editColumn('status', function(Faculty $faculty){
                return $faculty->status == 1 ? 'Active' : 'Inactive';
            })
            ->editColumn('institution', function(Faculty $faculty){
                return $faculty->institution->name;
            })
            ->editColumn('faculty_type', function(Faculty $faculty){
                return $faculty->faculty_type->type;
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
        $buttons = "<a href='" . url('admin/faculty/' . $query->id) . "/edit' class='btn btn-icon-only green'><i class='fa fa-edit'></i></a>";
        $buttons .= "<a data-id='" . $query->id . "' href='javascript:void;' class='btn btn-view btn-icon-only blue'><i class='fa fa-search'></i></a>";;
        $buttons .= "<a href='javascript:void;' data-id='" . $query->id . "' class='btn btn-icon-only remove-faculty red'><i class='fa fa-times'></i></a>";

        return $buttons;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Scheduler\App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Faculty $model)
    {
        //return $model->newQuery()->select('id');
        return $model->newQuery()
                     ->with(['institution', 'faculty_type', 'user']);
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
                    ->addAction(['width' => '130px'])
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
            'id',
            'lastname',
            'firstname',
            'email',
            'status',
            'institution',
            'faculty_type',

            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Faculty_' . date('YmdHis');
    }
}
