@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ $delivery->title }}
        @endslot

        @slot('actions')
            <span class="float-right">
                @include('my-crm::partials.return-button',[
                    'model' => $delivery,
                    'route' => 'deliveries'
                ]) | 
                @can('view crm deliveries')
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('laravel-crm.deliveries.download', $delivery) }}">{{ ucfirst(__('my-crm::lang.download')) }}</a>
                @endcan
                @include('my-crm::partials.navs.activities') |
                @can('edit crm deliveries')
                    <a href="{{ url(route('laravel-crm.deliveries.edit', $delivery)) }}" type="button" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                @endcan
                @can('delete crm deliveries')
                    <form action="{{ route('laravel-crm.deliveries.destroy', $delivery) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                    {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('my-crm::lang.delivery') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                </form>
                @endcan
            </span>
        @endslot

    @endcomponent

    @component('my-crm::components.card-body')

        <div class="row card-show card-fa-w30">
            <div class="col-sm-6 bdelivery-right">
                <h6 class="text-uppercase">{{ ucfirst(__('my-crm::lang.details')) }}</h6>
                <hr />
                <dl class="row">
                    <dt class="col-sm-4 text-right">{{ ucfirst(__('my-crm::lang.number')) }}</dt>
                    <dd class="col-sm-8">
                        {{ $delivery->delivery_id }}
                    </dd>
                    @hasordersenabled
                    <dt class="col-sm-4 text-right">{{ ucfirst(__('my-crm::lang.reference')) }}</dt>
                    <dd class="col-sm-8">
                        @if($delivery->order)
                            {{ $delivery->order->reference }}
                        @endif
                    </dd>
                    <dt class="col-sm-4 text-right">{{ ucfirst(__('my-crm::lang.order')) }}</dt>
                    <dd class="col-sm-8">
                        @if($delivery->order)
                            <a href="{{ route('laravel-crm.orders.show', $delivery->order) }}">{{ $delivery->order->order_id }}</a>
                        @endif
                    </dd>
                    @endhasordersenabled
                    <dt class="col-sm-4 text-right">{{ ucfirst(__('my-crm::lang.delivery_expected')) }}</dt>
                    <dd class="col-sm-8">
                        {{ $delivery->delivery_expected  ?? null }}
                    </dd>
                    <dt class="col-sm-4 text-right">{{ ucfirst(__('my-crm::lang.delivered_on')) }}</dt>
                    <dd class="col-sm-8">
                        {{ $delivery->delivered_on  ?? null }}
                    </dd>
                   @foreach($addresses as $address)
                        <dt class="col-sm-4 text-right">{{ ($address->addressType) ? ucfirst($address->addressType->name).' ' : null }}{{ ucfirst(__('my-crm::lang.address')) }}</dt>
                        <dd class="col-sm-8">
                            {{ \Kv\MyCrm\Http\Helpers\AddressLine\addressSingleLine($address) }} {{ ($address->primary) ? '(Primary)' : null }}
                            @if($address->contact)
                                <small><br >{{ ucwords(__('my-crm::lang.contact')) }}: {{ $address->contact }}</small>
                            @endif
                            @if($address->phone)
                                <small><br >{{ ucwords(__('my-crm::lang.phone')) }}: {{ $address->phone }}</small>
                            @endif
                        </dd>
                    @endforeach
                </dl>
                @can('view crm products')
                <h6 class="text-uppercase mt-4 section-h6-title-table"><span>{{ ucfirst(__('my-crm::lang.delivery_items')) }} ({{ $delivery->deliveryProducts->count() }})</span></h6>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">{{ ucfirst(__('my-crm::lang.item')) }}</th>
                        <th scope="col">{{ ucfirst(__('my-crm::lang.quantity')) }}</th></tr>
                    </thead>
                    <tbody>
                    @foreach($delivery->deliveryProducts()->where('quantity', '>', 0)->get() as $deliveryProduct)
                        <tr>
                            <td>{{ $deliveryProduct->orderProduct->product->name }}</td>
                            <td>{{ $deliveryProduct->quantity }}</td></tr>
                        @if($deliveryProduct->orderProduct->comments)
                            <tr>
                                <td colspan="4" class="b-0 pt-0">
                                    <strong>{{ ucfirst(__('my-crm::lang.comments')) }}</strong><br />
                                    {{ $deliveryProduct->orderProduct->comments }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                @endcan
            </div>
            <div class="col-sm-6">
                @include('my-crm::partials.activities', [
                    'model' => $delivery
                ])
            </div>
        </div>

    @endcomponent

@endcomponent
