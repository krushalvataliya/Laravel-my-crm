@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ ucfirst(__('my-crm::lang.quotes')) }}
        @endslot

        @slot('actions') 
            @include('my-crm::partials.view-types', [
                'model' => 'quotes', 
            ])
            @include('my-crm::partials.filters', [
                'action' => route('laravel-crm.quotes.filter'),
                'model' => '\Kv\MyCrm\Models\Quote'
            ])
            @can('create crm quotes')
               <a type="button" class="btn btn-primary btn-sm" href="{{ url(route('laravel-crm.quotes.create')) }}"><span class="fa fa-plus"></span>  {{ ucfirst(__('my-crm::lang.add_quote')) }}</a>
            @endcan
        @endslot

    @endcomponent

    @component('my-crm::components.card-table')
        
        <livewire:live-quote-board :quotes="$quotes" />

    @endcomponent

@endcomponent
