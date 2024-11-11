<?php

namespace App\Services\Frontend;

use App\Contracts\Models;
use App\Services\Service;

class LandingService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\CompetitionInterface $competitionInterface,
        private Models\TimelineInterface $timelineInterface,
        private Models\MediaPartnerInterface $partnerInterface,
        private Models\SponsorshipInterface $sponsorInterface
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $competitions = $this->competitionInterface->get(['name', 'slug', 'level_id', 'registration_fee'], false, ['level']);
        $timelines = $this->timelineInterface->get(['title', 'description', 'date']);
        $partners = $this->partnerInterface->get(['name', 'logo']);
        $sponsors = $this->sponsorInterface->get(['name', 'logo']);

        return compact('competitions', 'timelines', 'partners', 'sponsors');
    }
}
