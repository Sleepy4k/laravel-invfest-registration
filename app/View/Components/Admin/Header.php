<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Save profile picture url
     */
    public string $profilePicture;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->profilePicture = 'https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.header', [
            'profilePicture' => $this->profilePicture
        ]);
    }
}
