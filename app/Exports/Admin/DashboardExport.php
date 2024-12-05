<?php

namespace App\Exports\Admin;

use App\Foundations\Export;
use Maatwebsite\Excel\Concerns\FromCollection;

class DashboardExport extends Export implements FromCollection
{
    /**
     * Data to be exported
     *
     * @var array
     */
    private array $data;

    /**
     * Headings for the sheet
     *
     * @var array
     */
    protected array $headings = [
        'Title',
        'Data',
    ];

    /**
     * Model contract constructor.
     */
    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * Get total team each competition
     *
     * @param $competitions
     * 
     * @return \Illuminate\Support\Collection
     */
    private function getTotalTeamEachCompetition($competitions)
    {
        return $competitions->map(function ($competition) {
            return [
                'Title' => 'Total Team Pada Kategori '.$competition->name,
                'Data' => $competition->team_count ?? 0,
            ];
        });
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $totalTeam = $this->data['totalTeam'];
        $totalTeamPending = $this->data['totalTeamPending'];
        $totalTeamReject = ($this->data['totalTeamReject']);
        $totalTeamApprove = $this->data['totalTeamApprove'];
        $totalTeamUnPaid = $this->data['totalTeamUnPaid'];
        $totalSponsorship = $this->data['totalSponsorship'];
        $totalMediaPartner = $this->data['totalMediaPartner'];
        $competitions = $this->data['competitions']->count();
        $totalTeamEachCompetition = $this->getTotalTeamEachCompetition($this->data['competitions']);

        return collect(array_merge([
            ['Title' => 'Jumlah Pendaftar', 'Data' => $totalTeam],
            ['Title' => 'Total Sponsor', 'Data' => $totalSponsorship],
            ['Title' => 'Total Media Partner', 'Data' => $totalMediaPartner],
            ['Title' => 'Tim Belum Di Approve', 'Data' => $totalTeamPending],
            ['Title' => 'Tim Sudah Di Approve', 'Data' => $totalTeamApprove],
            ['Title' => 'Tim Yang Di Tolak', 'Data' => $totalTeamReject],
            ['Title' => 'Tim Yang Belum Melakukan Pembayaran', 'Data' => $totalTeamUnPaid],
            ['Title' => 'Total Kompetisi', 'Data' => $competitions],
        ], $totalTeamEachCompetition->toArray()));
    }
}
