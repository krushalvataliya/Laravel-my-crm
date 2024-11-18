<?php

namespace Kv\MyCrm\Traits;

trait HasCrmActivities
{
    public function activities()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Activity::class, 'timelineable');
    }

    public function tasks()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Task::class, 'taskable');
    }

    public function calls()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Call::class, 'callable');
    }

    public function meetings()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Meeting::class, 'meetingable');
    }

    public function lunches()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Lunch::class, 'lunchable');
    }

    public function notes()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Note::class, 'noteable');
    }

    public function files()
    {
        return $this->morphMany(\Kv\MyCrm\Models\File::class, 'fileable');
    }
}
