@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ ucfirst(__('my-crm::lang.leads')) }}
        @endslot

        @slot('actions') 
            @include('my-crm::partials.view-types', [
                'model' => 'leads', 
            ])
            @include('my-crm::partials.filters', [
                'action' => route('laravel-crm.leads.filter'),
                'model' => '\Kv\MyCrm\Models\Lead'
            ])
            @can('create crm leads')
               <a type="button" class="btn btn-primary btn-sm" href="{{ url(route('laravel-crm.leads.create')) }}"><span class="fa fa-plus"></span>  {{ ucfirst(__('my-crm::lang.add_lead')) }}</a>
            @endcan
        @endslot

    @endcomponent

    @component('my-crm::components.card-table')

        <livewire:live-lead-board :leads="$leads" />

    @endcomponent

@endcomponent
