<div class="row">
    <div class="col">
        @include('my-crm::partials.form.text',[
         'name' => 'name',
         'label' => ucfirst(trans('my-crm::lang.name')),
         'value' => old('name', $taxRate->name ?? null)
        ])

        @include('my-crm::partials.form.text',[
         'name' => 'rate',
         'label' => ucfirst(trans('my-crm::lang.rate')),
         'value' => old('rate', $taxRate->rate ?? null),
         'append' => '<span class="fa fa-percent" aria-hidden="true"></span>',
        ])

        @include('my-crm::partials.form.textarea',[
        'name' => 'description',
        'label' => ucfirst(trans('my-crm::lang.description')),
        'rows' => 5,
        'value' => old('name', $taxRate->description ?? null)
        ])

        <div class="form-group">
            <label for="default">{{ ucfirst(__('my-crm::lang.default_tax_rate')) }}</label>
            <span class="form-control-toggle">
                 <input id="default" type="checkbox" name="default" {{ (isset($taxRate) && $taxRate->default == 1) ? 'checked' : null }} data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
            </span>
        </div>

        @include('my-crm::partials.form.text',[
         'name' => 'tax_type',
         'label' => ucfirst(trans('my-crm::lang.tax_type')),
         'value' => old('tax_type', $taxRate->tax_type ?? null),
        ])
    </div>
</div>