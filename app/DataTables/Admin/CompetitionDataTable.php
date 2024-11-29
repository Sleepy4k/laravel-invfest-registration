<?php

namespace App\DataTables\Admin;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompetitionDataTable extends DataTable
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
                return '<a href="'.route('admin.competition.edit', $query->id).'" class="btn btn-warning btn-sm me-2">Edit</a>'
                    . '<a href="'.route('admin.competition.show', $query->id).'" class="btn btn-info btn-sm me-2">Detail</a>'
                    . '<form action="'.route('admin.competition.destroy', $query->id).'" method="POST" class="d-inline">'
                    . csrf_field() . method_field('DELETE')
                    . '<button class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin ingin menghapus data ini?`)">Hapus</button>'
                    . '</form>';
            })
            ->editColumn('poster', function ($query) {
                if (is_null($query->poster)) {
                    return '<span>-</span>';
                }

                return '<a href="'.$query->poster.'" class="d-block" data-lightbox="poster" data-title="'.$query->name.'">'
                    . '<img src="'.$query->poster.'" alt="'.$query->name.'" class="img-table-lightbox" loading="lazy" height="150" />'
                    . '</a>';
            })
            ->editColumn('btn_guidebook', function ($query) {
                if (is_null($query->guidebook)) {
                    return '<span>-</span>';
                }

                return '<a href="'.$query->guidebook.'" class="btn btn-primary btn-sm">Lihat</a>';
            })
            ->editColumn('btn_whatsapp_group', function ($query) {
                if (is_null($query->whatsapp_group)) {
                    return '<span>-</span>';
                }

                return '<a href="'.$query->whatsapp_group.'" class="btn btn-primary btn-sm">Lihat</a>';
            })
            ->editColumn('registration_fee', function ($query) {
                return $query->registration_fee_rupiah;
            })
            ->rawColumns(['action', 'poster', 'btn_guidebook', 'btn_whatsapp_group'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Competition $model): QueryBuilder
    {
        return $model
            ->select('id', 'level_id', 'name', 'poster', 'guidebook', 'whatsapp_group', 'registration_fee', 'created_at')
            ->with('level:id,display_as');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('competition-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0, 'asc')
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
                ->title('Nama Kompetisi')
                ->addClass('text-center'),
            Column::make('level.display_as')
                ->title('Tingkat Kompetisi')
                ->addClass('text-center'),
            Column::computed('poster')
                ->exportable(false)
                ->title('Poster')
                ->addClass('text-center'),
            Column::computed('btn_guidebook')
                ->printable(false)
                ->exportable(false)
                ->title('Guide Book')
                ->addClass('text-center'),
            Column::computed('guidebook')
                ->title('Guide Book')
                ->addClass('text-center')
                ->hidden(),
            Column::computed('btn_whatsapp_group')
                ->printable(false)
                ->exportable(false)
                ->title('Group Whatsapp')
                ->addClass('text-center'),
            Column::computed('whatsapp_group')
                ->title('Group Whatsapp')
                ->addClass('text-center')
                ->hidden(),
            Column::make('registration_fee')
                ->title('Biaya Pendaftaran')
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
        return 'Kompetisi_' . date('YmdHis');
    }
}
