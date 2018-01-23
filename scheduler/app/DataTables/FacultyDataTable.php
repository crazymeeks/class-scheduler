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
            ->addColumn('action', 'facultydatatable.action')
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
     * Get query source of dataTable.
     *
     * @param \Scheduler\App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Faculty $model)
    {
        //return $model->newQuery()->select('id');
        return $model->newQuery()
                     ->active()
                     ->with(['institution', 'faculty_type']);
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
            'id_number',
            'lastname',
            'firstname',
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
