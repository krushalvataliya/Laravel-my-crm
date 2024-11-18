<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Kv\MyCrm\Traits\BelongsToTeams;
use Kv\MyCrm\Traits\HasCrmActivities;
use Kv\MyCrm\Traits\HasCrmFields;
use Kv\MyCrm\Traits\HasCrmUserRelations;
use Kv\MyCrm\Traits\SearchFilters;
use VentureDrake\LaravelEncryptable\Traits\LaravelEncryptableTrait;

class Client extends Model
{
    use SoftDeletes;
    use LaravelEncryptableTrait;
    use BelongsToTeams;
    use HasCrmFields;
    use SearchFilters;
    use Sortable;
    use HasCrmActivities;
    use HasCrmUserRelations;

    protected $guarded = ['id'];

    protected $encryptable = [
        'name',
    ];

    protected $searchable = [
        'name',
    ];

    protected $filterable = [
        'user_owner_id',
        'labels.id',
    ];

    public $sortable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function getSearchable()
    {
        return $this->searchable;
    }

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'clients';
    }

    public function getNameAttribute($value)
    {
        if ($value) {
            return $value;
        } else {
            return $this->clientable->name ?? null;
        }
    }

    /**
     * Get all of the owning clientable models.
     */
    public function clientable()
    {
        return $this->morphTo();
    }

    /**
     * Get all of the labels for the person.
     */
    public function labels()
    {
        return $this->morphToMany(\Kv\MyCrm\Models\Label::class, config('laravel-crm.db_table_prefix').'labelable');
    }

    public function contacts()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Contact::class, 'contactable');
    }
}
