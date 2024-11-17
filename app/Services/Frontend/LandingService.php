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
        $competitions = $this->competitionInterface->all(['name', 'slug', 'level_id', 'poster', 'registration_fee'], ['level:id,display_as']);
        $timelines = $this->timelineInterface->all(['title', 'description', 'date'], [], [], 'date', false);
        $partners = $this->partnerInterface->all(['name', 'logo']);
        $sponsors = $this->sponsorInterface->all(['name', 'logo']);

        return compact('competitions', 'timelines', 'partners', 'sponsors');
    }
}
