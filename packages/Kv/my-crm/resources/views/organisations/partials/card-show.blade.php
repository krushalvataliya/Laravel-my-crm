@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ $organisation->name }} <small>@include('my-crm::partials.labels',[
                            'labels' => $organisation->labels
                    ])</small>
        @endslot

        @slot('actions')
            <span class="float-right">
                @include('my-crm::partials.return-button',[
                    'model' => $organisation,
                    'route' => 'organisations'
                ]) | 
                @hasleadsenabled
                @can('create crm leads')
                    <a href="{{ route('laravel-crm.leads.create', ['model' => 'organisation', 'id' => $organisation->id]) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-arrow-right" aria-hidden="true"></span> <span class="fa fa-crosshairs" aria-hidden="true"></span></a>
                @endcan
                @endhasleadsenabled
                @hasdealsenabled
                @can('create crm deals')
                    <a href="{{ route('laravel-crm.deals.create', ['model' => 'organisation', 'id' => $organisation->id]) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-arrow-right" aria-hidden="true"></span> <span class="fa fa-dollar" aria-hidden="true"></span></a>
                @endcan
                @endhasdealsenabled
                @hasquotesenabled
                @can('create crm quotes')
                    <a href="{{ route('laravel-crm.quotes.create', ['model' => 'organisation', 'id' => $organisation->id]) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-arrow-right" aria-hidden="true"></span> <span class="fa fa-file-text" aria-hidden="true"></span></a>
                @endcan
                @endhasquotesenabled
                @hasordersenabled
                @can('create crm orders')
                    <a href="{{ route('laravel-crm.orders.create', ['model' => 'organisation', 'id' => $organisation->id]) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-arrow-right" aria-hidden="true"></span> <span class="fa fa-shopping-cart" aria-hidden="true"></span></a>
                @endcan
                @endhasordersenabled
                @include('my-crm::partials.navs.activities') | 
                @can('edit crm organisations')
                <a href="{{ url(route('laravel-crm.organisations.edit', $organisation)) }}" type="button" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                @endcan
                @can('delete crm organisations')
                <form action="{{ route('laravel-crm.organisations.destroy',$organisation) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('my-crm::lang.organization') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                </form>
                @endcan    
            </span>
        @endslot

    @endcomponent

    @component('my-crm::components.card-body')

        <div class="row">
            <div class="col-sm-6 border-right">
                <h6 class="text-uppercase">{{ ucfirst(__('my-crm::lang.details')) }}</h6>
                <hr />
                <dl class="row">
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.name')) }}</dt>
                    <dd class="col-sm-9">{{ $organisation->name }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.type')) }}</dt>
                    <dd class="col-sm-9">{{ $organisation->organisationType->name ?? null }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.vat_number')) }}</dt>
                    <dd class="col-sm-9">{{ $organisation->vat_number }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.industry')) }}</dt>
                    <dd class="col-sm-9">{{ $organisation->industry->name ?? null }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.timezone')) }}</dt>
                    <dd class="col-sm-9">{{ $organisation->timezone->name ?? null }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.number_of_employees')) }}</dt>
                    <dd class="col-sm-9">{{ $organisation->number_of_employees }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.annual_revenue')) }}</dt>
                    <dd class="col-sm-9">{{ money($organisation->annual_revenue, $organisation->currency) }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.linkedin')) }}</dt>
                    <dd class="col-sm-9">https://linkedin.com/company/{{ $organisation->linkedin }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.description')) }}</dt>
                    <dd class="col-sm-9">{{ $organisation->description }}</dd>
                    @foreach($phones as $phone)
                        <dt class="col-sm-3 text-right">{{ ucfirst($phone->type) }} {{ ucfirst(__('my-crm::lang.phone')) }}</dt>
                        <dd class="col-sm-9">
                            <a href="tel:{{ $phone->number }}">{{ $phone->number }}</a> {{ ($phone->primary) ? '(Primary)' : null }}
                        </dd>
                    @endforeach
                    @foreach($emails as $email)
                        <dt class="col-sm-3 text-right">{{ ucfirst($email->type) }} {{ ucfirst(__('my-crm::lang.email')) }}</dt>
                        <dd class="col-sm-9">
                            <a href="mailto:{{ $email->address }}">{{ $email->address }}</a> {{ ($email->primary) ? '(Primary)' : null }}
                        </dd>
                    @endforeach
                    @foreach($addresses as $address)
                        <dt class="col-sm-3 text-right">{{ ($address->addressType) ? ucfirst($address->addressType->name).' ' : null }}{{ ucfirst(__('my-crm::lang.address')) }}</dt>
                        <dd class="col-sm-9">
                            {{ \Kv\MyCrm\Http\Helpers\AddressLine\addressSingleLine($address) }} {{ ($address->primary) ? '(Primary)' : null }}
                        </dd>
                    @endforeach
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.integrations')) }}</dt>
                    <dd class="col-sm-9">@if($organisation->xeroContact)<img src="/vendor/laravel-crm/img/xero-icon.png" height="20" />@endif</dd>
                </dl>
                <h6 class="text-uppercase mt-4">{{ ucfirst(__('my-crm::lang.owner')) }}</h6>
                <hr />
                <dl class="row">
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.name')) }}</dt>
                    <dd class="col-sm-9">
                        @if($organisation->ownerUser)<a href="{{ route('laravel-crm.users.show', $organisation->ownerUser) }}">{{ $organisation->ownerUser->name ?? null }}</a> @else  {{ ucfirst(__('my-crm::lang.unallocated')) }} @endif
                    </dd>
                </dl>
                @livewire('related-contact-people',[
                    'model' => $organisation
                ])
                @livewire('related-contact-organisations',[
                    'model' => $organisation
                ])
                @can('view crm deals')
                    <h6 class="text-uppercase mt-4 section-h6-title"><span>{{ ucfirst(__('my-crm::lang.deals')) }} ({{ $organisation->deals->count() }})</span>@can('create crm deals')<span class="float-right"><a href="{{ url(route('laravel-crm.deals.create',['model' => 'organisation', 'id' => $organisation->id])) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-plus" aria-hidden="true"></span></a></span>@endcan</h6>
                    <hr />
                    @foreach($organisation->deals as $deal)
                        <p>{{ $deal->title }}<br />
                            <small>{{ money($deal->amount, $deal->currency) }}</small></p>
                    @endforeach
                @endcan
            </div>
            <div class="col-sm-6">
                @include('my-crm::partials.activities', [
                    'model' => $organisation
                ])
            </div>
        </div>

    @endcomponent

@endcomponent    