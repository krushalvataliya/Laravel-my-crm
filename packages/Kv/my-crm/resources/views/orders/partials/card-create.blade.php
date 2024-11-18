<form method="POST" action="{{ url(route('laravel-crm.orders.store')) }}">
    @csrf
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.create_order')) }} @isset($quote){{ __('my-crm::lang.from_quote') }} <a href="{{ route('laravel-crm.quotes.show', $quote) }}">{{ $quote->quote_id }}</a> @endisset
            @endslot

            @slot('actions')
                @if(isset($quote))
                    @include('my-crm::partials.return-button',[
                        'model' => new \Kv\MyCrm\Models\Quote(),
                        'route' => 'quotes'
                    ])
                @else    
                    @include('my-crm::partials.return-button',[
                        'model' => new \Kv\MyCrm\Models\Order(),
                        'route' => 'orders'
                    ])
                @endif    
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

            @include('my-crm::orders.partials.fields')

        @endcomponent

        @component('my-crm::components.card-footer')
                <a href="{{ url(route('laravel-crm.orders.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
                <button type="submit" class="btn btn-primary">{{ ucfirst(__('my-crm::lang.save')) }}</button>
        @endcomponent

    @endcomponent
</form>
