@extends('my-crm::layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            @include('my-crm::layouts.partials.nav-activities')
        </div>
        <div class="card-body">
            <h3 class="mb-3"> {{ ucfirst(__('my-crm::lang.lunches')) }}</h3>
            @if($lunches && $lunches->count() > 0)
                @foreach($lunches as $lunch)
                    @livewire('lunch',[
                        'lunch' => $lunch
                    ], key($lunch->id))
                @endforeach
            @endif
        </div>
        @if($lunches instanceof \Illuminate\Pagination\LengthAwarePaginator )
            <div class="card-footer">
                {{ $lunches->links() }}
            </div>
        @endif
    </div>

@endsection