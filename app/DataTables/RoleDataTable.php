<?php

namespace App\DataTables;

use App\Role;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RoleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('permission', 'roles.datatables_permissions')
            ->addColumn('action', 'roles.datatables_actions')
            ->rawColumns(['permission', 'action']);
    }
    
    /**
        * Get query source of dataTable.
        *
        * @param \App\Models\Role $model
        * @return \Illuminate\Database\Eloquent\Builder
        */
    public function query(Role $model)
    {
        return $model->newQuery();
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
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    'create',
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'name',
            'display_name',
            'description',
            'permission'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'roles_' . time();
    }
}
