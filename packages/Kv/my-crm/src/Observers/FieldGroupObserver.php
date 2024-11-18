<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\FieldGroup;

class FieldGroupObserver
{
    /**
     * Handle the fieldGroup "creating" event.
     *
     * @param  \Kv\MyCrm\Models\FieldGroup  $fieldGroup
     * @return void
     */
    public function creating(FieldGroup $fieldGroup)
    {
        $fieldGroup->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the fieldGroup "created" event.
     *
     * @param  \Kv\MyCrm\Models\FieldGroup  $fieldGroup
     * @return void
     */
    public function created(FieldGroup $fieldGroup)
    {
        //
    }

    /**
     * Handle the fieldGroup "updating" event.
     *
     * @param  \Kv\MyCrm\Models\FieldGroup  $fieldGroup
     * @return void
     */
    public function updating(FieldGroup $fieldGroup)
    {
        //
    }

    /**
     * Handle the fieldGroup "updated" event.
     *
     * @param  \Kv\MyCrm\Models\FieldGroup  $fieldGroup
     * @return void
     */
    public function updated(FieldGroup $fieldGroup)
    {
        //
    }

    /**
     * Handle the fieldGroup "deleting" event.
     *
     * @param  \Kv\MyCrm\FieldGroup  $fieldGroup
     * @return void
     */
    public function deleting(FieldGroup $fieldGroup)
    {
        //
    }

    /**
     * Handle the fieldGroup "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\FieldGroup  $fieldGroup
     * @return void
     */
    public function deleted(FieldGroup $fieldGroup)
    {
        //
    }

    /**
     * Handle the fieldGroup "restored" event.
     *
     * @param  \Kv\MyCrm\Models\FieldGroup  $fieldGroup
     * @return void
     */
    public function restored(FieldGroup $fieldGroup)
    {
        //
    }

    /**
     * Handle the fieldGroup "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\FieldGroup  $fieldGroup
     * @return void
     */
    public function forceDeleted(FieldGroup $fieldGroup)
    {
        //
    }
}
