<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends DataTable
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
            ->addColumn('role', 'users.datatables_roles')
            ->addColumn('action', 'users.datatables_actions')
            ->rawColumns(['role', 'action']);
    }
    
    /**
        * Get query source of dataTable.
        *
        * @param \App\User $model
        * @return \Illuminate\Database\Eloquent\Builder
        */
    public function query(User $model)
    {
        return $model::with('role');
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
            'email',
            'role'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'users_' . time();
    }
}
