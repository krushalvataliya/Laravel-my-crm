<?php

namespace Kv\MyCrm\Observers;

use Illuminate\Support\Facades\Schema;
use Kv\MyCrm\Models\Setting;

class SettingObserver
{
    /**
     * Handle the email "creating" event.
     *
     * @param  \Kv\MyCrm\Models\Setting  $setting
     * @return void
     */
    public function creating(Setting $setting)
    {
        $this->setGlobal($setting);
    }

    /**
     * Handle the Setting "created" event.
     *
     * @param  \Kv\MyCrm\Models\Setting  $setting
     * @return void
     */
    public function created(Setting $setting)
    {
        //
    }

    /**
     * Handle the email "updating" event.
     *
     * @param  \Kv\MyCrm\Setting  $setting
     * @return void
     */
    public function updating(Setting $setting)
    {
        $this->setGlobal($setting);
    }

    /**
     * Handle the Setting "updated" event.
     *
     * @param  \Kv\MyCrm\Models\Setting  $setting
     * @return void
     */
    public function updated(Setting $setting)
    {
        //
    }

    /**
     * Handle the Setting "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Setting  $setting
     * @return void
     */
    public function deleted(Setting $setting)
    {
        //
    }

    /**
     * Handle the Setting "restored" event.
     *
     * @param  \Kv\MyCrm\Models\Setting  $setting
     * @return void
     */
    public function restored(Setting $setting)
    {
        //
    }

    /**
     * Handle the Setting "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Setting  $setting
     * @return void
     */
    public function forceDeleted(Setting $setting)
    {
        //
    }

    protected function setGlobal(Setting $setting)
    {
        if (Schema::hasColumn($setting->getTable(), 'global')) {
            switch ($setting->name) {
                case "app_name":
                case "app_env":
                case "app_url":
                case "version":
                case "install_id":
                case "version_latest":
                    $setting->global = 1;

                    break;
            }
        }
    }
}
