<?php

namespace App\View\Components\Frontend;

use App\Contracts\Models\TimelineInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Timeline extends Component
{
    /**
     * Save latest competition data
     */
    public $timelines;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected TimelineInterface $timelineInterface,
    ) {
        $this->timelines = $timelineInterface->all(['title', 'description', 'date'], [], [], 'date', false);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.timeline', $this->timelines);
    }
}
