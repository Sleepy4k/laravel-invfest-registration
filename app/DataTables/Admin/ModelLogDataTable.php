<?php

namespace App\DataTables\Admin;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ModelLogDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('action', function ($query) {
                return '<a href="'.route('admin.model.show', $query->id).'" class="btn btn-info btn-sm me-2">Detail</a>';
            })
            ->editColumn('event', function ($query) {
                return empty($query->event) ? '-' : $query->event;
            })
            ->editColumn('subject', function ($query) {
                $subjectId = $query->subject_id ?? '-';
                $subjectType = $query->subject_type ?? '-';

                return $subjectId." | ".$subjectType;

            })
            ->editColumn('causer', function ($query) {
                $causerId = $query->causer_id ?? '-';
                $causerType = $query->causer_type ?? '-';

                return $causerId." | ".$causerType;

            })
            ->editColumn('properties', function ($query) {
                $json = $query->properties->toJson();
                $trimmedJson = substr($json, 0, 37) . '...';

                return $trimmedJson;
            })
            ->editColumn('print_properties', function ($query) {
                return $query->properties->toJson();
            })
            ->editColumn('created_at', function ($query) {
                return date('d F Y H:m:s', strtotime($query->created_at));
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Activity $model): QueryBuilder
    {
        return $model->where('log_name', 'model');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('modellog-table')
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
            Column::computed('subject')
                ->title('Subject')
                ->searchable(false)
                ->addClass('text-center'),
            Column::computed('causer')
                ->title('Causer')
                ->searchable(false)
                ->addClass('text-center'),
            Column::make('properties')
                ->title('Properties')
                ->printable(false)
                ->exportable(false)
                ->searchable(false)
                ->addClass('text-center'),
            Column::computed('print_properties')
                ->title('Properti')
                ->addClass('text-center')
                ->hidden(),
            Column::computed('created_at')
                ->title('Created At')
                ->addClass('text-center'),
            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Log_Model_' . date('YmdHis');
    }
}
