<div class="row">
    <div class="col-sm-5 border-right">
        @include('my-crm::partials.form.hidden',[
             'name' => 'lead_id',
             'value' => old('lead_id', $order->lead->id ?? $quote->lead->id ?? $lead->id ?? null),
        ])

        @include('my-crm::partials.form.hidden',[
             'name' => 'quote_id',
             'value' => old('quote_id', $order->quote->id ?? $quote->id ?? null),
        ])

        @if(isset($quote))

            @include('my-crm::partials.form.hidden',[
                'name' => 'client_id',
                'value' => old('client_id', $order->client->id ?? $quote->client->id ?? null),
            ])

            @include('my-crm::partials.form.hidden',[
                'name' => 'person_id',
                'value' => old('person_id', $order->person->id ?? $quote->person->id ?? null),
            ])

            @include('my-crm::partials.form.hidden',[
                'name' => 'organisation_id',
                'value' => old('organisation_id', $order->organisation->id ?? $quote->organisation->id ?? null),
            ])

            <h6 class="text-uppercase">{{ ucfirst(__('my-crm::lang.client')) }}</h6>
            <hr />
            <p><span class="fa fa-address-card" aria-hidden="true"></span> @if($quote->client)<a href="{{ route('laravel-crm.clients.show',$quote->client) }}">{{ $quote->client->name }}</a>@endif </p>
            <h6 class="mt-4 text-uppercase">{{ ucfirst(__('my-crm::lang.organization')) }}</h6>
            <hr />
            <p><span class="fa fa-building" aria-hidden="true"></span> @if($quote->organisation)<a href="{{ route('laravel-crm.organisations.show',$quote->organisation) }}">{{ $quote->organisation->name }}</a>@endif</p>
            <h6 class="mt-4 text-uppercase">{{ ucfirst(__('my-crm::lang.contact_person')) }}</h6>
            <hr />
            <p><span class="fa fa-user" aria-hidden="true"></span> @if($quote->person)<a href="{{ route('laravel-crm.people.show',$quote->person) }}">{{ $quote->person->name }}</a>@endif </p>
            <h6 class="mt-4 text-uppercase">{{ ucfirst(__('my-crm::lang.details')) }}</h6>
            <hr />
            
        @else

            @livewire('order-form',[
            'order' => $order ?? null,
            'client' => $client ?? null,
            'organisation' => $organisation ?? null,
            'person' => $person ?? null
            ])
            
        @endif    
        
        @include('my-crm::partials.form.textarea',[
             'name' => 'description',
             'label' => ucfirst(__('my-crm::lang.description')),
             'rows' => 5,
             'value' => old('description', $order->description ?? $quote->description ?? null)
        ])
        <div class="row">
            <div class="col-sm-6">
                @include('my-crm::partials.form.text',[
                      'name' => 'reference',
                      'label' => ucfirst(__('my-crm::lang.reference')),
                      'value' => old('amount', $order->reference ?? $quote->reference  ?? null)
                  ])
            </div>
            <div class="col-sm-6">
                @include('my-crm::partials.form.select',[
                    'name' => 'currency',
                    'label' => ucfirst(__('my-crm::lang.currency')),
                    'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\currencies(),
                    'value' => old('currency', $order->currency ?? $quote->currency ?? \Kv\MyCrm\Models\Setting::currency()->value ?? 'USD')
                ])
            </div>
        </div>
        
        @include('my-crm::partials.form.multiselect',[
            'name' => 'labels',
            'label' => ucfirst(__('my-crm::lang.labels')),
            'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel(\Kv\MyCrm\Models\Label::all(), false),
            'value' =>  old('labels', (isset($order)) ? $order->labels->pluck('id')->toArray() : null)
        ])
        
        @include('my-crm::partials.form.select',[
             'name' => 'user_owner_id',
             'label' => ucfirst(__('my-crm::lang.owner')),
             'options' => ['' => ucfirst(__('my-crm::lang.unallocated'))] + \Kv\MyCrm\Http\Helpers\SelectOptions\users(false),
             'value' =>  old('user_owner_id', (isset($order)) ? $order->user_owner_id ?? '' : auth()->user()->id), 
          ])

        @include('my-crm::fields.partials.model', ['model' => $order ?? new \Kv\MyCrm\Models\Order()])

        @livewire('address-edit', [
            'addresses' => $addresses ?? null,
            'old' => old('addresses'),
            'model' => 'order'
        ])
    </div>
    <div class="col-sm-7">
        
        @livewire('order-items',[
            'order' => $order ?? null,
            'products' => $order->orderProducts ?? $quote->quoteProducts ?? null,
            'old' => old('products'),
            'fromQuote' => (isset($quote)) ? $quote : false
        ])
    </div>
</div>
