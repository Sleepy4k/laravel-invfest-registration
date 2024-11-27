<?php

namespace App\View\Components\Frontend\Card;

use App\Contracts\Models\MediaPartnerInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MediaPartner extends Component
{
    /**
     * Save partners data
     */
    public $partners;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected MediaPartnerInterface $mediaPartnerInterface,
    ) {
        $this->partners = $mediaPartnerInterface->all(['name', 'logo']);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.card.media-partner', $this->partners);
    }
}
