<?php

namespace App\DataTables\Admin;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AuthLogDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('event', function ($query) {
                if (empty($query->event)) {
                    return '-';
                } else {
                    return $query->event;
                }
            })
            ->editColumn('causer', function ($query) {
                $data = null;
                if (empty($query->causer_id)) {
                    $data = '-';
                } else {
                    $data = $query->causer_id;
                }
                if (empty($query->causer_type)) {
                    $data .= ' | -';
                } else {
                    $data .= ' | ' . $query->causer_type;
                }

                return $data;
            })
            ->editColumn('properties', function ($query) {
                return json_encode($query->properties);
            })
            ->editColumn('created_at', function ($query) {
                return date('d F Y H:m:s', strtotime($query->created_at));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Activity $model): QueryBuilder
    {
        return $model->where('log_name', 'auth');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('authlog-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0, 'desc')
                    ->lengthChange(true)
                    ->lengthMenu()
                    ->pageLength(10)
                    ->responsive(true)
                    ->autoWidth(true)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('log_name')
                ->printable(false)
                ->exportable(false)
                ->hidden(),
            Column::make('event')
                ->title('Event')
                ->searchable(false)
                ->addClass('text-center'),
            Column::make('description')
                ->title('Description')
                ->addClass('text-center'),
            Column::computed('causer')
                ->title('Causer')
                ->searchable(false)
                ->addClass('text-center'),
            Column::make('properties')
                ->title('Properties')
                ->searchable(false)
                ->addClass('text-center'),
            Column::computed('created_at')
                ->title('Created At')
                ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AuthLog_' . date('YmdHis');
    }
}
