<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\FieldModel;

class FieldModelObserver
{
    /**
     * Handle the fieldModel "creating" event.
     *
     * @param  \Kv\MyCrm\Models\FieldModel  $fieldModel
     * @return void
     */
    public function creating(FieldModel $fieldModel)
    {
        $fieldModel->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the fieldModel "created" event.
     *
     * @param  \Kv\MyCrm\Models\FieldModel  $fieldModel
     * @return void
     */
    public function created(FieldModel $fieldModel)
    {
        foreach ($fieldModel->model::all() as $model) {
            $model->fields()->create([
                'field_id' => $fieldModel->field_id,
                'value' => $fieldModel->field->default,
            ]);
        }
    }

    /**
     * Handle the fieldModel "updating" event.
     *
     * @param  \Kv\MyCrm\Models\FieldModel  $fieldModel
     * @return void
     */
    public function updating(FieldModel $fieldModel)
    {
        //
    }

    /**
     * Handle the fieldModel "updated" event.
     *
     * @param  \Kv\MyCrm\Models\FieldModel  $fieldModel
     * @return void
     */
    public function updated(FieldModel $fieldModel)
    {
        //
    }

    /**
     * Handle the fieldModel "deleting" event.
     *
     * @param  \Kv\MyCrm\FieldModel  $fieldModel
     * @return void
     */
    public function deleting(FieldModel $fieldModel)
    {
        foreach ($fieldModel->model::all() as $model) {
            if($field =  $model->fields()->where('field_id', $fieldModel->field_id)->first()) {
                $field->delete();
            }
        }
    }

    /**
     * Handle the fieldModel "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\FieldModel  $fieldModel
     * @return void
     */
    public function deleted(FieldModel $fieldModel)
    {
        //
    }

    /**
     * Handle the fieldModel "restored" event.
     *
     * @param  \Kv\MyCrm\Models\FieldModel  $fieldModel
     * @return void
     */
    public function restored(FieldModel $fieldModel)
    {
        //
    }

    /**
     * Handle the fieldModel "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\FieldModel  $fieldModel
     * @return void
     */
    public function forceDeleted(FieldModel $fieldModel)
    {
        //
    }
}
