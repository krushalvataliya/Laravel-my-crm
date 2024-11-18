<div class="row">
    <div class="col">
        @include('my-crm::partials.form.text',[
         'name' => 'name',
         'label' => ucfirst(trans('my-crm::lang.name')),
         'value' => old('name', $pipelineStage->name ?? null),
         'required' => 'true'
       ])

        @include('my-crm::partials.form.textarea',[
        'name' => 'description',
        'label' => ucfirst(trans('my-crm::lang.description')),
        'value' => old('name', $pipelineStage->description ?? null),
      ])

        @include('my-crm::partials.form.select',[
        'name' => 'pipeline_id',
        'label' => ucfirst(trans('my-crm::lang.pipeline')),
        'options' => [''=>''] + \Kv\MyCrm\Models\Pipeline::pluck('name','id')->toArray(),
        'value' => old('pipeline_id', $pipelineStage->pipeline->id ?? null),
        'required' => 'true'
       ])
    </div>
</div>