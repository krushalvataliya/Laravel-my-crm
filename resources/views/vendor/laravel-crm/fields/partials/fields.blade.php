 <div class="row">
    <div class="col-sm-6 border-right">
        @include('my-crm::partials.form.select',[
        'name' => 'type',
        'label' => ucfirst(trans('my-crm::lang.type')),
        'options' => [
           'text' => 'Single-line text',
           'textarea' => 'Multi-line text',
           'checkbox' => 'Single checkbox',
           'checkbox_multiple' => 'Multiple checkbox',
           'select' => 'Dropdown select',
           'radio' => 'Radio select', 
           'date' => 'Date picker',
         ],
        'value' => old('type', $field->type ?? null)
       ])

        @include('my-crm::partials.form.select',[
        'name' => 'field_group_id',
        'label' => ucfirst(trans('my-crm::lang.group')),
        'options' => [''=>''] + \Kv\MyCrm\Models\FieldGroup::pluck('name','id')->toArray(),
        'value' => old('field_group_id', $field->fieldGroup->id ?? null)
       ])
        
        @include('my-crm::partials.form.text',[
         'name' => 'name',
         'label' => ucfirst(trans('my-crm::lang.name')),
         'value' => old('name', $field->name ?? null)
        ])

        @include('my-crm::partials.form.text',[
         'name' => 'default',
         'label' => ucfirst(trans('my-crm::lang.default')),
         'value' => old('default', $field->default ?? null)
        ])

        <div class="form-group">
            <label for="required">{{ ucfirst(__('my-crm::lang.required')) }}</label>
            <span class="form-control-toggle">
                 <input id="required" type="checkbox" name="required" {{ (isset($field) && $field->required == 1) ? 'checked' : null }} data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
            </span>
        </div>
    </div>
    <div class="col-6">
        <h6 class="text-uppercase">{{ ucfirst(__('my-crm::lang.attach')) }}</h6>
        @include('my-crm::partials.form.multiselect',[
        'name' => 'field_models',
        'label' => null,
        'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\fieldModels(),
        'value' => old('field_models', (isset($field)) ? \Kv\MyCrm\Models\FieldModel::where('field_id', $field->id)->get()->pluck('model')->toArray() : null)
      ])
    </div>
</div>