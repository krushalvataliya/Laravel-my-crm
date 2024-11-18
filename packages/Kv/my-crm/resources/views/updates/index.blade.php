@extends('my-crm::layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"><h3 class="card-title m-0">Laravel CRM {{ ucfirst(__('my-crm::lang.updates')) }}</h3></div>
        <div class="card-body">
            <p class="card-text">{{ ucfirst(__('my-crm::lang.current_version')) }} {{ \Kv\MyCrm\Models\Setting::where('name','version')->first()->value }} {{ (\Kv\MyCrm\Models\Setting::where('name','version')->first()->value == \Kv\MyCrm\Models\Setting::where('name','version_latest')->first()->value) ? __('my-crm::lang.is_the_latest_version') : null }}</p>
            @if(\Kv\MyCrm\Models\Setting::where('name','version')->first()->value < \Kv\MyCrm\Models\Setting::where('name','version_latest')->first()->value)
                <hr />
                <h5 class="mb-4">{{ ucfirst(__('my-crm::lang.updated_version_of_laravel_crm_is_available')) }}</h5>
                <p class="card-text">{{ ucfirst(__('my-crm::lang.you_can_update_from_laravel_crm')) }} {{ \Kv\MyCrm\Models\Setting::where('name','version')->first()->value }} to {{ \Kv\MyCrm\Models\Setting::where('name','version_latest')->first()->value }}</p>
                <a type="button" class="btn btn-primary btn-sm" href="https://github.com/venturedrake/laravel-crm" target="_blank">{{ ucfirst(__('my-crm::lang.upgrade_guide')) }}</a>
            @endif    
        </div>
    </div>

@endsection