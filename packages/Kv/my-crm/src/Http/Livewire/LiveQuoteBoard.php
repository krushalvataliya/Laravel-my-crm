<?php

namespace Kv\MyCrm\Http\Livewire;

use Illuminate\Support\Collection;
use Kv\MyCrm\Http\Livewire\KanbanBoard\KanbanBoard;
use Kv\MyCrm\Models\Quote;
use Kv\MyCrm\Models\Pipeline;

class LiveQuoteBoard extends KanbanBoard
{
    public $model = 'quote';

    public $quotes;

    public function stages(): Collection
    {
        if($pipeline = Pipeline::where('model', get_class(new Quote()))->first()) {
            return $pipeline->pipelineStages()
                ->orderBy('order')
                ->orderBy('id')
                ->get();
        }
    }

    public function onStageChanged($recordId, $stageId, $fromOrderedIds, $toOrderedIds)
    {
        Quote::find($recordId)->update([
            'pipeline_stage_id' => $stageId
        ]);
    }

    public function records(): Collection
    {
        return $this->quotes->map(function (Quote $quote) {
            return [
                'id' => $quote->id,
                'title' => $quote->title,
                'labels' => $quote->labels,
                'stage' => $quote->pipelineStage->id ?? $this->firstStageId(),
                'number' => $quote->quote_id,
                'amount' => $quote->total,
                'currency' => $quote->currency,
            ];
        });
    }
}
