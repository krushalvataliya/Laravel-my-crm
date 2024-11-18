<ul class="nav nav-pills flex-column" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.settings') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.settings.edit')) }}" role="tab" aria-controls="settings" aria-selected="true">{{ ucwords(__('my-crm::lang.general_settings')) }}</a>
    </li>
        <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.roles') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.roles.index')) }}" role="tab" aria-controls="roles" aria-selected="false">{{ ucwords(__('my-crm::lang.roles_and_permissions')) }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.pipelines') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.pipelines.index')) }}" role="tab" aria-controls="pipelines" aria-selected="false">{{ ucwords(__('my-crm::lang.pipelines')) }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.pipeline-stages') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.pipeline-stages.index')) }}" role="tab" aria-controls="pipeline-stages" aria-selected="false">{{ ucwords(__('my-crm::lang.pipeline_stages')) }}</a>
        </li>
    <li class="nav-item">
        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.product-categories') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.product-categories.index')) }}" role="product-categories" aria-controls="product-categories" aria-selected="false">{{ ucwords(__('my-crm::lang.product_categories')) }}</a>
    </li>
        <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.product-attributes') === 0) ? 'active' : '' }}" href="#" role="product-attributes" aria-controls="product-attributes" aria-selected="false">{{ ucwords(__('my-crm::lang.product_attributes')) }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.tax-rates') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.tax-rates.index')) }}" role="tax-rates" aria-controls="tax-rates" aria-selected="false">{{ ucwords(__('my-crm::lang.tax_rates')) }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.labels') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.labels.index')) }}" role="tab" aria-controls="labels" aria-selected="false">{{ ucwords(__('my-crm::lang.labels')) }}</a>
        </li>
       <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.fields') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.fields.index')) }}" role="tab" aria-controls="fields" aria-selected="false">{{ ucwords(__('my-crm::lang.custom_fields')) }}</a>
       </li>
        <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.field-groups') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.field-groups.index')) }}" role="tab" aria-controls="field-groups" aria-selected="false">{{ ucwords(__('my-crm::lang.custom_field_groups')) }}</a>
        </li>
    <li class="nav-item">
        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.integrations.xero') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.integrations.xero')) }}" role="tab" aria-controls="integrations" aria-selected="false">{{ ucwords(__('my-crm::lang.integrations')) }}</a>
    </li>
</ul>