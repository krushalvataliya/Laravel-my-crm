<div class="row">
    <div class="col-sm-5 border-right">
        @include('my-crm::partials.form.hidden',[
             'name' => 'order_id',
             'value' => old('order_id', $delivery->order->id ?? $order->id ?? null),
        ])
        
        <div class="row">
            <div class="col-sm-6">
                @include('my-crm::partials.form.text',[
                      'name' => 'delivery_expected',
                      'label' => ucfirst(__('my-crm::lang.delivery_expected')),
                      'value' => old('delivery_expected', $delivery->delivery_expected ?? null)
                  ])
            </div>
            <div class="col-sm-6">
                @include('my-crm::partials.form.text',[
                      'name' => 'delivered_on',
                      'label' => ucfirst(__('my-crm::lang.delivered_on')),
                      'value' => old('delivered_on', $delivery->delivered_on ?? null)
                  ])
            </div>
        </div>
        
        @livewire('address-edit', [
            'addresses' => $addresses ?? null,
            'old' => old('addresses'),
            'model' => 'delivery'
        ])
    </div>
    <div class="col-sm-7">
        @livewire('delivery-items',[
            'delivery' => $delivery ?? null,
            'products' => $delivery->deliveryProducts ?? $order->orderProducts ?? null,
            'old' => old('deliveries'),
            'fromOrder' => (isset($order)) ? $order : false
        ])
    </div>
</div>
