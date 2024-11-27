<?php

namespace App\View\Components\Frontend\Card;

use App\Contracts\Models\SponsorshipInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sponsor extends Component
{
    /**
     * Save sponsors data
     */
    public $sponsors;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected SponsorshipInterface $sponsorshipInterface,
    ) {
        $this->sponsors = $sponsorshipInterface->all(['name', 'logo']);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.card.sponsor', $this->sponsors);
    }
}
