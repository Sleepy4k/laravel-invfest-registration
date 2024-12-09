<?php

namespace App\View\Composers;

use App\Contracts\Models\SettingInterface;
use Illuminate\View\View;

class AppSettingComposer
{
    /**
     * The settings data.
     *
     * @var array
     */
    protected array $settings;

    /**
     * Create a new profile composer.
     */
    public function __construct(
        protected SettingInterface $settingInterface
    ) {
        if (!empty($this->settings)) return;

        $data = $this->defaultSettings();

        if ($settingInterface->count() > 0) {
            $rawSettings = $settingInterface->get(['key', 'value']);
            $data = array_merge($data, $this->manipulateSetting($rawSettings));
        }

        $this->settings = $data;
    }

    /**
     * Set default settings in case of missing configuration or similar issues
     *
     * @return array
     */
    protected function defaultSettings(): array
    {
        $logo = asset('images/logo.png');

        return [
            'title' => 'INVFEST X ISF 9.0',
            'slogan' => 'Spark the Vision, Light the World',
            'heading' => 'Time to Shine: Spark the Vision, Light the World, panggilan buat kamu yang siap tampil all-out! Saatnya menunjukkan inovasi yang bisa menginspirasi dan membawa perubahan nyata. Ini waktunya kamu bersinar dengan ide segar yang bisa menginspirasi dan mengubah dunia',
            'description' => 'INVFEST X ISF 9.0 ini merupakan gabungan keren antara Informatics Innovation Festival (INVFEST) dan Informatics Sport Festival (ISF)! Acara tahunan ini adalah kompetisi teknologi nasional yang digelar oleh Himpunan Mahasiswa Teknik Informatika, tempat kamu bisa berkreasi dan bersaing di bidang teknologi, e-sports, dan olahraga. INVFEST X ISF 9.0 memiliki tema Time to Shine: Spark the Vision, Light the World, panggilan buat kamu yang siap tampil all-out! Saatnya menunjukkan inovasi yang bisa menginspirasi dan membawa perubahan nyata. Ini waktunya kamu bersinar dengan ide segar yang bisa menginspirasi dan mengubah dunia',
            'deadline' => '2024-11-30T14:47',
            'phone' => '6281234567890',
            'primary_color' => '#2e2d2d',
            'primary_color_hover' => '#eeba2b',
            'secondary_color' => '#eeba2b',
            'secondary_color_hover' => '#2e2d2d',
            'twibbon_link' => 'https://bit.ly/TWIBBON_INVFESTXISF',
            'instagram' => 'https://www.instagram.com/official.invfestxisf',
            'video_tutorial' => 'https://www.youtube.com/embed/LDT5cLIaRpw?si=_UKktn-lfWoQYhkF',
            'nav_logo' => $logo,
            'twibbon' => $logo,
            'mascot' => $logo,
        ];
    }

    /**
     * Manipulate settings data into array with constant format
     *
     * @param \Illuminate\Support\Collection $settings
     *
     * @return array
     */
    protected function manipulateSetting(\Illuminate\Support\Collection $settings): array
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
        $view->with('appSettings', $this->settings);
    }
}
