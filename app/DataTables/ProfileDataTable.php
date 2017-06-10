<?php

namespace App\DataTables;

use App\Models\Profile;
use Form;
use Yajra\Datatables\Services\DataTable;

class ProfileDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'profiles.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $profiles = Profile::query();

        return $this->applyScopes($profiles);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> Export',
                         'buttons' => [
                             'csv',
                             'excel',
                             /*'pdf',*/
                         ],
                    ],
                    'colvis'
                ]
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
            'type' => ['name' => 'type', 'data' => 'type'],
            'id_card_type' => ['name' => 'id_card_type', 'data' => 'id_card_type'],
            'id_card_number' => ['name' => 'id_card_number', 'data' => 'id_card_number'],
            'other_id_card' => ['name' => 'other_id_card', 'data' => 'other_id_card'],
            'other_id_card_number' => ['name' => 'other_id_card_number', 'data' => 'other_id_card_number'],
            'job_position' => ['name' => 'job_position', 'data' => 'job_position'],
            'address' => ['name' => 'address', 'data' => 'address'],
            'phone' => ['name' => 'phone', 'data' => 'phone'],
            'fax' => ['name' => 'fax', 'data' => 'fax']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'profiles';
    }
}
