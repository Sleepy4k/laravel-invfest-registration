<?php

namespace App\DataTables\Admin;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubmissionDataTable extends DataTable
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
                if ($query->is_reviewed) {
                    return '<span>-</span>';
                }

                $updateUrl = route('admin.work.update', $query->id);
                return '<form action="'.$updateUrl.'" method="POST">'
                    . csrf_field()
                    . method_field("PUT")
                    . '<input type="hidden" name="is_reviewed" value="1">'
                    . '<button class="btn btn-sm btn-success" type="submit">'
                    . '<i data-feather="check"></i>Tandai Sudah Direview</button></form>';
            })
            ->addColumn('file_karya', function ($query) {
                $url = $query->file ?? "#";
                return '<a href="'.$url.'" target="_blank" class="btn btn-sm btn-primary">'
                    . '<i data-feather="download"></i>Download Karya</a>';
            })
            ->addColumn('is_reviewed', function ($query) {
                $class = $query->is_reviewed ? 'bg-success' : 'bg-warning';
                $status = $query->is_reviewed ? 'Sudah Direview' : 'Belum Direview';
                return '<span class="badge ' . $class . '">' . $status . '</span>';
            })
            ->rawColumns(['action', 'file_karya', 'is_reviewed'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Submission $model): QueryBuilder
    {
        $filtered = request()->get('filter') ?? null;

        return $model
            ->select('id', 'team_id', 'title', 'file', 'is_reviewed', 'created_at')
            ->when($filtered, function ($query) use ($filtered) {
                if (!empty($filtered)) {
                    $query->where(function ($model) use ($filtered) {
                        $model->whereHas('team', function($q) use ($filtered) {
                            $q->where('competition_id', $filtered);
                        });
                    });
                }
            })
            ->with([
                'team:id,competition_id,name,institution',
                'team.competition:id,name'
            ]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('submission-table')
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
            Column::make('team.name')
                ->title('Nama Tim')
                ->orderable(false)
                ->addClass('text-center'),
            Column::make('team.institution')
                ->title('Asal Instansi')
                ->orderable(false)
                ->addClass('text-center'),
            Column::make('team.competition.name')
                ->title('Lomba')
                ->orderable(false)
                ->addClass('text-center'),
            Column::make('title')
                ->title('Nama Karya')
                ->addClass('text-center'),
            Column::computed('file_karya')
                ->title('Karya')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
            Column::computed('file')
                ->title('Link Karya')
                ->printable(false)
                ->addClass('text-center')
                ->hidden(),
            Column::make('is_reviewed')
                ->title('Status')
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
        return 'Karya_' . date('YmdHis');
    }
}
