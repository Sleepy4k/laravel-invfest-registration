<?php

namespace App\DataTables\Admin;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TeamDataTable extends DataTable
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
                $detailUrl = route("admin.team.show", $query->id);
                $deleteUrl = route('admin.team.destroy', $query->id);

                $detailButton = '<a href="' . $detailUrl . '" class="btn btn-primary btn-sm me-2">Detail</a>';
                $deleteButton = '<form action="' . $deleteUrl . '" method="POST" class="d-inline">'
                    . csrf_field()
                    . method_field("DELETE")
                    . '<button class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin ingin menghapus data ini?`)">Hapus</button>'
                    . '</form>';

                return $detailButton . $deleteButton;
            })
            ->addColumn('proof', function ($query) {
                if ($query?->payment && $query?->payment?->proof) {
                    $proofUrl = asset($query->payment->proof);
                    return '<img src="' . $proofUrl . '" alt="Bukti Pembayaran" class="img-table-lightbox" width="100" loading="lazy"></img>';
                }
                return '<span>Belum Melakukan Pembayaran</span>';
            })
            ->addColumn('status', function ($query) {
                if ($query?->payment) {
                    $statusClass = $query->payment->status == 'reject' ? 'bg-danger' : ($query->payment->status == 'approve' ? 'bg-success' : 'bg-warning');
                    $statusText = $query->payment->status == 'reject' ? 'Ditolak' : ($query->payment->status == 'approve' ? 'Diterima' : 'Pending');
                    return '<span class="badge ' . $statusClass . '">' . $statusText . '</span>';
                }
                return '<span class="badge bg-warning">Pending</span>';
            })
            ->editColumn('payment.proof', function ($query) {
                return $query?->payment?->proof ?? '-';
            })
            ->editColumn('leader.name', function ($query) {
                return $query?->leader?->name ?? '-';
            })
            ->editColumn('leader.user.email', function ($query) {
                return $query?->leader?->user?->email ?? '-';
            })
            ->editColumn('leader.phone', function ($query) {
                return $query?->leader?->phone ?? '-';
            })
            ->editColumn('leader.team.member', function ($query) {
                return $query->leader && $query->leader->team && $query->leader->team->member
                    ? array_map(function($member) {
                        return $member['name'];
                    }, $query->leader->team->member->toArray())
                    : [];
            })
            ->editColumn('competition.name', function ($query) {
                return $query?->competition?->name ?? '-';
            })
            ->editColumn('competition.level.display_as', function ($query) {
                return $query?->competition?->level?->display_as ?? '-';
            })
            ->rawColumns(['action', 'proof', 'status'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Team $model): QueryBuilder
    {
        $filtered = request()->get('filter') ?? null;

        return $model
            ->select('id', 'name', 'institution', 'competition_id', 'created_at')
            ->when($filtered, function ($query) use ($filtered) {
                if (!empty($filtered)) {
                    $query->where('competition_id', $filtered);
                }
            })
            ->with([
                'competition:id,name,level_id',
                'competition.level:id,display_as',
                'payment:team_id,proof,status',
                'leader:team_id,user_id,name,phone',
                'leader.user:id,email',
                'leader.team:id',
                'leader.team.member:team_id,name'
            ])->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('team-table')
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
                ->title('Nama Tim')
                ->addClass('text-center'),
            Column::make('institution')
                ->title('Asal Instansi')
                ->addClass('text-center'),
            Column::make('leader.name')
                ->title('Nama Ketua')
                ->orderable(false)
                ->addClass('text-center'),
            Column::make('leader.user.email')
                ->title('Email Ketua')
                ->addClass('text-center')
                ->hidden(),
            Column::make('leader.phone')
                ->title('No. HP Ketua')
                ->addClass('text-center')
                ->hidden(),
            Column::computed('leader.team.member')
                ->title('Anggota')
                ->printable(false)
                ->addClass('text-center')
                ->hidden(),
            Column::make('competition.name')
                ->title('Lomba')
                ->orderable(false)
                ->addClass('text-center'),
            Column::make('competition.level.display_as')
                ->title('Tingkat')
                ->orderable(false)
                ->addClass('text-center'),
            Column::computed('proof')
                ->title('Bukti Pembayaran')
                ->exportable(false)
                ->addClass('text-center'),
            Column::computed('payment.proof')
                ->title('Bukti Pembayaran')
                ->printable(false)
                ->addClass('text-center')
                ->hidden(),
            Column::make('status')
                ->title('Status')
                ->addClass('text-center'),
            Column::computed('action')
                ->title('Action')
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
        return 'Team_' . date('YmdHis');
    }
}
