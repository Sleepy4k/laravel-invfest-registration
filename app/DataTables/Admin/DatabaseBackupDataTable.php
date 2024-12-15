<?php

namespace App\DataTables\Admin;

use App\Facades\DbBackup;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DatabaseBackupDataTable extends DataTable
{
    /**
     * Init log file.
     *
     * @return Collection
     */
    public function customData()
    {
        return DbBackup::getFileList();
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

                return '<a href="'.route("admin.tools.database.show", $name).'" class="btn btn-info btn-sm me-2">Download</a>'
                    . '<form action="'.route('admin.tools.database.destroy', $name).'" method="POST" class="d-inline">'
                    . csrf_field() . method_field('DELETE')
                    . '<button class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin ingin menghapus data ini?`)">Hapus</button>'
                    . '</form>';
            })
            ->setRowId('id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('databasebackup-table')
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
        return 'Database_Backup_' . date('YmdHis');
    }
}
