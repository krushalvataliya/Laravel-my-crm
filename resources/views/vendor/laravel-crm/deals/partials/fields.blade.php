<div class="row">
    <div class="col-sm-6 border-right">
        @include('my-crm::partials.form.hidden',[
             'name' => 'lead_id',
             'value' => old('lead_id', $deal->lead->id ?? $lead->id ?? null),
        ])

        @livewire('deal-form',[
            'deal' => $deal ?? null,
            'generateTitle' => $generateTitle ?? true,
            'client' => $client ?? null,
            'organisation' => $organisation ?? null,
            'person' => $person ?? null
        ])
        
        @include('my-crm::partials.form.textarea',[
             'name' => 'description',
             'label' => ucfirst(__('my-crm::lang.description')),
             'rows' => 5,
             'value' => old('description', $deal->description ?? null) 
        ])
        <div class="row">
            <div class="col-sm-6">
                @include('my-crm::partials.form.text',[
                      'name' => 'amount',
                      'label' => ucfirst(__('my-crm::lang.value')),
                      'prepend' => '<span class="fa fa-dollar" aria-hidden="true"></span>',
                      'value' => old('amount', ((isset($deal->amount)) ? ($deal->amount / 100) : null) ?? null) 
                  ])
            </div>
            <div class="col-sm-6">
                @include('my-crm::partials.form.select',[
                    'name' => 'currency',
                    'label' => ucfirst(__('my-crm::lang.currency')),
                    'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\currencies(),
                    'value' => old('currency', $deal->currency ?? \Kv\MyCrm\Models\Setting::currency()->value ?? 'USD')
                ])
            </div>
        </div>
        @include('my-crm::partials.form.text',[
             'name' => 'expected_close',
             'label' => ucfirst(__('my-crm::lang.expected_close_date')),
             'value' => old('expected_close', (isset($deal->expected_close)) ? \Carbon\Carbon::parse($deal->expected_close)->format($dateFormat) : null),
             'attributes' => [
                 'autocomplete' => \Illuminate\Support\Str::random()
              ]
         ])

        @if($pipeline)
            @include('my-crm::partials.form.select',[
                     'name' => 'pipeline_stage_id',
                     'label' => ucfirst(__('my-crm::lang.stage')),
                     'options' => $pipeline->pipelineStages()
                                            ->orderBy('order')
                                            ->orderBy('id')
                                            ->pluck('name', 'id') ?? [],
                     'value' =>  old('pipeline_stage_id', $deal->pipelineStage->id ?? $stage ?? $pipeline->pipelineStages()
                                            ->orderBy('order')
                                            ->orderBy('id')
                                            ->first()->id ?? null),
              ])
        @endif

        @include('my-crm::partials.form.multiselect',[
            'name' => 'labels',
            'label' => ucfirst(__('my-crm::lang.labels')),
            'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Label::all(), false),      
            'value' =>  old('labels', (isset($deal)) ? $deal->labels->pluck('id')->toArray() : null)
        ])

        @include('my-crm::partials.form.select',[
                 'name' => 'user_owner_id',
                 'label' => ucfirst(__('my-crm::lang.owner')),
                 'options' => ['' => ucfirst(__('my-crm::lang.unallocated'))] + \Kv\MyCrm\Http\Helpers\SelectOptions\users(false),
                 'value' =>  old('user_owner_id', (isset($deal)) ? $deal->user_owner_id ?? '' : auth()->user()->id),
              ])

        @include('my-crm::fields.partials.model', ['model' => $deal ?? new \Kv\MyCrm\Models\Deal()])
    </div>
    <div class="col-sm-6">
        <h6 class="text-uppercase"><span class="fa fa-user" aria-hidden="true"></span> {{ ucfirst(__('my-crm::lang.person')) }}</h6>
        <hr />
        <span class="autocomplete-person">
            <div class="row">
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                     'name' => 'phone',
                     'label' => ucfirst(__('my-crm::lang.phone')),
                     'value' => old('phone', $phone->number ?? null),
                     'attributes' => [
                         'disabled' => 'disabled'
                     ]
                  ])
                </div>
                <div class="col-sm-6">
                    @include('my-crm::partials.form.select',[
                     'name' => 'phone_type',
                     'label' => ucfirst(__('my-crm::lang.type')),
                     'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\phoneTypes(),
                     'value' => old('phone_type', $phone->type ??  'mobile'),
                     'attributes' => [
                         'disabled' => 'disabled'
                     ]
                  ])
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                     'name' => 'email',
                     'label' => ucfirst(__('my-crm::lang.email')),
                     'value' => old('email', $email->address ?? null),
                     'attributes' => [
                         'disabled' => 'disabled'
                     ]
                  ])
                </div>
                <div class="col-sm-6">
                    @include('my-crm::partials.form.select',[
                     'name' => 'email_type',
                     'label' => ucfirst(__('my-crm::lang.type')),
                     'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\emailTypes(),
                     'value' => old('email_type', $email->type ?? 'work'),
                     'attributes' => [
                         'disabled' => 'disabled'
                     ]
                  ])
                </div>
            </div>
        </span>
        <h6 class="text-uppercase mt-4"><span class="fa fa-building" aria-hidden="true"></span> {{ ucfirst(__('my-crm::lang.organization')) }}</h6>
        <hr />
        <span class="autocomplete-organisation">
            {{--@include('my-crm::partials.form.text',[
                'name' => 'address',
                'label' => ucfirst(__('my-crm::lang.address')),
                'value' => old('address', $address ?? null)
            ])--}}
            @include('my-crm::partials.form.text',[
               'name' => 'line1',
               'label' => ucfirst(__('my-crm::lang.address_line_1')),
               'value' => old('line1', $address->line1 ?? null),
               'attributes' => [
                    'disabled' => 'disabled'
               ]
            ])
            @include('my-crm::partials.form.text',[
               'name' => 'line2',
               'label' => ucfirst(__('my-crm::lang.address_line_2')),
               'value' => old('line2', $address->line2 ?? null),
               'attributes' => [
                    'disabled' => 'disabled'
               ]
            ])
            @include('my-crm::partials.form.text',[
               'name' => 'line3',
               'label' => ucfirst(__('my-crm::lang.address_line_3')),
               'value' => old('line3', $address->line3 ?? null),
               'attributes' => [
                    'disabled' => 'disabled'
               ]
            ])
            <div class="row">
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                       'name' => 'city',
                       'label' => ucfirst(__('my-crm::lang.suburb')),
                       'value' => old('city', $address->city ?? null),
                       'attributes' => [
                            'disabled' => 'disabled'
                       ]
                    ])
                </div>
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                       'name' => 'state',
                       'label' => ucfirst(__('my-crm::lang.state')),
                       'value' => old('state', $address->state ?? null),
                       'attributes' => [
                            'disabled' => 'disabled'
                       ]
                    ])
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                       'name' => 'code',
                       'label' => ucfirst(__('my-crm::lang.postcode')),
                       'value' => old('code', $address->code ?? null),
                       'attributes' => [
                            'disabled' => 'disabled'
                        ]
                    ])
                </div>
                <div class="col-sm-6">
                    @include('my-crm::partials.form.select',[
                     'name' => 'country',
                     'label' => ucfirst(__('my-crm::lang.country')),
                     'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\countries(),
                     'value' => old('country', $address->country ?? 'United States'),
                     'attributes' => [
                            'disabled' => 'disabled'
                       ]
                  ])
                </div>
            </div>
        </span>
        <h6 class="text-uppercase mt-4 section-h6-title"><span class="fa fa-cart-arrow-down" aria-hidden="true"></span> {{ ucfirst(__('my-crm::lang.products')) }} <span class="float-right"><a href="{{ (isset($deal)) ? url(route('laravel-crm.deal-products.create', $deal)) : url(route('laravel-crm.deal-products.create-product')) }}" class="btn btn-outline-secondary btn-sm btn-action-add-deal-product"><span class="fa fa-plus" aria-hidden="true"></span></a></span></h6>
        <hr />
        <script type="text/javascript">
            let products =  {!! \Kv\MyCrm\Http\Helpers\AutoComplete\products() !!}
        </script>
        <span id="dealProducts">
            @if(isset($deal) && method_exists($deal,'dealProducts'))
                @foreach($deal->dealProducts as $dealProduct)
                    @include('my-crm::deal-products.partials.fields',[
                        'index' => $loop->index
                    ])
                @endforeach
            @endif    
        </span>
    </div>
</div>