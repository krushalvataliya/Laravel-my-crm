<div class="row">
    <div class="col-sm-6 border-right">
        @include('my-crm::partials.form.text',[
          'name' => 'name',
          'label' => ucfirst(__('my-crm::lang.name')),
          'value' => old('name', $client->name ?? null),
          'required' => true
        ])
        @include('my-crm::partials.form.multiselect',[
            'name' => 'labels',
            'label' => ucfirst(__('my-crm::lang.labels')),
            'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Label::all(), false),      
            'value' =>  old('labels', (isset($client)) ? $client->labels->pluck('id')->toArray() : null)
        ])
        @include('my-crm::partials.form.select',[
             'name' => 'user_owner_id',
             'label' => ucfirst(__('my-crm::lang.owner')),
             'options' => ['' => ucfirst(__('my-crm::lang.unallocated'))] + \Kv\MyCrm\Http\Helpers\SelectOptions\users(false),
             'value' =>  old('user_owner_id', (isset($client)) ? $client->user_owner_id ?? '' : auth()->user()->id),
             'required' => true
        ])
        @include('my-crm::fields.partials.model', ['model' => $client ?? new \Kv\MyCrm\Models\Client()])
    </div>
    <div class="col-sm-6">
        
    </div>
</div>