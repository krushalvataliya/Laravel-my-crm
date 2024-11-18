<form method="POST" action="{{ url(route('laravel-crm.people.store')) }}">
    @csrf
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.create_person')) }}
            @endslot

            @slot('actions')
                @include('my-crm::partials.return-button',[
                    'model' => new \Kv\MyCrm\Models\Person(),
                    'route' => 'people'
                ])
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')
            
                @include('my-crm::people.partials.fields')
            
        @endcomponent
        
        @component('my-crm::components.card-footer')
                <a href="{{ url(route('laravel-crm.people.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
                <button type="submit" class="btn btn-primary">{{ ucfirst(__('my-crm::lang.save')) }}</button>
        @endcomponent
        
    @endcomponent
</form>