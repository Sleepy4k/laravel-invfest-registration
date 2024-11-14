<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Models\Competition;
use App\Services\Service;
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
    ) {}

    /**
     * Handle the incoming request.
     *
     * @return array
     */
    public function invoke(): array
    {
        $name = Str::ucfirst(auth('web')->user()->roles?->first()->name ?? 'Admin');
        $totalTeam = $this->teamInterface->count();
        $totalTeamPending = count($this->paymentInterface->all(['id'], [], [['status', '=', 'pending']]) ?? []);
        $totalSponsorship = $this->sponsorshipInterface->count();
        $totalMediaPartner = $this->mediaPartnerInterface->count();
        $competitions = Competition::select(['id', 'name'])->withCount(['team' => function ($query) {
            $query->where('status', 'accepted');
        }]);

        return compact('name', 'totalTeam', 'totalTeamPending', 'totalSponsorship', 'totalMediaPartner', 'competitions');
    }
}
