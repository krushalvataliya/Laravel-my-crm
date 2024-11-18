<form method="POST" action="{{ url(route('laravel-crm.invoices.update', $invoice)) }}">
    @csrf
    @method('PUT')
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.edit_invoice')) }}
            @endslot

            @slot('actions')
                @include('my-crm::partials.return-button',[
                    'model' => $invoice,
                    'route' => 'invoices'
                ])
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

            @include('my-crm::invoices.partials.fields')

        @endcomponent

        @component('my-crm::components.card-footer')
            <a href="{{ url(route('laravel-crm.invoices.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
            <button type="submit" class="btn btn-primary">{{ ucwords(__('my-crm::lang.save_changes')) }}</button>
        @endcomponent

    @endcomponent
</form>
