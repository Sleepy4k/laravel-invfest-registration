<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Exports\Admin\DashboardExport;
use App\Foundations\Service;
use App\Models\Competition;
use App\Models\Team;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DashboardService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\TeamInterface $teamInterface,
        private Models\PaymentInterface $paymentInterface,
        private Models\MediaPartnerInterface $mediaPartnerInterface,
        private Models\SponsorshipInterface $sponsorshipInterface,
        private Models\SubmissionInterface $submissionInterface
    ) {}

    /**
     * Get the base data for the dashboard.
     *
     * @return array
     */
    private function getBaseData(): array
    {
        $totalTeam = $this->teamInterface->count();
        $totalTeamPending = count($this->paymentInterface->all(['id'], wheres: [['status', '=', 'pending']]) ?? []);
        $totalTeamReject = count($this->paymentInterface->all(['id'], wheres: [['status', '=', 'reject']]) ?? []);
        $totalTeamApprove = count($this->paymentInterface->all(['id'], wheres: [['status', '=', 'approve']]) ?? []);
        $totalTeamUnPaid = Team::doesntHave('payment')->count();
        $totalSponsorship = $this->sponsorshipInterface->count();
        $totalMediaPartner = $this->mediaPartnerInterface->count();
        $competitions = Competition::select(['id', 'name'])->withCount('team')->get();
        $totalSubmissions = $this->submissionInterface->all(['id', 'team_id']);
        $competitionChart = json_encode($competitions->map(function ($competition) {
            return [$competition?->name, $competition->team_count];
        })->toArray());

        // Validate if the total submissions team_id is duplicated
        if (count($totalSubmissions) !== count($totalSubmissions->unique('team_id'))) {
            $totalSubmissions = $totalSubmissions->unique('team_id');
        }

        // Count the total submissions
        $totalSubmissions = count($totalSubmissions);

        return compact('totalTeam', 'totalTeamPending', 'totalTeamApprove', 'totalTeamReject', 'totalTeamUnPaid', 'totalSponsorship', 'totalMediaPartner', 'competitions', 'totalSubmissions', 'competitionChart');
    }

    /**
     * Handle the incoming request.
     *
     * @return array
     */
    public function invoke(): array
    {
        $baseData = $this->getBaseData();
        $totalTeam = $baseData['totalTeam'];
        $totalTeamPending = $baseData['totalTeamPending'];
        $totalTeamReject = $baseData['totalTeamReject'];
        $totalTeamApprove = $baseData['totalTeamApprove'];
        $totalTeamUnPaid = $baseData['totalTeamUnPaid'];
        $totalSponsorship = $baseData['totalSponsorship'];
        $totalMediaPartner = $baseData['totalMediaPartner'];
        $competitions = $baseData['competitions'];
        $totalSubmissions = $baseData['totalSubmissions'];
        $competitionChart = json_encode($competitions->map(function ($competition) {
            return [$competition?->name, $competition->team_count];
        })->toArray());
        $name = Str::ucfirst(auth('web')->user()->roles?->first()?->name ?? 'Admin');

        $rawData = Team::select('id', 'competition_id', 'created_at')
                    ->with('competition:id,name')
                    ->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->get();

        $teamCharts = [];
        $daysInMonth = Carbon::now()->daysInMonth;
        $initialData = array_fill(1, $daysInMonth, 0);

        if ($rawData->isEmpty()) {
            $teamCharts[] = [
                'name' => 'No Data',
                'data' => array_values($initialData)
            ];
        } else {
            foreach ($rawData->groupBy('competition_id') as $competition_id => $items) {
                $dailyCounts = $items->groupBy(function ($item) {
                    return (int) $item->created_at->format('d');
                })->map(function ($dayItems) {
                    return count($dayItems);
                })->toArray();

                $mergedData = array_replace($initialData, $dailyCounts);

                $series = [
                    'name' => $items?->first()?->competition?->name,
                    'data' => array_values($mergedData)
                ];
                $teamCharts[] = $series;
            }
        }

        $teamCharts = json_encode($teamCharts);

        return compact('name', 'totalTeam', 'totalTeamPending', 'totalTeamApprove', 'totalTeamReject', 'totalTeamUnPaid', 'totalSponsorship', 'totalMediaPartner', 'competitions', 'competitionChart', 'totalSubmissions', 'teamCharts');
    }

    /**
     * Export the dashboard data.
     *
     * @return DashboardExport
     */
    public function export()
    {
        $baseData = $this->getBaseData();
        return new DashboardExport($baseData);
    }
}
