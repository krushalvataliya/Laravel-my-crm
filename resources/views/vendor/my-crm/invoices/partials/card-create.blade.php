<form method="POST" action="{{ url(route('laravel-crm.invoices.store')) }}">
    @csrf
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.create_invoice')) }} @isset($order){{ __('my-crm::lang.from_order') }} <a href="{{ route('laravel-crm.orders.show', $order) }}">{{ $order->order_id }}</a> @endisset
            @endslot

            @slot('actions')
                @include('my-crm::partials.return-button',[
                    'model' => new \Kv\MyCrm\Models\Invoice(),
                    'route' => 'invoices'
                ])
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

            @include('my-crm::invoices.partials.fields')

        @endcomponent

        @component('my-crm::components.card-footer')
                <a href="{{ url(route('laravel-crm.invoices.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
                <button type="submit" class="btn btn-primary">{{ ucfirst(__('my-crm::lang.save')) }}</button>
        @endcomponent

    @endcomponent
</form>
