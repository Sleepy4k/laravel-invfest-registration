<?php

namespace App\DataTables\Admin;

use App\Models\MediaPartner;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MediaPartnerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<a href="'.route('admin.media-partner.edit', $query->id).'" class="btn btn-warning btn-sm me-2">Edit</a>'
                    . '<form action="'.route('admin.media-partner.destroy', $query->id).'" method="POST" class="d-inline">'
                    . csrf_field() . method_field("DELETE")
                    . '<button class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin ingin menghapus data ini?`)">Hapus</button>'
                    . '</form>';
            })
            ->editColumn('logo', function ($query) {
                return '<a href="'.asset($query->logo ?? '#').'" data-lightbox="sponsor" data-title="'.$query->name.'">'
                    . '<img src="'.asset($query->logo ?? '#').'" alt="'.$query->name.'" class="img-table-lightbox" loading="lazy" height="150" />'
                    . '</a>';
            })
            ->addColumn('link_logo', function ($query) {
                return $query->logo;
            })
            ->rawColumns(['action', 'logo'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(MediaPartner $model): QueryBuilder
    {
        return $model
            ->select('id', 'name', 'logo', 'link', 'created_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('mediapartner-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0, 'desc')
                    ->lengthChange(true)
                    ->autoFill(true)
                    ->pageLength(10)
                    ->autoWidth(true)
                    ->responsive(true)
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
            Column::make('created_at')
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->hidden(),
            Column::computed('DT_RowIndex')
                ->title('No')
                ->addClass('text-center'),
            Column::make('name')
                ->title('Nama Tim')
                ->addClass('text-center'),
            Column::computed('logo')
                ->exportable(false)
                ->title('Logo')
                ->addClass('text-center'),
            Column::computed('link_logo')
                ->printable(false)
                ->title('Link Logo')
                ->addClass('text-center')
                ->hidden(),
            Column::make('link')
                ->title('Link Media Partner')
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
        return 'Media_Partner_' . date('YmdHis');
    }
}
