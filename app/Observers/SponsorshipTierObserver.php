<?php

namespace App\Observers;

use App\Models\SponsorshipTier;
use Illuminate\Support\Str;

class SponsorshipTierObserver
{
    /**
     * Handle the SponsorshipTier "creating" event.
     */
    public function creating(SponsorshipTier $sponsorshipTier): void
    {
        if ($sponsorshipTier->getKey() === null) {
            $sponsorshipTier->setAttribute($sponsorshipTier->getKeyName(), Str::uuid());
        }
    }
}
