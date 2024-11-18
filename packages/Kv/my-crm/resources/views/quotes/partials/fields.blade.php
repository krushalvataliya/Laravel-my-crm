<div class="row">
    <div class="col-sm-5 border-right">
        @include('my-crm::partials.form.hidden',[
             'name' => 'lead_id',
             'value' => old('lead_id', $quote->lead->id ?? $lead->id ?? null),
        ])

        @livewire('quote-form',[
            'quote' => $quote ?? null,
            'generateTitle' => $generateTitle ?? true,
            'client' => $client ?? null,
            'organisation' => $organisation ?? null,
            'person' => $person ?? null
        ])
        
        @include('my-crm::partials.form.textarea',[
             'name' => 'description',
             'label' => ucfirst(__('my-crm::lang.description')),
             'rows' => 5,
             'value' => old('description', $quote->description ?? null) 
        ])
        <div class="row">
            <div class="col-sm-6">
                @include('my-crm::partials.form.text',[
                      'name' => 'reference',
                      'label' => ucfirst(__('my-crm::lang.reference')),
                      'value' => old('amount', $quote->reference ?? null) 
                  ])
            </div>
            <div class="col-sm-6">
                @include('my-crm::partials.form.select',[
                    'name' => 'currency',
                    'label' => ucfirst(__('my-crm::lang.currency')),
                    'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\currencies(),
                    'value' => old('currency', $quote->currency ?? \Kv\MyCrm\Models\Setting::currency()->value ?? 'USD')
                ])
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                @include('my-crm::partials.form.text',[
                     'name' => 'issue_at',
                     'label' => ucfirst(__('my-crm::lang.issue_date')),
                     'value' => old('issue_at', (isset($quote->issue_at)) ? \Carbon\Carbon::parse($quote->issue_at)->format($dateFormat) : null),
                     'attributes' => [
                         'autocomplete' => \Illuminate\Support\Str::random()
                      ]
                 ])
            </div>
            <div class="col-sm-6">
                @include('my-crm::partials.form.text',[
                     'name' => 'expire_at',
                     'label' => ucfirst(__('my-crm::lang.expiry_date')),
                     'value' => old('expire_at', (isset($quote->expire_at)) ? \Carbon\Carbon::parse($quote->expire_at)->format($dateFormat) : null),
                     'attributes' => [
                         'autocomplete' => \Illuminate\Support\Str::random()
                      ]
                ])
            </div>
        </div>

        @include('my-crm::partials.form.textarea',[
             'name' => 'terms',
             'label' => ucfirst(__('my-crm::lang.terms')),
             'rows' => 5,
             'value' => old('terms', $quote->terms ?? $quoteTerms->value ?? null) 
        ])

        @if($pipeline)
            @include('my-crm::partials.form.select',[
                     'name' => 'pipeline_stage_id',
                     'label' => ucfirst(__('my-crm::lang.stage')),
                     'options' => $pipeline->pipelineStages()
                                            ->orderBy('order')
                                            ->orderBy('id')
                                            ->pluck('name', 'id') ?? [],
                     'value' =>  old('pipeline_stage_id', $quote->pipelineStage->id ?? $stage ?? $pipeline->pipelineStages()
                                            ->orderBy('order')
                                            ->orderBy('id')
                                            ->first()->id ?? null),
              ])
        @endif
        
        @include('my-crm::partials.form.multiselect',[
            'name' => 'labels',
            'label' => ucfirst(__('my-crm::lang.labels')),
            'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Label::all(), false),      
            'value' =>  old('labels', (isset($quote)) ? $quote->labels->pluck('id')->toArray() : null)
        ])

        @include('my-crm::partials.form.select',[
             'name' => 'user_owner_id',
             'label' => ucfirst(__('my-crm::lang.owner')),
             'options' => ['' => ucfirst(__('my-crm::lang.unallocated'))] + \Kv\MyCrm\Http\Helpers\SelectOptions\users(false),
             'value' =>  old('user_owner_id', (isset($quote)) ? $quote->user_owner_id ?? '' : auth()->user()->id),
        ])

        @include('my-crm::fields.partials.model', ['model' => $quote ?? new \Kv\MyCrm\Models\Quote()])

    </div>
    <div class="col-sm-7">
        @livewire('quote-items',[
            'quote' => $quote ?? null,
            'products' => $quote->quoteProducts ?? null,
            'old' => old('products')
        ])
    </div>
</div>