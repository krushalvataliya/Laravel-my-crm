@component('my-crm::components.card')

    @component('my-crm::components.card-table')

        <table class="table mb-0 card-table table-hover">
            <thead>
            <tr>
                <th scope="col">{{ ucwords(__('my-crm::lang.created')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.number')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.reference')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.sub_total')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.discount')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.tax')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.adjustment')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.total')) }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                @php 
                    (! \Kv\MyCrm\Http\Helpers\CheckAmount\subTotal($order)) ? $subTotalError = true : $subTotalError = false;
                    (! \Kv\MyCrm\Http\Helpers\CheckAmount\tax($order)) ? $taxError = true : $taxError = false;
                    (! \Kv\MyCrm\Http\Helpers\CheckAmount\total($order)) ? $totalError = true : $totalError = false;
                @endphp
               <tr class="has-link" data-url="{{ url(route('laravel-crm.orders.show', $order)) }}">
                   <td>{{ $order->created_at->diffForHumans() }}</td>
                   <td>{{ $order->order_id }}</td>
                   <td>{{ $order->reference }}</td>
                    <td>
                        @if($subTotalError)
                            <span data-toggle="tooltip" data-placement="top" title="Error with sub total" class="text-danger">
                             {{ money($order->subtotal, $order->currency) }}
                            </span>
                        @else
                            {{ money($order->subtotal, $order->currency) }}
                        @endif
                    </td>
                    <td>{{ money($order->discount, $order->currency) }}</td>
                   <td>
                       @if($taxError)
                           <span data-toggle="tooltip" data-placement="top" title="Error with tax" class="text-danger">
                             {{ money($order->tax, $order->currency) }}
                            </span>
                       @else
                           {{ money($order->tax, $order->currency) }}
                       @endif
                   </td>
                   <td>{{ money($order->adjustments, $order->currency) }}</td>
                   <td>
                       @if($totalError)
                           <span data-toggle="tooltip" data-placement="top" title="Error with total" class="text-danger">
                             {{ money($order->total, $order->currency) }}
                            </span>
                       @else
                           {{ money($order->total, $order->currency) }}
                       @endif
                   </td>
                    <td>
                        @if(! \Kv\MyCrm\Http\Helpers\CheckAmount\total($order))
                            <span data-toggle="tooltip" data-placement="top" title="Error with total" class="text-danger">
                             {{ money($order->total, $order->currency) }}
                            </span>
                        @else 
                            {{ money($order->total, $order->currency) }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endcomponent
    
@endcomponent
