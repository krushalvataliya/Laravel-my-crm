@extends('my-crm::layouts.app')

@section('content')

<form method="POST" action="{{ url(route('laravel-crm.pipeline-stages.store')) }}">
    @csrf
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col col-md-2">
                <div class="card">
                    <div class="card-body py-3 px-2">
                        @include('my-crm::layouts.partials.nav-settings')
                    </div>
                </div>
            </div>
            <div class="col col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-left m-0"> {{ ucfirst(trans('my-crm::lang.create_pipeline_stage')) }}</h3>
                        <span class="float-right"><a type="button" class="btn btn-outline-secondary btn-sm" href="{{ url(route('laravel-crm.pipeline-stages.index')) }}"><span class="fa fa-angle-double-left"></span> {{ ucfirst(trans('my-crm::lang.back_to_pipeline_stages')) }}</a></span>
                    </div>
                    <div class="card-body">
                        @include('my-crm::pipeline-stages.partials.fields')
                    </div>
                    @component('my-crm::components.card-footer')
                        <a href="{{ url(route('laravel-crm.pipeline-stages.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(trans('my-crm::lang.cancel')) }}</a>
                        <button type="submit" class="btn btn-primary">{{ ucwords(trans('my-crm::lang.save')) }}</button>
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</form>
    
@endsection