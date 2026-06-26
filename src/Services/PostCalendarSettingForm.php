<?php

declare(strict_types=1);

namespace Molitor\PostCalendar\Services;

use Molitor\Setting\Enums\SettingFieldType;
use Molitor\Setting\Services\SettingForm;
use Molitor\Theme\Services\LayoutService;

class PostCalendarSettingForm extends SettingForm
{
    public function getSlug(): string
    {
        return 'post-calendar';
    }

    public function getLabel(): string
    {
        return 'Bejegyzésnaptár';
    }

    public function getFields(): array
    {
        return [
            'post_calendar_index_layout' => [
                'label' => 'Naptár oldal layout',
                'type' => SettingFieldType::Select,
                'options' => $this->getLayoutOptions(),
                'default' => app(LayoutService::class)->getDefault(),
            ],
            'post_calendar_day_layout' => [
                'label' => 'Nap oldal layout',
                'type' => SettingFieldType::Select,
                'options' => $this->getLayoutOptions(),
                'default' => app(LayoutService::class)->getDefault(),
            ],
        ];
    }

    private function getLayoutOptions(): array
    {
        $options = [];
        foreach (app(LayoutService::class)->getLayouts() as $key => $layout) {
            $options[] = ['value' => $key, 'label' => $layout['name']];
        }

        return $options;
    }
}
