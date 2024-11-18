<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\PipelineStage;

class PipelineStageObserver
{
    /**
     * Handle the pipelineStage "creating" event.
     *
     * @param  \Kv\MyCrm\PipelineStage  $pipelineStage
     * @return void
     */
    public function creating(PipelineStage $pipelineStage)
    {
        $pipelineStage->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the pipelineStage "created" event.
     *
     * @param  \Kv\MyCrm\PipelineStage  $pipelineStage
     * @return void
     */
    public function created(PipelineStage $pipelineStage)
    {
        //
    }

    /**
     * Handle the pipelineStage "updating" event.
     *
     * @param  \Kv\MyCrm\PipelineStage  $pipelineStage
     * @return void
     */
    public function updating(PipelineStage $pipelineStage)
    {
        //
    }

    /**
     * Handle the pipelineStage "updated" event.
     *
     * @param  \Kv\MyCrm\PipelineStage  $pipelineStage
     * @return void
     */
    public function updated(PipelineStage $pipelineStage)
    {
        //
    }

    /**
     * Handle the pipelineStage "deleting" event.
     *
     * @param  \Kv\MyCrm\PipelineStage  $pipelineStage
     * @return void
     */
    public function deleting(PipelineStage $pipelineStage)
    {
        //
    }

    /**
     * Handle the pipelineStage "deleted" event.
     *
     * @param  \Kv\MyCrm\PipelineStage  $pipelineStage
     * @return void
     */
    public function deleted(PipelineStage $pipelineStage)
    {
        //
    }

    /**
     * Handle the pipelineStage "restoring" event.
     *
     * @param  \Kv\MyCrm\PipelineStage  $pipelineStage
     * @return void
     */
    public function restoring(PipelineStage $pipelineStage)
    {
    }

    /**
     * Handle the pipelineStage "restored" event.
     *
     * @param  \Kv\MyCrm\PipelineStage  $pipelineStage
     * @return void
     */
    public function restored(PipelineStage $pipelineStage)
    {
        //
    }

    /**
     * Handle the pipelineStage "force deleted" event.
     *
     * @param  \Kv\MyCrm\PipelineStage  $pipelineStage
     * @return void
     */
    public function forceDeleted(PipelineStage $pipelineStage)
    {
        //
    }
}
