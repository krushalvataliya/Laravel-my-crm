<?php

namespace Kv\MyCrm\Http\Livewire;

use Illuminate\Support\Collection;
use Kv\MyCrm\Http\Livewire\KanbanBoard\KanbanBoard;
use Kv\MyCrm\Models\Lead;
use Kv\MyCrm\Models\Pipeline;

class LiveLeadBoard extends KanbanBoard
{
    public $model = 'lead';

    public $leads;

    public function stages(): Collection
    {
        if($pipeline = Pipeline::where('model', get_class(new Lead()))->first()) {
            return $pipeline->pipelineStages()
                ->orderBy('order')
                ->orderBy('id')
                ->get();
        }
        return collect([]);
    }

    public function onStageChanged($recordId, $stageId, $fromOrderedIds, $toOrderedIds)
    {
        Lead::find($recordId)->update([
            'pipeline_stage_id' => $stageId
        ]);
    }

    public function records(): Collection
    {
        return $this->leads->map(function (Lead $lead) {
            return [
                'id' => $lead->id,
                'title' => $lead->title,
                'labels' => $lead->labels,
                'stage' => $lead->pipelineStage->id ?? $this->firstStageId(),
                'number' => $lead->lead_id,
                'amount' => $lead->amount,
                'currency' => $lead->currency,
            ];
        });
    }
}
