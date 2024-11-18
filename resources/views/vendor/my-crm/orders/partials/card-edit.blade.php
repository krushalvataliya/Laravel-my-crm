<form method="POST" action="{{ url(route('laravel-crm.orders.update', $order)) }}">
    @csrf
    @method('PUT')
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.edit_order')) }}
            @endslot

            @slot('actions')
                @include('my-crm::partials.return-button',[
                    'model' => $order,
                    'route' => 'orders'
                ])
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

            @include('my-crm::orders.partials.fields')

        @endcomponent

        @component('my-crm::components.card-footer')
            <a href="{{ url(route('laravel-crm.orders.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
            <button type="submit" class="btn btn-primary">{{ ucwords(__('my-crm::lang.save_changes')) }}</button>
        @endcomponent

    @endcomponent
</form>
