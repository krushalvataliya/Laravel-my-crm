<div class="row">
    <div class="col-sm-6 border-right">
        <div class="row">
            <div class="col-2">
                @include('my-crm::partials.form.text',[
                     'name' => 'title',
                     'label' => ucfirst(__('my-crm::lang.title')),
                     'value' => old('title', $person->title ?? null)
                 ])
            </div>
            <div class="col">
                @include('my-crm::partials.form.text',[
                      'name' => 'first_name',
                      'label' => ucfirst(__('my-crm::lang.first_name')),
                      'value' => old('first_name', $person->first_name ?? null),
                      'required' => 'true'
                  ])
            </div>
            <div class="col">
                @include('my-crm::partials.form.text',[
                   'name' => 'last_name',
                   'label' => ucfirst(__('my-crm::lang.last_name')),
                   'value' => old('last_name', $person->last_name ?? null)
               ])
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('my-crm::partials.form.text',[
                    'name' => 'middle_name',
                    'label' => ucfirst(__('my-crm::lang.middle_name')),
                    'value' => old('middle_name', $person->middle_name ?? null)
                ])
            </div>
            <div class="col">
                @include('my-crm::partials.form.select',[
                   'name' => 'gender',
                   'label' => ucfirst(__('my-crm::lang.gender')),
                   'options' => [
                       '',
                       'male' => 'Male',
                       'female' => 'Female'
                       ],
                   'value' => old('gender', $person->gender ?? null)
               ])
            </div>
            <div class="col">
                @include('my-crm::partials.form.text',[
                      'name' => 'birthday',
                      'label' => ucfirst(__('my-crm::lang.birthday')),
                      'value' => old('birthday', $person->birthday ?? null),
                      'attributes' => [
                          'autocomplete' => \Illuminate\Support\Str::random()
                       ]
                  ])
            </div>
        </div>
        
        @include('my-crm::partials.form.textarea',[
           'name' => 'description',
           'label' => ucfirst(__('my-crm::lang.description')),
           'rows' => 5,
           'value' => old('description', $person->description ?? null) 
        ])
        @include('my-crm::partials.form.multiselect',[
            'name' => 'labels',
            'label' => ucfirst(__('my-crm::lang.labels')),
            'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Label::all(), false),      
            'value' =>  old('labels', (isset($person)) ? $person->labels->pluck('id')->toArray() : null)
        ])
        @include('my-crm::partials.form.select',[
         'name' => 'user_owner_id',
         'label' => ucfirst(__('my-crm::lang.owner')),
         'options' => ['' => ucfirst(__('my-crm::lang.unallocated'))] + \Kv\MyCrm\Http\Helpers\SelectOptions\users(false),
         'value' =>  old('user_owner_id', (isset($person)) ? $person->user_owner_id ?? '' : auth()->user()->id),
       ])
        @include('my-crm::fields.partials.model', ['model' => $person ?? new \Kv\MyCrm\Models\Person()])
    </div>
    <div class="col-sm-6">
        @livewire('phone-edit', [
        'phones' => $phones ?? null,
        'old' => old('phones')
        ])
        
        @livewire('email-edit', [
        'emails' => $emails ?? null,
        'old' => old('emails')
        ])

        @livewire('address-edit', [
        'addresses' => $addresses ?? null,
        'old' => old('addresses')
        ])
    </div>
</div>