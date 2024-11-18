@include('my-crm::partials.form.file',[
  'name' => 'file',
  'label' => ucfirst(__('my-crm::lang.add_file')),
  'attributes' => [
      'wire:model.defer' => 'file'  
  ]
])