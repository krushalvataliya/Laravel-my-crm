<form method="POST" action="{{ url(route('laravel-crm.leads.store')) }}">
    @csrf
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.create_lead')) }}
            @endslot

            @slot('actions')
                @include('my-crm::partials.return-button',[
                    'model' => new \Kv\MyCrm\Models\Lead(),
                    'route' => 'leads'
                ])
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

            @include('my-crm::leads.partials.fields')

        @endcomponent

        @component('my-crm::components.card-footer')
            <a href="{{ url(route('laravel-crm.leads.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
            <button type="submit" class="btn btn-primary">{{ ucfirst(__('my-crm::lang.save')) }}</button>
        @endcomponent

    @endcomponent
</form>