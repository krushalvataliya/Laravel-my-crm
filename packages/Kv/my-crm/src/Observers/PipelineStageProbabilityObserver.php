<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\PipelineStageProbability;

class PipelineStageProbabilityObserver
{
    /**
     * Handle the pipelineStageProbability "creating" event.
     *
     * @param  \Kv\MyCrm\PipelineStageProbability  $pipelineStageProbability
     * @return void
     */
    public function creating(PipelineStageProbability $pipelineStageProbability)
    {
        $pipelineStageProbability->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the pipelineStageProbability "created" event.
     *
     * @param  \Kv\MyCrm\PipelineStageProbability  $pipelineStageProbability
     * @return void
     */
    public function created(PipelineStageProbability $pipelineStageProbability)
    {
        //
    }

    /**
     * Handle the pipelineStageProbability "updating" event.
     *
     * @param  \Kv\MyCrm\PipelineStageProbability  $pipelineStageProbability
     * @return void
     */
    public function updating(PipelineStageProbability $pipelineStageProbability)
    {
        //
    }

    /**
     * Handle the pipelineStageProbability "updated" event.
     *
     * @param  \Kv\MyCrm\PipelineStageProbability  $pipelineStageProbability
     * @return void
     */
    public function updated(PipelineStageProbability $pipelineStageProbability)
    {
        //
    }

    /**
     * Handle the pipelineStageProbability "deleting" event.
     *
     * @param  \Kv\MyCrm\PipelineStageProbability  $pipelineStageProbability
     * @return void
     */
    public function deleting(PipelineStageProbability $pipelineStageProbability)
    {
        //
    }

    /**
     * Handle the pipelineStageProbability "deleted" event.
     *
     * @param  \Kv\MyCrm\PipelineStageProbability  $pipelineStageProbability
     * @return void
     */
    public function deleted(PipelineStageProbability $pipelineStageProbability)
    {
        //
    }

    /**
     * Handle the pipelineStageProbability "restoring" event.
     *
     * @param  \Kv\MyCrm\PipelineStageProbability  $pipelineStageProbability
     * @return void
     */
    public function restoring(PipelineStageProbability $pipelineStageProbability)
    {
    }

    /**
     * Handle the pipelineStageProbability "restored" event.
     *
     * @param  \Kv\MyCrm\PipelineStageProbability  $pipelineStageProbability
     * @return void
     */
    public function restored(PipelineStageProbability $pipelineStageProbability)
    {
        //
    }

    /**
     * Handle the pipelineStageProbability "force deleted" event.
     *
     * @param  \Kv\MyCrm\PipelineStageProbability  $pipelineStageProbability
     * @return void
     */
    public function forceDeleted(PipelineStageProbability $pipelineStageProbability)
    {
        //
    }
}
