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
            })->editColumn('status', function(Faculty $faculty){
                return $faculty->status == 0 ? 'Inactive' : 'Active';
            })->editColumn('faculty_id_number', function(Faculty $faculty){
                return '<a href="' . url('admin/faculty/' . $faculty->id . '/edit') . '">' . $faculty->faculty_id_number . '</a>'; 
            })
            ->rawColumns(['faculty_id_number', 'action']);
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

        $buttons = "<a href='" . url('admin/faculty/' . $query->id) . "/edit' class='btn btn-xs green'><i class='fa fa-edit'>Edit</i></a>";
        $buttons .= "<a data-id='" . $query->id . "' href='#basic' class='btn btn-xs blue btn-view-faculty-load' data-toggle='modal'>View Load<i class='fa fa-search'></i></a>";
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
    public function query(Faculty $model)
    {
        return $model->newQuery()
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

            'faculty_id_number' => ['title' => 'ID #'],
            'lastname' => ['title' => 'Lastname'],
            'firstname' => ['firstname' => 'Firstname'],
            'email' => ['title' => 'Email'],
            'status' => ['title' => 'Status'],
            'institution.name' => ['title' => 'Institution'],
            'faculty_type.type' => ['title' => 'Faculty type'],

            
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
