<div class="row">
    <div class="col">
        @include('my-crm::partials.form.text',[
         'name' => 'name',
         'label' => ucfirst(trans('my-crm::lang.name')),
         'value' => old('name', $productCategory->name ?? null)
       ])

        @include('my-crm::partials.form.textarea',[
        'name' => 'description',
        'label' => ucfirst(trans('my-crm::lang.description')),
         'rows' => 5,
        'value' => old('name', $productCategory->description ?? null)
      ])
    </div>
</div>