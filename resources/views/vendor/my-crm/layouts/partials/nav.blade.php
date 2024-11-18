<div class="card mb-4">
    <div class="card-body py-3 px-2">
        <ul class="nav nav-pills nav-side flex-column">
            <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.dashboard') === 0) ? 'active' : '' }}" aria-current="dashboard" href="{{ url(route('laravel-crm.dashboard')) }}"><i class="fa fa-dashboard"></i> {{ ucfirst(__('my-crm::lang.dashboard')) }}</a></li>
            <li class="dropdown-divider"></li>
            @hasleadsenabled
                <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.leads') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.leads.index')) }}"><i class="fa fa-crosshairs"></i> {{ ucfirst(__('my-crm::lang.leads')) }}</a></li>
            @endhasleadsenabled
            @hasdealsenabled
                <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.deals') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.deals.index')) }}"><i class="fa fa-dollar"></i> {{ ucfirst(__('my-crm::lang.deals')) }}</a></li>
            @endhasdealsenabled
            @hasquotesenabled
                    <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.quotes') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.quotes.index')) }}"><i class="fa fa-file-text"></i> {{ ucfirst(__('my-crm::lang.quotes')) }}</a></li>
            @endhasquotesenabled
                <li class="nav-item"><a class="nav-link {{ Str::contains(Route::currentRouteName(),[
                'laravel-crm.activities',
                'laravel-crm.notes',
                'laravel-crm.tasks',
                'laravel-crm.calls',
                'laravel-crm.meetings',
                'laravel-crm.lunches',
                'laravel-crm.files',
            ]) ? 'active' : '' }}" href="{{ url(route('laravel-crm.activities.index')) }}"><i class="fa fa-tasks"></i> {{ ucfirst(__('my-crm::lang.activity')) }}</a></li>
                <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.tasks') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.tasks.index')) }}">{{ ucfirst(__('my-crm::lang.tasks')) }}</a></li>
                <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.notes') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.notes.index')) }}">{{ ucfirst(__('my-crm::lang.notes')) }}</a></li>
                <li class="dropdown-divider"></li>
            @hasordersenabled
                    <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.orders') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.orders.index')) }}"><i class="fa fa-shopping-cart"></i> {{ ucwords(__('my-crm::lang.orders')) }}</a></li>
            @endhasordersenabled
              
            @hasinvoicesenabled
                <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.invoices') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.invoices.index')) }}"><i class="fa fa-file-invoice"></i> {{ ucfirst(__('my-crm::lang.invoices')) }}</a></li>
            @endhasinvoicesenabled
            @hasdeliveriesenabled
                    <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.deliveries') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.deliveries.index')) }}"><i class="fa fa-shipping-fast"></i> {{ ucfirst(__('my-crm::lang.deliveries')) }}</a></li>
            @endhasdeliveriesenabled
            @haspurchaseordersenabled
                <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.purchase-order') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.purchase-orders.index')) }}"><i class="fa fa-file-invoice-dollar"></i> {{ ucwords(__('my-crm::lang.purchase_orders')) }}</a></li>
            @endhaspurchaseordersenabled
            <li class="dropdown-divider"></li>
                <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.clients') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.clients.index')) }}"><i class="fa fa-address-card"></i> {{ ucfirst(__('my-crm::lang.clients')) }}</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.organisations') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.organisations.index')) }}"><i class="fa fa-building"></i> {{ ucfirst(__('my-crm::lang.organizations')) }}</a></li>
                <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.people') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.people.index')) }}"><i class="fa fa-user-circle"></i> {{ ucfirst(__('my-crm::lang.people')) }}</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.users') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.users.index')) }}"><i class="fa fa-user"></i> {{ ucfirst(__('my-crm::lang.users')) }}</a></li>
            @hasteamsenabled
            <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.teams') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.teams.index')) }}"><i class="fa fa-users"></i> {{ ucfirst(__('my-crm::lang.teams')) }}</a></li>
            @endhasteamsenabled
                <li class="dropdown-divider"></li>
            {{-- <li class="nav-item"><a class="nav-link" href="#">{{ ucfirst(__('my-crm::lang.email')) }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ ucfirst(__('my-crm::lang.documents')) }}</a></li>--}}
            <li class="nav-item"><a class="nav-link {{ (strpos(Route::currentRouteName(), 'laravel-crm.products') === 0) ? 'active' : '' }}" href="{{ url(route('laravel-crm.products.index')) }}"><i class="fa fa-tag"></i> {{ ucfirst(__('my-crm::lang.products')) }}</a></li>
            {{--<li class="nav-item"><a class="nav-link" href="#">{{ ucfirst(__('my-crm::lang.subscriptions')) }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ ucfirst(__('my-crm::lang.invoices')) }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ ucfirst(__('my-crm::lang.payments')) }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ ucfirst(__('my-crm::lang.reports')) }}</a></li>--}}
                <li class="dropdown-divider"></li>
            <li class="nav-item"><a class="nav-link {{ Str::contains(Route::currentRouteName(),[
                'laravel-crm.settings',
                'laravel-crm.roles',
                'laravel-crm.product-categories',
                'laravel-crm.labels',
                'laravel-crm.fields',
                'laravel-crm.integrations',
            ]) ? 'active' : '' }}" href="{{ url(route('laravel-crm.settings.edit')) }}"><i class="fa fa-cog"></i> {{ ucfirst(__('my-crm::lang.settings')) }}</a></li>
            <li class="nav-item"><a class="nav-link {{ Str::contains(Route::currentRouteName(),['laravel-crm.updates']) ? 'active' : '' }}" href="{{ url(route('laravel-crm.updates.index')) }}"><i class="fa fa-cloud-download"></i> {{ ucfirst(__('my-crm::lang.updates')) }}</a></li>
        </ul>
    </div>
</div>
