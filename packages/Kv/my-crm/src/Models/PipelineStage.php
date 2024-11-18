<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class PipelineStage extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'pipeline_stages';
    }

    public function pipeline()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Pipeline::class);
    }

    public function pipelineStageProbability()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\PipelineStageProbability::class);
    }

    public function leads()
    {
        return $this->hasMany(\Kv\MyCrm\Models\Lead::class);
    }

    public function deals()
    {
        return $this->hasMany(\Kv\MyCrm\Models\Deal::class);
    }

    public function quotes()
    {
        return $this->hasMany(\Kv\MyCrm\Models\Quote::class);
    }
}
