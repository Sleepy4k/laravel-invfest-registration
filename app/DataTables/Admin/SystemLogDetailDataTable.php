<?php

namespace App\DataTables\Admin;

use App\Facades\Format;
use App\Facades\LogReader;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SystemLogDetailDataTable extends DataTable
{
    /**
     * Init log file.
     *
     * @return Collection
     */
    public function customData()
    {
        $name = basename(request()->path());

        return LogReader::getFileContent($name);
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
            ->editColumn('timestamp', function ($query) {
                return Format::formatDate($query['timestamp'], 'd F Y H:m:s');
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
                    ->setTableId('systemlogdetail-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0, 'desc')
                    ->lengthChange(true)
                    ->lengthMenu()
                    ->pageLength(10)
                    ->responsive(true)
                    ->autoWidth(true)
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
            Column::make('env')
                ->title('Env')
                ->addClass('text-center'),
            Column::make('type')
                ->title('Jenis')
                ->addClass('text-center'),
            Column::make('timestamp')
                ->title('Stempel waktu')
                ->addClass('text-center'),
            Column::make('message')
                ->title('Pesan'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SystemLogDetail_' . date('YmdHis');
    }
}
