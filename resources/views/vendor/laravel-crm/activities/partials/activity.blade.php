@switch($activity->recordable_type)
    @case('Kv\MyCrm\Models\Note')
        @livewire('note',[
        'note' => $activity->recordable
        ], key('note_'.$activity->recordable->id))
        @break
    @case('Kv\MyCrm\Models\Task')
        @livewire('task',[
        'task' => $activity->recordable
        ], key('task_'.$activity->recordable->id))
        @break
    @case('Kv\MyCrm\Models\File')
        @livewire('file',[
        'file' => $activity->recordable
        ], key('file_'.$activity->recordable->id))
        @break
    @case('Kv\MyCrm\Models\Call')
        @livewire('call',[
        'call' => $activity->recordable
        ], key('call_'.$activity->recordable->id))
        @break
    @case('Kv\MyCrm\Models\Meeting')
        @livewire('meeting',[
        'meeting' => $activity->recordable
        ], key('meeting_'.$activity->recordable->id))
        @break
    @case('Kv\MyCrm\Models\Lunch')
        @livewire('lunch',[
        'lunch' => $activity->recordable
        ], key('lunch_'.$activity->recordable->id))
        @break
@endswitch