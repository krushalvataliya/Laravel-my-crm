<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\Field;

class FieldObserver
{
    /**
     * Handle the field "creating" event.
     *
     * @param  \Kv\MyCrm\Models\Field  $field
     * @return void
     */
    public function creating(Field $field)
    {
        $field->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the field "created" event.
     *
     * @param  \Kv\MyCrm\Models\Field  $field
     * @return void
     */
    public function created(Field $field)
    {
        //
    }

    /**
     * Handle the field "updating" event.
     *
     * @param  \Kv\MyCrm\Models\Field  $field
     * @return void
     */
    public function updating(Field $field)
    {
        //
    }

    /**
     * Handle the field "updated" event.
     *
     * @param  \Kv\MyCrm\Models\Field  $field
     * @return void
     */
    public function updated(Field $field)
    {
        //
    }

    /**
     * Handle the field "deleting" event.
     *
     * @param  \Kv\MyCrm\Field  $field
     * @return void
     */
    public function deleting(Field $field)
    {
        //
    }

    /**
     * Handle the field "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Field  $field
     * @return void
     */
    public function deleted(Field $field)
    {
        //
    }

    /**
     * Handle the field "restored" event.
     *
     * @param  \Kv\MyCrm\Models\Field  $field
     * @return void
     */
    public function restored(Field $field)
    {
        //
    }

    /**
     * Handle the field "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Field  $field
     * @return void
     */
    public function forceDeleted(Field $field)
    {
        //
    }
}
