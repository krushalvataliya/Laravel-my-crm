@if(! isset($lunch))
    <div class="form-group @error('name') text-danger @enderror">
        <label>{{ ucfirst(__('my-crm::lang.title')) }}</label>
        <input wire:model="name" type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name" rows="3" />
        @error('name')
        <div class="text-danger invalid-feedback-custom">{{ $message }}</div>
        @enderror
    </div>
    <div class="row">
        <div class="col">
            @include('my-crm::partials.form.text',[
                  'name' => 'start_at',
                  'label' => ucfirst(__('my-crm::lang.from')),
                  'attributes' => [
                      'wire:model.debounce.10000ms' => 'start_at',
                      'autocomplete' => 'off',
                      'role' => 'presentation'
                  ]
                ])
        </div>
        <div class="col">
            @include('my-crm::partials.form.text',[
                 'name' => 'finish_at',
                 'label' => ucfirst(__('my-crm::lang.to')),
                 'attributes' => [
                     'wire:model.debounce.10000ms' => 'finish_at',
                     'autocomplete' => 'off',
                     'role' => 'presentation'
                 ]
               ])
        </div>
    </div>
    <span wire:ignore>
        @include('my-crm::partials.form.multiselect',[
          'name' => 'guests',
          'label' => ucfirst(__('my-crm::lang.guests')),
          'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Person::all(), false),      
          'attributes' => [
               'wire:model' => 'guests',
          ]
        ])
    </span>
    @include('my-crm::partials.form.text',[
     'name' => 'location',
     'label' => ucfirst(__('my-crm::lang.location')),
     'attributes' => [
           'wire:model' => 'location',
      ]
   ])
    {{--<div wire:model="content" x-data @trix-blur="$dispatch('change', $event.target.value)" class="form-group @error('content') text-danger @enderror">
        <span wire:ignore>
            <label>{{ ucfirst(__('my-crm::lang.add_note')) }}</label>
            <trix-editor class="form-control @error('content') is-invalid @enderror" id="content">{{ $note->message ?? null }}</trix-editor>
            @error('content')
            <div class="text-danger invalid-feedback-custom">{{ $message }}</div>
            @enderror
        </span>
    </div>--}}
    <div class="form-group @error('description') text-danger @enderror">
        <label>{{ ucfirst(__('my-crm::lang.description')) }}</label>
        <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="textarea_description" name="description" rows="3">{{ $value ?? null }}</textarea>
        @error('description')
        <div class="text-danger invalid-feedback-custom">{{ $message }}</div>
        @enderror
    </div>
@else
    <div class="form-group @error('name') text-danger @enderror">
        <label>{{ ucfirst(__('my-crm::lang.title')) }}</label>
        <input wire:model="name" type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name" rows="3" />
        @error('name')
        <div class="text-danger invalid-feedback-custom">{{ $message }}</div>
        @enderror
    </div>
    <div class="row">
        <div class="col">
            @include('my-crm::partials.form.text',[
                  'name' => 'start_at',
                  'label' => ucfirst(__('my-crm::lang.from')),
                  'attributes' => [
                      'wire:model.debounce.10000ms' => 'start_at',
                      'autocomplete' => 'off',
                      'role' => 'presentation'
                  ]
                ])
        </div>
        <div class="col">
            @include('my-crm::partials.form.text',[
                 'name' => 'finish_at',
                 'label' => ucfirst(__('my-crm::lang.to')),
                 'attributes' => [
                     'wire:model.debounce.10000ms' => 'finish_at',
                     'autocomplete' => 'off',
                     'role' => 'presentation'
                 ]
               ])
        </div>
    </div>
    <span wire:ignore>
    @include('my-crm::partials.form.multiselect',[
      'name' => 'guests',
      'label' => ucfirst(__('my-crm::lang.guests')),
      'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Person::all(), false),
      'attributes' => [
         'wire:model' => 'guests',
       ]
    ])  
    </span>
    @include('my-crm::partials.form.text',[
     'name' => 'location',
     'label' => ucfirst(__('my-crm::lang.location')),
     'attributes' => [
         'wire:model' => 'location',
       ]
   ])
    {{--<div wire:model="content" x-data @trix-blur="$dispatch('change', $event.target.value)" class="form-group @error('note.content') text-danger @enderror">
        <input id="content_{{ $note->id }}" value="{{ $note->content }}" type="hidden">
        <span wire:ignore>
            <label>{{ ucfirst(__('my-crm::lang.add_note')) }}</label>
            <trix-editor input="content_{{ $note->id }}" class="form-control @error('note.content') is-invalid @enderror"></trix-editor>
            @error('note.content')
            <div class="text-danger invalid-feedback-custom">{{ $message }}</div>
            @enderror
        </span>
    </div>--}}
    <div class="form-group @error('description') text-danger @enderror">
        <label>{{ ucfirst(__('my-crm::lang.description')) }}</label>
        <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="textarea_description" name="description" rows="3">{{ $value ?? null }}</textarea>
        @error('description')
        <div class="text-danger invalid-feedback-custom">{{ $message }}</div>
        @enderror
    </div>

@endif

