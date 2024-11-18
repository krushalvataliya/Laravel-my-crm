@if(empty($order))
<form method="POST" action="{{ url(route('laravel-crm.purchase-orders.store')) }}">
@else
<form method="POST" action="{{ url(route('laravel-crm.purchase-orders.store')) }}?order={{ $order->id }}">     
@endif        
    
    @csrf
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.create_purchase_order')) }}@isset($order)(s) {{ __('my-crm::lang.from_order') }} <a href="{{ route('laravel-crm.orders.show', $order) }}">{{ $order->order_id }}</a> @endisset
            @endslot

            @slot('actions')
                @include('my-crm::partials.return-button',[
                    'model' => new \Kv\MyCrm\Models\PurchaseOrder(),
                    'route' => 'purchase-orders',
                    'text' => 'back_to_purchase_orders'
                ])
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

            @include('my-crm::purchase-orders.partials.fields')

        @endcomponent

        @component('my-crm::components.card-footer')
                <a href="{{ url(route('laravel-crm.purchase-orders.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
                <button type="submit" class="btn btn-primary" name="action" value="create_and_add_another">{{ ucfirst(__('my-crm::lang.create_and_add_another')) }}</button>
                <button type="submit" class="btn btn-primary" name="action">{{ ucfirst(__('my-crm::lang.create_purchase_order')) }}</button>
        @endcomponent

    @endcomponent
</form>