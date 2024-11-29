<?php

namespace App\DataTables\Admin;

use App\Models\Timeline;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TimelineDataTable extends DataTable
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
                return '<a href="'.route('admin.timeline.edit', $query->id).'" class="btn btn-warning btn-sm me-2">Edit</a>'
                    . '<a href="'.route('admin.timeline.show', $query->id).'" class="btn btn-info btn-sm me-2">Detail</a>'
                    . '<form action="'.route('admin.timeline.destroy', $query->id).'" method="POST" class="d-inline">'
                    . csrf_field() . method_field('DELETE')
                    . '<button class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin ingin menghapus data ini?`)">Hapus</button>'
                    . '</form>';
            })
            ->editColumn('description', function ($query) {
                $text = $query->description;
                return strlen($text) > 75 ? substr($text, 0, 72) . '...' : $text;;
            })
            ->editColumn('date', function ($query) {
                return date('d F Y', strtotime($query->date));
            })
            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Timeline $model): QueryBuilder
    {
        return $model
            ->select('id', 'title', 'date', 'description');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('timeline-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(2, 'desc')
                    ->lengthChange(true)
                    ->autoFill(true)
                    ->pageLength(10)
                    ->autoWidth(true)
                    ->responsive(true)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
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
            Column::computed('DT_RowIndex')
                ->title('No')
                ->addClass('text-center'),
            Column::make('title')
                ->title('Nama Schedule')
                ->addClass('text-center'),
            Column::make('date')
                ->title('Tanggal')
                ->addClass('text-center'),
            Column::make('description')
                ->title('Deskripsi')
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
        return 'Timeline_' . date('YmdHis');
    }
}
