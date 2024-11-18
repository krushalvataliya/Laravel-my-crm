<div class="row">
    <div class="col">
        @include('my-crm::partials.form.text',[
         'name' => 'name',
         'label' => ucfirst(trans('my-crm::lang.name')),
         'value' => old('name', $pipeline->name ?? null),
         'required' => 'true'
       ])
    </div>
</div>