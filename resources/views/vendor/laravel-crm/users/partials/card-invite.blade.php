<form method="POST" action="{{ url(route('laravel-crm.users.sendinvite')) }}">
    @csrf
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.invite_user')) }}
            @endslot

            @slot('actions')
                    <span class="float-right"><a type="button" class="btn btn-outline-secondary btn-sm" href="{{ url(route('laravel-crm.users.index')) }}"><span class="fa fa-angle-double-left"></span> {{ ucfirst(__('my-crm::lang.back_to_users')) }}</a></span>
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

                <div class="row">
                    <div class="col-sm-12">
                        @include('my-crm::partials.form.text',[
                           'name' => 'email',
                           'label' => ucfirst(__('my-crm::lang.email')),
                           'value' => old('email')
                         ])
                        @include('my-crm::partials.form.text',[
                           'name' => 'subject',
                           'label' => ucfirst(__('my-crm::lang.subject')),
                           'value' => old('subject', 'Invitation to join Laravel CRM'),
                         ])
                        @include('my-crm::partials.form.textarea',[
                          'name' => 'message',
                          'label' => ucfirst(__('my-crm::lang.message')),
                          'rows' => 5,
                          'value' => old('message') 
                       ])
                    </div>
                </div>

        @endcomponent

        @component('my-crm::components.card-footer')
                <a href="{{ url(route('laravel-crm.users.index')) }}" class="btn btn-outline-secondary"> {{ ucfirst(__('my-crm::lang.cancel')) }}</a>
                <button type="submit" class="btn btn-primary"> {{ ucwords(__('my-crm::lang.send_invite')) }}</button>
        @endcomponent

    @endcomponent
</form>