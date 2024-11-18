@if($editMode)
    <form wire:submit.prevent="update">
        @include('my-crm::livewire.components.partials.task.form-fields')
        <div class="form-group">
            <button type="button" class="btn btn-outline-secondary" wire:click="toggleEditMode()">{{ ucfirst(__('my-crm::lang.cancel')) }}</button>
            <button type="submit" class="btn btn-primary">{{ ucfirst(__('my-crm::lang.save')) }}</button>
        </div>
    </form>
@else
    {!! $task->description !!}
    @if($task->due_at)
        <br />
        @include('my-crm::livewire.components.partials.task.status') <span class="badge badge-secondary">{{ ucfirst(__('my-crm::lang.due')) }} {{ $task->due_at->format('h:i A') }} on {{ $task->due_at->toFormattedDateString() }}</span>
    @endif
@endif
