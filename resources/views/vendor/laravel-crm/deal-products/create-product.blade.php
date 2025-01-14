<div class="row deal-product-row">
    <div class="col-6">
        @include('my-crm::partials.form.hidden',[
              'name' => 'item_deal_product_id['.$index.']',
              'value' => old('item_deal_product_id.'.$index, null),
           ])
        <span class="autocomplete autocomplete-product-name" data-index="{{ $index }}">
            @include('my-crm::partials.form.hidden',[
               'name' => 'item_product_id['.$index.']',
               'value' => old('item_product_id.'.$index, null),
            ])
            @include('my-crm::partials.form.text',[
                           'name' => 'item_name['.$index.']',
                           'label' => ucfirst(__('my-crm::lang.item')),
                           'value' => old('item_name.'.$index, null),
                           'attributes' => [
                              'autocomplete' => \Illuminate\Support\Str::random(),
                      
                           ]
                       ])
        </span>
    </div>
    <div class="col">
        @include('my-crm::partials.form.text',[
            'name' => 'item_price['.$index.']',
            'label' => ucfirst(__('my-crm::lang.price')),
            'type' => 'number',
            'value' => old('item_price.'.$index, null) ,
            'attributes' => [
                'step' => .01
            ]
        ])
    </div>
    <div class="col">
        @include('my-crm::partials.form.text',[
           'name' => 'item_quantity['.$index.']',
           'label' => ucfirst(__('my-crm::lang.quantity')),
           'type' => 'number',
           'value' => old('item_quantity.'.$index, 1)
       ])
    </div>
    <div class="col">
        @include('my-crm::partials.form.text',[
            'name' => 'item_amount['.$index.']',
            'label' => ucfirst(__('my-crm::lang.amount')),
            'type' => 'number',
            'value' => old('item_amount.'.$index, null) ,
            'attributes' => [
                  'step' => .01,
                  'readonly' => 'readonly'
            ]
        ])
    </div>
</div>