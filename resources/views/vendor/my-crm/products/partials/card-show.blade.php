@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ $product->name }} 
        @endslot

        @slot('actions')

            <span class="float-right">
                @include('my-crm::partials.return-button',[
                    'model' => $product,
                    'route' => 'products'
                ]) | 
                @can('edit crm products')
                <a href="{{ url(route('laravel-crm.products.edit', $product)) }}" type="button" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                @endcan
                @can('delete crm products')
                <form action="{{ route('laravel-crm.products.destroy',$product) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('my-crm::lang.product') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
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
                    <dt class="col-sm-3 text-right">{{ strtoupper(__('my-crm::lang.sku')) }}</dt>
                    <dd class="col-sm-9">{{ $product->code }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.barcode')) }}</dt>
                    <dd class="col-sm-9">{{ $product->barcode }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.purchase_account')) }}</dt>
                    <dd class="col-sm-9">{{ $product->purchase_account }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.sales_account')) }}</dt>
                    <dd class="col-sm-9">{{ $product->sales_account }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.unit')) }}</dt>
                    <dd class="col-sm-9">{{ $product->unit }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.tax_rate')) }}</dt>
                    <dd class="col-sm-9">{{ $product->taxRate->name ?? null }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.tax_rate_percent')) }}</dt>
                    <dd class="col-sm-9">{{ $product->tax_rate ?? $product->taxRate->rate ?? 0 }}%</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.category')) }}</dt>
                    <dd class="col-sm-9">{{ $product->productCategory->name ?? null }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.description')) }}</dt>
                    <dd class="col-sm-9">{{ $product->description }}</dd>
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.integrations')) }}</dt>
                    <dd class="col-sm-9">@if($product->xeroItem)<img src="/vendor/laravel-crm/img/xero-icon.png" height="20" />@endif</dd>
                </dl>
                <h6 class="text-uppercase mt-4">{{ ucfirst(__('my-crm::lang.owner')) }}</h6>
                <hr />
                <dl class="row">
                    <dt class="col-sm-3 text-right">{{ ucfirst(__('my-crm::lang.name')) }}</dt>
                    <dd class="col-sm-9">
                        @if($product->ownerUser)<a href="{{ route('laravel-crm.users.show', $product->ownerUser) }}">{{ $product->ownerUser->name ?? null }}</a> @else  {{ ucfirst(__('my-crm::lang.unallocated')) }} @endif
                    </dd>
                </dl>
            </div>
            <div class="col-sm-6">
                <h6 class="text-uppercase">{{ ucfirst(__('my-crm::lang.prices')) }}</h6>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">{{ ucwords(__('my-crm::lang.unit_price')) }}</th>
                       {{-- <th scope="col">{{ ucwords(__('my-crm::lang.cost_per_unit')) }}</th>
                        <th scope="col">{{ ucwords(__('my-crm::lang.direct_cost')) }}</th>--}}
                        <th scope="col">{{ ucwords(__('my-crm::lang.currency')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product->productPrices as $productPrice)
                        <tr>
                            <th>{{ money($productPrice->unit_price ?? null, $productPrice->currency) }}</th>
                           {{-- <td>{{ money($productPrice->cost_per_unit ?? null, $productPrice->cost_per_unit) }}</td>
                            <td>{{ money($productPrice->direct_cost ?? null, $productPrice->direct_cost) }}</td>--}}
                            <td>{{ $productPrice->currency }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
               
                <h6 class="text-uppercase mt-4">{{ ucfirst(__('my-crm::lang.variations')) }}</h6>
                <hr />
                ...
                @can('view crm deals')
                <h6 class="text-uppercase mt-4">{{ ucfirst(__('my-crm::lang.deals')) }}</h6>
                <hr />
                ...
                @endcan    
            </div>
        </div>
        
    @endcomponent    

@endcomponent    