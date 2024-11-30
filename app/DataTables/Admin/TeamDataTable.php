<?php

namespace App\DataTables\Admin;

use App\Models\Setting;
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
     * Convert a phone number to ensure it starts with '62'.
     *
     * @param string $number The phone number to be converted.
     *
     * @return string The converted phone number starting with '62' and whatsapp api format.
     */
    private function convertTeamNumber(string $number) {
        $number = preg_replace('/^\D+/', '', $number);

        if (strpos($number, '0') === 0) {
            $number = '62' . substr($number, 1);
        } elseif (strpos($number, '62') !== 0) {
            $number = '62' . $number;
        }

        return 'https://wa.me/'.$number;
    }

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

                $followUpButton = '';
                $detailButton = '<a href="' . $detailUrl . '" class="btn btn-primary btn-sm me-2">Detail</a>';
                $deleteButton = '<form action="' . $deleteUrl . '" method="POST" class="d-inline">'
                    . csrf_field()
                    . method_field("DELETE")
                    . '<button class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin ingin menghapus data ini?`)">Hapus</button>'
                    . '</form>';

                if (is_null($query?->payment) || $query->payment->status == 'pending') {
                    $lnBreak = urlencode("\n");
                    $settings = Setting::whereIn('key', ['phone', 'title'])->pluck('value', 'key');
                    $phoneNumber = $settings['phone'] ?? 'xxxx';
                    $appTitle = $settings['title'] ?? config('app.name');
                    $userName = auth('web')->user()?->roles?->first()?->name ?? 'admin';
                    $reason = $query->payment ? 'melakukan crosscheck pembayaran' : 'melakukan pembayaran';

                    $followUpButton = '<span class="btn btn-warning btn-sm me-2">'
                        . '<a href="https://api.whatsapp.com/send?phone='.$phoneNumber
                        . '&text=Halo!'.$lnBreak.'Sebelumnya saya '.$userName.' dari Web '.$appTitle
                        . ' '.$lnBreak.'Apakah boleh meminta tolong untuk follow up Team '.($query?->name ?? '####')
                        . ' pada lomba '.$query?->competition?->name.' untuk '.$reason.'?'.$lnBreak
                        . 'Jika boleh, kontak ketua team pada nomor berikut '.$this->convertTeamNumber($query->leader->phone ?? 'xxxx')
                        . $lnBreak.'Terima Kasih Banyak!!!" target="_blank" rel="noopener" class="nav-link">'
                        . 'Follow Up</a></span>';
                }

                return $followUpButton . $detailButton . $deleteButton;
            })
            ->addColumn('proof', function ($query) {
                if (is_null($query?->payment) || is_null($query?->payment?->proof)) {
                    return '<span>Belum Melakukan Pembayaran</span>';
                }

                $proofUrl = asset($query->payment->proof);
                return '<img src="' . $proofUrl . '" alt="Bukti Pembayaran" class="img-table-lightbox" width="100" loading="lazy"></img>';
            })
            ->addColumn('status', function ($query) {
                if (is_null($query?->payment)) {
                    return '<span class="badge bg-warning">Pending</span>';
                }

                $statusData = match ($query->payment->status) {
                    'reject' => ['class' => 'bg-danger', 'text' => 'Ditolak'],
                    'approve' => ['class' => 'bg-success', 'text' => 'Diterima'],
                    default => ['class' => 'bg-warning', 'text' => 'Pending'],
                };

                return '<span class="badge ' . $statusData['class'] . '">' . $statusData['text'] . '</span>';
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
        $paymentStatus = request()->get('status') ?? null;

        return $model
            ->select('id', 'name', 'institution', 'competition_id', 'created_at')
            ->when($filtered, function ($query) use ($filtered) {
                if (!empty($filtered)) {
                    $query->where('competition_id', $filtered);
                }
            })
            ->when($paymentStatus, function ($query) use ($paymentStatus) {
                if (!empty($paymentStatus)) {
                    $query->where(function ($model) use ($paymentStatus) {
                        $model->whereHas('payment', function($q) use ($paymentStatus) {
                            $q->where('status', $paymentStatus == 'paid' ? 'approve' : 'pending');
                        });
                    });
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
            ]);
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
        return 'Team_' . date('YmdHis');
    }
}
