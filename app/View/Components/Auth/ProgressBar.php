<?php

namespace App\View\Components\Auth;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProgressBar extends Component
{
    public int $progress;
    public array $activeList;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->activeList = [
            'register' => false,
            'email/verify' => false,
            'team-members' => false,
            'payment-team' => false,
        ];

        $steps = [
            'register' => 15,
            'email/verify' => 50,
            'team-members' => 85,
            'payment-team' => 100,
        ];

        $this->progress = $steps[request()->path()] ?? 0;

        foreach ($this->activeList as $key => &$value) {
            if (!isset($steps[$key])) continue;

            $value = $this->progress >= $steps[$key];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth.progress-bar', [
            'progress' => $this->progress,
            'activeList' => $this->activeList,
        ]);
    }
}
