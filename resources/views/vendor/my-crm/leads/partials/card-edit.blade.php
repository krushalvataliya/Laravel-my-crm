<form method="POST" action="{{ url(route('laravel-crm.leads.update', $lead)) }}">
    @csrf
    @method('PUT')
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.edit_lead')) }}
            @endslot

            @slot('actions')
                @include('my-crm::partials.return-button',[
                   'model' => $lead,
                   'route' => 'leads'
               ])
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

            @include('my-crm::leads.partials.fields', [
                'generateTitle' => false
            ])

        @endcomponent

        @component('my-crm::components.card-footer')
            <a href="{{ url(route('laravel-crm.leads.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
            <button type="submit" class="btn btn-primary">{{ ucwords(__('my-crm::lang.save_changes')) }}</button>
        @endcomponent

    @endcomponent
</form>