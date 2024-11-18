<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\Pipeline;

class PipelineObserver
{
    /**
     * Handle the pipeline "creating" event.
     *
     * @param  \Kv\MyCrm\Pipeline  $pipeline
     * @return void
     */
    public function creating(Pipeline $pipeline)
    {
        $pipeline->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the pipeline "created" event.
     *
     * @param  \Kv\MyCrm\Pipeline  $pipeline
     * @return void
     */
    public function created(Pipeline $pipeline)
    {
        //
    }

    /**
     * Handle the pipeline "updating" event.
     *
     * @param  \Kv\MyCrm\Pipeline  $pipeline
     * @return void
     */
    public function updating(Pipeline $pipeline)
    {
        //
    }

    /**
     * Handle the pipeline "updated" event.
     *
     * @param  \Kv\MyCrm\Pipeline  $pipeline
     * @return void
     */
    public function updated(Pipeline $pipeline)
    {
        //
    }

    /**
     * Handle the pipeline "deleting" event.
     *
     * @param  \Kv\MyCrm\Pipeline  $pipeline
     * @return void
     */
    public function deleting(Pipeline $pipeline)
    {
        //
    }

    /**
     * Handle the pipeline "deleted" event.
     *
     * @param  \Kv\MyCrm\Pipeline  $pipeline
     * @return void
     */
    public function deleted(Pipeline $pipeline)
    {
        //
    }

    /**
     * Handle the pipeline "restoring" event.
     *
     * @param  \Kv\MyCrm\Pipeline  $pipeline
     * @return void
     */
    public function restoring(Pipeline $pipeline)
    {
    }

    /**
     * Handle the pipeline "restored" event.
     *
     * @param  \Kv\MyCrm\Pipeline  $pipeline
     * @return void
     */
    public function restored(Pipeline $pipeline)
    {
        //
    }

    /**
     * Handle the pipeline "force deleted" event.
     *
     * @param  \Kv\MyCrm\Pipeline  $pipeline
     * @return void
     */
    public function forceDeleted(Pipeline $pipeline)
    {
        //
    }
}
