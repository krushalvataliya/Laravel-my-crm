@extends('my-crm::layouts.document')

@section('content')

    <table class="table table-sm table-items">
        <tbody>
            <tr>
                <td width="50%"> 
                    <h1>{{ strtoupper(__('my-crm::lang.invoice')) }}</h1>
                    <p>
                    @if($invoice->reference || ($invoice->xeroInvoice && $invoice->xeroInvoice->reference))
                        <p><strong>{{ ucfirst(__('my-crm::lang.reference')) }}</strong> {{ $invoice->xeroInvoice->reference ?? $invoice->reference }}<br />
                    @endif
                    <strong>{{ ucfirst(__('my-crm::lang.invoice_date')) }}</strong> {{ $invoice->issue_date->format($dateFormat) }}<br />
                    <strong>{{ ucfirst(__('my-crm::lang.invoice_number')) }}</strong> {{ $invoice->xeroInvoice->number ?? $invoice->invoice_id   }}<br />
                    <strong>{{ ucfirst(__('my-crm::lang.due_date')) }}</strong> {{ $invoice->due_date->format($dateFormat) }}
                    </p>
                </td>
                <td width="50%" style="text-align: right">
                    @if($logo)
                        <img src="{{ asset('storage/'.$logo) }}" height="140" style="margin-top: 10px" />
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <strong>{{ ucfirst(__('my-crm::lang.to')) }}</strong><br />
                    @if($invoice->organisation)
                        {{ $invoice->organisation->name }}<br />
                    @endif
                    @isset($invoice->person)
                        {{ $invoice->person->name }}<br />
                    @endisset
                    @if(isset($organisation_address))
                        @if($organisation_address->line1)
                            {{ $organisation_address->line1 }}<br />
                        @endif
                        @if($organisation_address->line2)
                            {{ $organisation_address->line2 }}<br />
                        @endif
                        @if($organisation_address->line3)
                            {{ $organisation_address->line3 }}<br />
                        @endif
                        @if($organisation_address->city || $organisation_address->state || $organisation_address->postcode)
                            {{ $organisation_address->city }} {{ $organisation_address->state }} {{ $organisation_address->postcode }}<br />
                        @endif
                        {{ $organisation_address->country }}
                    @elseif($address)
                        {{ $address->line1 }}<br />
                        @if($address->line2)
                            {{ $address->line2 }}<br />
                        @endif
                        @if($address->line3)
                            {{ $address->line3 }}<br />
                        @endif
                        {{ $address->city }}<br />
                        {{ $address->country }}
                    @endif
                </td>
                
                <td>
                    <strong>{{ ucfirst(__('my-crm::lang.from')) }}</strong><br />
                    @if($contactDetails)
                        {!! nl2br($contactDetails) !!}
                    @else
                        {{ $fromName }}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    @if($invoice->description)
        <table class="table table-bordered table-sm table-items">
          <tbody>
            <tr>
                <td><h4>{{ ucfirst(__('my-crm::lang.description')) }}</h4>
                    {!! nl2br($invoice->description) !!}</td>
            </tr>
          </tbody>  
        </table>
    @endif
    <table class="table table-bordered table-sm table-items">
        <thead>
        <tr>
            <th scope="col">{{ ucfirst(__('my-crm::lang.item')) }}</th>
            <th scope="col">{{ ucfirst(__('my-crm::lang.price')) }}</th>
            <th scope="col">{{ ucfirst(__('my-crm::lang.quantity')) }}</th>
            <th scope="col">{{ $taxName }}</th>
            <th scope="col">{{ ucfirst(__('my-crm::lang.amount')) }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoice->invoiceLInes()->whereNotNull('product_id')->get() as $invoiceLine)
            <tr>
                <td>
                    {{ $invoiceLine->product->name ?? null }}
                    @if($invoiceLine->comments)
                        <br /><br />
                        <strong>{{ ucfirst(__('my-crm::lang.comments')) }}: </strong> <br />
                        {{ $invoiceLine->comments }}
                    @endif
                </td>
                <td>{{ money($invoiceLine->price ?? null, $invoiceLine->currency) }}</td>
                <td>{{ $invoiceLine->quantity }}</td>
                <td>{{ money($invoiceLine->tax_amount ?? null, $invoiceLine->currency) }}</td>
                <td>{{ money($invoiceLine->amount ?? null, $invoiceLine->currency) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>{{ ucfirst(__('my-crm::lang.sub_total')) }}</strong></td>
            <td>{{ money($invoice->subtotal, $invoice->currency) }}</td>
        </tr>
        @if($invoice->discount > 0)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>{{ ucfirst(__('my-crm::lang.discount')) }}</strong></td>
                <td>{{ money($invoice->discount, $invoice->currency) }}</td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>{{ $taxName }}</strong></td>
            <td>{{ money($invoice->tax, $invoice->currency) }}</td>
        </tr>
        {{--<tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>{{ ucfirst(__('my-crm::lang.adjustment')) }}</strong></td>
            <td>{{ money($invoice->adjustments, $invoice->currency) }}</td>
         
        </tr>--}}
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>{{ ucfirst(__('my-crm::lang.total')) }}</strong></td>
            <td>{{ money($invoice->total, $invoice->currency) }}</td>
        </tr>
        </tfoot>
    </table>
    @if($paymentInstructions)
        <table class="table table-bordered table-sm table-items">
            <tbody>
            <tr>
                <td>
                    <h4>{{ ucfirst(__('my-crm::lang.payment')) }}</h4>
                    {!! nl2br($paymentInstructions) !!}
                </td>
            </tr>
            </tbody>
        </table>
    @endif
    @if($invoice->terms)
        <table class="table table-bordered table-sm table-items">
            <tbody>
            <tr>
                <td>
                    <h4>{{ ucfirst(__('my-crm::lang.terms')) }}</h4>
                    {!! nl2br($invoice->terms) !!}
                </td>
            </tr>
            </tbody>
        </table>
    @endif
@endsection
