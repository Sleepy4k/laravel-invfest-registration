<?php

namespace App\View\Composers;

use App\Contracts\Models\SettingInterface;
use Illuminate\View\View;

class AppSettingComposer
{
    protected $settings;

    /**
     * Create a new profile composer.
     */
    public function __construct(
        protected SettingInterface $settingInterface,
    ) {
        $data = $this->defaultSettings();

        if ($settingInterface->count() > 0) {
            $rawSettings = $settingInterface->get(['key', 'value']);
            $data = array_merge($data, $this->manipulateSetting($rawSettings));
        }

        $this->settings = $data;
    }

    /**
     * Set default settings when in case we are miss config or similar
     *
     * @return array
     */
    protected function defaultSettings(): array
    {
        return [
            'title' => 'InvFest',
            'slogan' => 'InvFest',
            'heading' => 'InvFest',
            'description' => 'InvFest',
            'footer_description' => 'InvFest',
            'footer_copyrigth' => 'InvFest',
            'deadline' => '2024-11-20',
            'email' => 'invfest@gmail.com',
            'phone' => '081234567890',
            'primary_color' => '#0A3578',
            'primary_color_hover' => '#154FAA',
            'secondary_color' => '#007BFF',
            'secondary_color_hover' => '#0168D7',
            'twibbon_link' => 'https://invfest.my.id',
            'instagram' => 'https://instagram.com/invfest',
            'mascot' => null,
            'twibbon' => null,
            'nav_logo' => null,
        ];
    }

    /**
     * Manipulate settings data into array with constant format
     *
     * @param mixed $settings
     *
     * @return array
     */
    protected function manipulateSetting($settings): array
    {
        return $settings->mapWithKeys(function ($setting) {
            return [$setting->key => $setting->value];
        })->toArray();
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        return $view->with('appSettings', $this->settings);
    }
}
