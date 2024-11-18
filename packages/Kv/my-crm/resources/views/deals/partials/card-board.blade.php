@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ ucfirst(__('my-crm::lang.deals')) }}
        @endslot

        @slot('actions') 
            @include('my-crm::partials.view-types', [
                'model' => 'deals', 
            ])
            @include('my-crm::partials.filters', [
                'action' => route('laravel-crm.deals.filter'),
                'model' => '\Kv\MyCrm\Models\Deal'
            ])
            @can('create crm deals')
               <a type="button" class="btn btn-primary btn-sm" href="{{ url(route('laravel-crm.deals.create')) }}"><span class="fa fa-plus"></span>  {{ ucfirst(__('my-crm::lang.add_deal')) }}</a>
            @endcan
        @endslot

    @endcomponent

    @component('my-crm::components.card-table')
        
        <livewire:live-deal-board :deals="$deals" />

    @endcomponent

@endcomponent
