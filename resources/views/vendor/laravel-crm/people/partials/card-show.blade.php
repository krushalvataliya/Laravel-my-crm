@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ $person->name }} <small>@include('my-crm::partials.labels',[
                            'labels' => $person->labels
                    ])</small>
        @endslot

        @slot('actions')
            <span class="float-right">
                @include('my-crm::partials.return-button',[
                    'model' => $person,
                    'route' => 'people'
                ]) | 
                @hasleadsenabled
                @can('create crm leads')
                    <a href="{{ route('laravel-crm.leads.create', ['model' => 'person', 'id' => $person->id]) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-arrow-right" aria-hidden="true"></span> <span class="fa fa-crosshairs" aria-hidden="true"></span></a>
                @endcan
                @endhasleadsenabled
                @hasdealsenabled
                @can('create crm deals')
                    <a href="{{ route('laravel-crm.deals.create', ['model' => 'person', 'id' => $person->id]) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-arrow-right" aria-hidden="true"></span> <span class="fa fa-dollar" aria-hidden="true"></span></a>
                @endcan
                @endhasdealsenabled
                @hasquotesenabled
                @can('create crm quotes')
                    <a href="{{ route('laravel-crm.quotes.create', ['model' => 'person', 'id' => $person->id]) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-arrow-right" aria-hidden="true"></span> <span class="fa fa-file-text" aria-hidden="true"></span></a>
                @endcan
                @endhasquotesenabled
                @hasordersenabled
                @can('create crm orders')
                    <a href="{{ route('laravel-crm.orders.create', ['model' => 'person', 'id' => $person->id]) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-arrow-right" aria-hidden="true"></span> <span class="fa fa-shopping-cart" aria-hidden="true"></span></a>
                @endcan
                @endhasordersenabled
                @include('my-crm::partials.navs.activities') |
                @can('edit crm people')
                <a href="{{ url(route('laravel-crm.people.edit', $person)) }}" type="button" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                @endcan
                @can('delete crm people')
                <form action="{{ route('laravel-crm.people.destroy',$person) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('my-crm::lang.person') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
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
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.first_name')) }}</dt>
                    <dd class="col-sm-9">{{ $person->first_name }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.middle_name')) }}</dt>
                    <dd class="col-sm-9">{{ $person->middle_name }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.last_name')) }}</dt>
                    <dd class="col-sm-9">{{ $person->last_name }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.gender')) }}</dt>
                    <dd class="col-sm-9">{{ ucfirst($person->gender) }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.birthday')) }}</dt>
                    <dd class="col-sm-9">{{ $person->birthday }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.description')) }}</dt>
                    <dd class="col-sm-9">{{ $person->description }}</dd>
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
                </dl>
                <h6 class="text-uppercase mt-4">{{ ucfirst(__('my-crm::lang.owner')) }}</h6>
                <hr />
                <dl class="row">
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.name')) }}</dt>
                    <dd class="col-sm-9">
                        @if($person->ownerUser)<a href="{{ route('laravel-crm.users.show', $person->ownerUser) }}">{{ $person->ownerUser->name ?? null }}</a> @else  {{ ucfirst(__('my-crm::lang.unallocated')) }} @endif
                    </dd>
                </dl>
                @livewire('related-contact-people',[
                    'model' => $person
                ])
                @livewire('related-contact-organisations',[
                    'model' => $person
                ])
                @can('view crm deals')
                    <h6 class="text-uppercase mt-4 section-h6-title"><span>{{ ucfirst(__('my-crm::lang.deals')) }} ({{ $person->deals->count() }})</span>@can('create crm deals')<span class="float-right"><a href="{{ url(route('laravel-crm.deals.create',['model' => 'person', 'id' => $person->id])) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-plus" aria-hidden="true"></span></a></span>@endcan</h6>
                    <hr />
                    @foreach($person->deals as $deal)
                        <p>{{ $deal->title }}<br />
                            <small>{{ money($deal->amount, $deal->currency) }}</small></p>
                    @endforeach
                @endcan
            </div>
            <div class="col-sm-6">
                @include('my-crm::partials.activities', [
                    'model' => $person
                ])
            </div>
        </div>
        
    @endcomponent    

@endcomponent    