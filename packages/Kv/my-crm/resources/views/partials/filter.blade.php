<span class="browse-filter">
     @include('my-crm::partials.form.multiselect',[
        'name' => $name,
        'label' => ucfirst(__('my-crm::lang.'.$label)),
        'options' => $options,      
        'value' =>  old($name, $value ?? null)
    ])
</span>