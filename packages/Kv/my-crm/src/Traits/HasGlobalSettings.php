<?php

namespace Kv\MyCrm\Traits;

use Kv\MyCrm\Models\Setting;

trait HasGlobalSettings
{
    public static function dateFormat()
    {
        return Setting::where('name', 'date_format')->first()->value ?? 'Y/m/d';
    }

    public static function timeFormat()
    {
        return Setting::where('name', 'time_format')->first()->value ?? 'H:i';
    }
}
