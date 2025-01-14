<?php

namespace Kv\MyCrm\Http\Livewire;

use Illuminate\Support\Collection;
use Kv\MyCrm\Http\Livewire\KanbanBoard\KanbanBoard;
use Kv\MyCrm\Models\Deal;
use Kv\MyCrm\Models\Pipeline;

class LiveDealBoard extends KanbanBoard
{
    public $model = 'deal';

    public $deals;

    public function stages(): Collection
    {
        if($pipeline = Pipeline::where('model', get_class(new Deal()))->first()) {
            return $pipeline->pipelineStages()
                ->orderBy('order')
                ->orderBy('id')
                ->get();
        }
    }

    public function onStageChanged($recordId, $stageId, $fromOrderedIds, $toOrderedIds)
    {
        Deal::find($recordId)->update([
            'pipeline_stage_id' => $stageId
        ]);
    }

    public function records(): Collection
    {
        return $this->deals->map(function (Deal $deal) {
            return [
                'id' => $deal->id,
                'title' => $deal->title,
                'labels' => $deal->labels,
                'stage' => $deal->pipelineStage->id ?? $this->firstStageId(),
                'number' => $deal->deal_id,
                'amount' => $deal->amount,
                'currency' => $deal->currency,
            ];
        });
    }
}
