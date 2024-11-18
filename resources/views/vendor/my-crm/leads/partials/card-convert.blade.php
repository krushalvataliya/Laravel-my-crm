<form method="POST" action="{{ url(route('laravel-crm.leads.store-as-deal', $lead)) }}">
    @csrf
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.convert_lead_to_deal')) }}
            @endslot

            @slot('actions')
                    <span class="float-right">
                    <a type="button" class="btn btn-outline-secondary btn-sm" href="{{ url(route('laravel-crm.leads.index')) }}"><span class="fa fa-angle-double-left"></span> {{ ucfirst(__('my-crm::lang.back_to_leads')) }}</a></span>
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

            @include('my-crm::deals.partials.fields', [
                  'deal' => $lead,
                  'lead' => $lead
             ])

        @endcomponent

        @component('my-crm::components.card-footer')
                <a href="{{ url(route('laravel-crm.leads.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
                <button type="submit" class="btn btn-primary">{{ ucfirst(__('my-crm::lang.save')) }}</button>
        @endcomponent

    @endcomponent
</form>