<?php

namespace App\View\Components\Frontend\Card;

use App\Contracts\Models\CompetitionInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Competition extends Component
{
    /**
     * Save competition data
     */
    public $competitions;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected CompetitionInterface $competitionInterface,
    ) {
        $this->competitions = $competitionInterface->all(['name', 'slug', 'level_id', 'poster', 'registration_fee'], ['level:id,display_as']);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.card.competition', $this->competitions);
    }
}
