<?php

namespace App\View\Composers;

use App\Contracts\Models\CompetitionInterface;
use Illuminate\View\View;

class LatestCompetitionComposer
{
    protected $competitions;

    /**
     * Create a new profile composer.
     */
    public function __construct(
        protected CompetitionInterface $competitionInterface,
    ) {
        $this->competitions = $competitionInterface->getWithLimit(['name', 'slug'], 3);
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        return $view->with('latestCompetition', $this->competitions);
    }
}
