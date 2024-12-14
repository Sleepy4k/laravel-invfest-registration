<?php

namespace App\View\Components\Frontend\Card;

use App\Contracts\Models\SponsorshipTierInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sponsor extends Component
{
    /**
     * Save sponsors data
     */
    public $sponsorsTiers;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected SponsorshipTierInterface $sponsorshipTierInterface
    ) {
        $this->sponsorsTiers = $sponsorshipTierInterface->all(['id', 'tier'], ['sponsorships:id,tier_id,name,logo']);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.card.sponsor', $this->sponsorsTiers);
    }
}
