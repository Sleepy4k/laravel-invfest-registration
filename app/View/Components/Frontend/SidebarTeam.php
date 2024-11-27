<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarTeam extends Component
{
    /**
     * Save payment status
     */
    public bool $paymentStatus;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->paymentStatus = auth('web')->user()?->leader?->team?->payment?->status === 'approve';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.sidebar-team', [
            'paymentStatus' => $this->paymentStatus
        ]);
    }
}
