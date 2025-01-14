<?php

namespace Kv\MyCrm\Services;

use Kv\MyCrm\Models\Setting;

class SettingService
{
    public function get($name)
    {
        return Setting::where('name', $name)->first();
    }

    public function set($name, $value, $label = null)
    {
        return Setting::updateOrCreate([
            'name' => $name,
        ], [
            'value' => $value,
            'label' => $label,
        ]);
    }
}
