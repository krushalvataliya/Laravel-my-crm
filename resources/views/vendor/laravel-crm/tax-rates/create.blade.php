@extends('my-crm::layouts.app')

@section('content')

    <form method="POST" action="{{ url(route('laravel-crm.tax-rates.store')) }}">
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
                            <h3 class="card-title float-left m-0">{{ ucfirst(trans('my-crm::lang.add_tax_rate')) }}</h3>
                            <span class="float-right"><a type="button" class="btn btn-outline-secondary btn-sm" href="{{ url(route('laravel-crm.tax-rates.index')) }}"><span class="fa fa-angle-double-left"></span> {{ ucfirst(trans('my-crm::lang.back_to_tax_rates')) }}</a></span>
                        </div>
                        <div class="card-body">
                            @include('my-crm::tax-rates.partials.fields')
                        </div>
                        @component('my-crm::components.card-footer')
                            <a href="{{ url(route('laravel-crm.tax-rates.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(trans('my-crm::lang.cancel')) }}</a>
                            <button type="submit" class="btn btn-primary">{{ ucfirst(trans('my-crm::lang.save')) }}</button>
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection