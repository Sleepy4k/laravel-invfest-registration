<?php

namespace App\DataTables\Admin;

use App\Enums\LogReaderType;
use App\Facades\LogReader;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SystemLogDataTable extends DataTable
{
    /**
     * Init log file.
     *
     * @return Collection
     */
    public function customData()
    {
        return LogReader::getFileList(LogReaderType::DAILY);
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable()
    {
        return datatables()
            ->of($this->customData())
            ->addColumn('action', function ($query) {
                $name = explode('.', $query['name'])[0];

                return '<a href="'.route("admin.system.show", $name).'" class="btn btn-success">Detail</a>';
            })
            ->setRowId('id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->serverSide(false)
                    ->setTableId('systemlog-table')
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
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')
                ->title('Nama')
                ->addClass('text-center'),
            Column::make('size')
                ->title('Ukuran')
                ->addClass('text-center'),
            Column::make('type')
                ->title('Jenis')
                ->addClass('text-center'),
            Column::make('content')
                ->title('Konten')
                ->addClass('text-center'),
            Column::make('last_updated')
                ->title('Terakhir Diperbarui')
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
        return 'SystemLog_' . date('YmdHis');
    }
}
