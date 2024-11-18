@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ ucfirst(__('my-crm::lang.products')) }}
        @endslot
    
        @slot('actions')
            @can('create crm products')
            <span class="float-right"><a type="button" class="btn btn-primary btn-sm" href="{{ url(route('laravel-crm.products.create')) }}"><span class="fa fa-plus"></span> {{ ucfirst(__('my-crm::lang.add_product')) }}</a></span>
            @endcan
        @endslot

    @endcomponent

    @component('my-crm::components.card-table')

        <table class="table mb-0 card-table table-hover">
            <thead>
            <tr>
                <th scope="col" colspan="2">{{ ucfirst(__('my-crm::lang.name')) }}</th>
                <th scope="col">{{ strtoupper(__('my-crm::lang.sku')) }}</th>
                <th scope="col">{{ ucfirst(__('my-crm::lang.category')) }}</th>
                <th scope="col">{{ ucfirst(__('my-crm::lang.unit')) }}</th>
                <th scope="col">{{ ucfirst(__('my-crm::lang.price')) }} ({{ \Kv\MyCrm\Models\Setting::currency()->value ?? 'USD' }})</th>
                <th scope="col">{{ ucfirst(__('my-crm::lang.tax')) }}</th>
                <th scope="col">{{ ucfirst(__('my-crm::lang.tax_rate')) }}</th>
                <th scope="col">{{ ucfirst(__('my-crm::lang.active')) }}</th>
                <th scope="col">{{ ucfirst(__('my-crm::lang.owner')) }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr class="has-link" data-url="{{ url(route('laravel-crm.products.show',$product)) }}">
                    <td>{{ $product->name }}</td>
                    <td>@if($product->xeroItem)<img src="/vendor/laravel-crm/img/xero-icon.png" height="20" />@endif</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->productCategory->name ?? null }}</td>
                    <td>{{ $product->unit }}</td>
                    <td>{{ (isset($product->getDefaultPrice()->unit_price)) ? money($product->getDefaultPrice()->unit_price ?? null, $product->getDefaultPrice()->currency) : null }}</td>
                    <td>{{ $product->taxRate->name ?? null }}</td>
                    <td>{{ $product->tax_rate ?? $product->taxRate->rate ?? 0 }}%</td>
                    <td>{{ ($product->active == 1) ? 'YES' : 'NO' }}</td>
                    <td>{{ $product->ownerUser->name ?? ucfirst(__('my-crm::lang.unallocated')) }}</td>
                    <td class="disable-link text-right">
                        @can('view crm products')
                        <a href="{{  route('laravel-crm.products.show',$product) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-eye" aria-hidden="true"></span></a>
                        @endcan
                        @can('edit crm products')
                        <a href="{{  route('laravel-crm.products.edit',$product) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                        @endcan
                        @can('delete crm products')    
                        <form action="{{ route('laravel-crm.products.destroy',$product) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('my-crm::lang.product') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                        </form>
                        @endcan    
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        
    @endcomponent
    
    @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator )
        @component('my-crm::components.card-footer')
            {{ $products->links() }}
        @endcomponent
    @endif
    
@endcomponent    