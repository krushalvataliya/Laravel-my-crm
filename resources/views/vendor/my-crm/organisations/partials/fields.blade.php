<div class="row">
    <div class="col-sm-6 border-right">
        @include('my-crm::partials.form.text',[
          'name' => 'name',
          'label' => ucfirst(__('my-crm::lang.name')),
          'value' => old('name', $organisation->name ?? null),
          'required' => 'true'
        ])
        <div class="row">
            <div class="col">
                @include('my-crm::partials.form.select',[
                     'name' => 'organisation_type_id',
                     'label' => ucfirst(__('my-crm::lang.type')),
                     'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\OrganisationType::all(), true),
                     'value' =>  old('organisation_type_id', $organisation->organisationType->id ?? null),
                ])
            </div>
            <div class="col">
                @include('my-crm::partials.form.text',[
                  'name' => 'vat_number',
                  'label' => ucfirst(__('my-crm::lang.vat_number')),
                  'value' => old('vat_number', $organisation->vat_number ?? null),       
                ])
            </div>
        </div>

        <div class="row">
            <div class="col">
                @include('my-crm::partials.form.select',[
                     'name' => 'industry_id',
                     'label' => ucfirst(__('my-crm::lang.industry')),
                     'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Industry::all(), true),
                     'value' =>  old('industry_id', $organisation->industry->id ?? null),
                ])
            </div>
            <div class="col">
                @include('my-crm::partials.form.select',[
                     'name' => 'timezone_id',
                     'label' => ucfirst(__('my-crm::lang.timezone')),
                     'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Timezone::all(), true),
                     'value' =>  old('timezone_id', $organisation->timezone->id ?? null),
                ])
            </div>
        </div>

        <div class="row">
            <div class="col">
                @include('my-crm::partials.form.text',[
                   'name' => 'number_of_employees',
                   'label' => ucfirst(__('my-crm::lang.number_of_employees')),
                   'value' => old('number_of_employees', $organisation->number_of_employees ?? null),     
                 ])
            </div>
            <div class="col">
                @include('my-crm::partials.form.text',[
                    'name' => 'annual_revenue',
                    'label' => ucfirst(__('my-crm::lang.annual_revenue')),
                    'prepend' => '<span class="fa fa-dollar" aria-hidden="true"></span>',
                    'value' => old('annual_revenue', ((isset($organisation->annual_revenue)) ? ($organisation->annual_revenue / 100) : null) ?? null)      
                  ])
            </div>
        </div>

        @include('my-crm::partials.form.text',[
             'name' => 'linkedin',
             'label' => ucfirst(__('my-crm::lang.linkedin_company_page')),
             'prepend' => 'https://www.linkedin.com/company/',
             'value' => old('linkedin', $organisation->linkedin ?? null),     
           ])
        
        @include('my-crm::partials.form.textarea',[
           'name' => 'description',
           'label' => ucfirst(__('my-crm::lang.description')),
           'rows' => 5,
           'value' => old('description', $organisation->description ?? null) 
        ])
        @include('my-crm::partials.form.multiselect',[
            'name' => 'labels',
            'label' => ucfirst(__('my-crm::lang.labels')),
            'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Label::all(), false),      
            'value' =>  old('labels', (isset($organisation)) ? $organisation->labels->pluck('id')->toArray() : null)
        ])
        @include('my-crm::partials.form.select',[
             'name' => 'user_owner_id',
             'label' => ucfirst(__('my-crm::lang.owner')),
             'options' => ['' => ucfirst(__('my-crm::lang.unallocated'))] + \Kv\MyCrm\Http\Helpers\SelectOptions\users(false),
             'value' =>  old('user_owner_id', (isset($organisation)) ? $organisation->user_owner_id ?? '' : auth()->user()->id),
        ])

        @include('my-crm::fields.partials.model', ['model' => $organisation ?? new \Kv\MyCrm\Models\Organisation()])
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