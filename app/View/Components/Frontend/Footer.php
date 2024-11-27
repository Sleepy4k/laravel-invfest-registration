<?php

namespace App\View\Components\Frontend;

use App\Contracts\Models\CompetitionInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Save latest competition data
     */
    public $latestCompetition;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected CompetitionInterface $competitionInterface,
    ) {
        $this->latestCompetition = $competitionInterface->getWithLimit(['name', 'slug'], 3);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.footer', $this->latestCompetition);
    }
}
