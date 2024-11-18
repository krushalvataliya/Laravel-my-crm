@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ ucfirst(__('my-crm::lang.leads')) }}
        @endslot

        @slot('actions')
            @if($pipeline)
                @include('my-crm::partials.view-types', [
                    'model' => 'leads', 
                    'viewSetting' => $viewSetting ?? 'list'
                ])
            @endif
            @include('my-crm::partials.filters', [
                'action' => route('laravel-crm.leads.filter'),
                'model' => '\Kv\MyCrm\Models\Lead'
            ])
            @can('create crm leads')
               <a type="button" class="btn btn-primary btn-sm" href="{{ url(route('laravel-crm.leads.create')) }}"><span class="fa fa-plus"></span>  {{ ucfirst(__('my-crm::lang.add_lead')) }}</a>
            @endcan
        @endslot

    @endcomponent

    @component('my-crm::components.card-table')

        <table class="table mb-0 card-table table-hover">
            <thead>
            <tr>
                <th scope="col">{{ ucwords(__('my-crm::lang.created')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.title')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.labels')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.value')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.client')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.organization')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.contact_person')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.stage')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.owner')) }}</th>
                <th scope="col" width="210"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($leads as $lead)
                <tr class="has-link" data-url="{{ url(route('laravel-crm.leads.show',$lead)) }}">
                    <td>{{ $lead->created_at->diffForHumans() }}</td>
                    <td>{{ $lead->title }}</td>
                    <td>@include('my-crm::partials.labels',[
                            'labels' => $lead->labels,
                            'limit' => 3
                        ])</td>
                    <td>{{ money($lead->amount, $lead->currency) }}</td>
                    <td>{{ $lead->client->name ?? null}}</td>
                    <td>{{ $lead->organisation->name ?? null}}</td>
                    <td>{{ $lead->person->name ??  null }}</td>
                    <td>{{ $lead->pipelineStage->name ?? null }}</td>
                    <td>{{ $lead->ownerUser->name ?? ucfirst(__('my-crm::lang.unallocated')) }}</td>
                    <td class="disable-link text-right">
                        @hasdealsenabled
                            @can('edit crm leads')
                            <a href="{{ route('laravel-crm.leads.convert-to-deal',$lead) }}" class="btn btn-success btn-sm"> {{ ucfirst(__('my-crm::lang.convert')) }}</a>
                            @endcan
                        @endhasdealsenabled
                        @can('view crm leads')
                        <a href="{{ route('laravel-crm.leads.show',$lead) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-eye" aria-hidden="true"></span></a>
                        @endcan
                        @can('edit crm leads')
                        <a href="{{ route('laravel-crm.leads.edit',$lead) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                        @endcan
                        @can('delete crm leads')
                        <form action="{{ route('laravel-crm.leads.destroy',$lead) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                            <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('my-crm::lang.lead') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endcomponent

    @if($leads instanceof \Illuminate\Pagination\LengthAwarePaginator )
        @component('my-crm::components.card-footer')
            {{ $leads->links() }}
        @endcomponent
    @endif

@endcomponent
