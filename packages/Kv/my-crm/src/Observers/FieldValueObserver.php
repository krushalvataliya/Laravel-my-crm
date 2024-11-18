<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\FieldValue;

class FieldValueObserver
{
    /**
     * Handle the fieldValue "creating" event.
     *
     * @param  \Kv\MyCrm\Models\FieldValue  $fieldValue
     * @return void
     */
    public function creating(FieldValue $fieldValue)
    {
        $fieldValue->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the fieldValue "created" event.
     *
     * @param  \Kv\MyCrm\Models\FieldValue  $fieldValue
     * @return void
     */
    public function created(FieldValue $fieldValue)
    {
        //
    }

    /**
     * Handle the fieldValue "updating" event.
     *
     * @param  \Kv\MyCrm\Models\FieldValue  $fieldValue
     * @return void
     */
    public function updating(FieldValue $fieldValue)
    {
        //
    }

    /**
     * Handle the fieldValue "updated" event.
     *
     * @param  \Kv\MyCrm\Models\FieldValue  $fieldValue
     * @return void
     */
    public function updated(FieldValue $fieldValue)
    {
        //
    }

    /**
     * Handle the fieldValue "deleting" event.
     *
     * @param  \Kv\MyCrm\FieldValue  $fieldValue
     * @return void
     */
    public function deleting(FieldValue $fieldValue)
    {
        //
    }

    /**
     * Handle the fieldValue "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\FieldValue  $fieldValue
     * @return void
     */
    public function deleted(FieldValue $fieldValue)
    {
        //
    }

    /**
     * Handle the fieldValue "restored" event.
     *
     * @param  \Kv\MyCrm\Models\FieldValue  $fieldValue
     * @return void
     */
    public function restored(FieldValue $fieldValue)
    {
        //
    }

    /**
     * Handle the fieldValue "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\FieldValue  $fieldValue
     * @return void
     */
    public function forceDeleted(FieldValue $fieldValue)
    {
        //
    }
}
