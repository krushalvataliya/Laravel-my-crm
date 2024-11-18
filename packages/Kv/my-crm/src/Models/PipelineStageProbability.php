<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class PipelineStageProbability extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'pipeline_stage_probabilities';
    }

    public function pipelineStage()
    {
        return $this->hasMany(\Kv\MyCrm\Models\PipelineStage::class);
    }
}
