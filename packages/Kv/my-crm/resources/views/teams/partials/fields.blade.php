<div class="row">
    <div class="col-sm-6 border-right">
        @include('my-crm::partials.form.text',[
         'name' => 'name',
         'label' => ucfirst(__('my-crm::lang.name')),
         'value' => old('name', $team->name ?? null),
         'required' => 'true'
       ])
    </div>
    <div class="col-sm-6">
        <h6 class="text-uppercase">{{ ucfirst(__('my-crm::lang.users')) }}</h6>
        @include('my-crm::partials.form.multiselect',[
        'name' => 'team_users',
        'label' => null,
        'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\optionsFromModel($users, null),
        'value' => old('users', (isset($team)) ? $team->users()->orderBy('name','ASC')->get()->pluck('id')->toArray() : null)
      ])
    </div>
</div>