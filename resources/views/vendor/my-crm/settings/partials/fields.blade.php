<div class="row">
    <div class="col border-right">
        @include('my-crm::partials.form.text',[
         'name' => 'organisation_name',
         'label' => ucfirst(trans('my-crm::lang.organization_name')),
         'value' => old('organisation_name', $organisationName->value ?? null),
         'required' => 'true'
        ])

        @include('my-crm::partials.form.text',[
         'name' => 'vat_number',
         'label' => ucfirst(trans('my-crm::lang.vat_number')),
         'value' => old('vat_number', $vatNumber->value ?? null)
        ])

        @if($logoFile)
        <div class="mb-3">
            <img src=" {{ ($logoFile) ? asset('storage/'.$logoFile->value) : 'https://via.placeholder.com/140x90' }}" class="img-fluid" width="200" />
        </div>
        @endif
        @include('my-crm::partials.form.file',[
             'name' => 'logo',
             'label' => ucfirst(trans('my-crm::lang.logo')),
             'value' => old('logo')
        ])

        @include('my-crm::partials.form.select',[
                'name' => 'country',
                'label' => ucfirst(trans('my-crm::lang.country')),
                'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\countries(),
                'value' => old('country', $country->value  ?? 'United States'),
                'required' => 'true'
             ])
        @include('my-crm::partials.form.select',[
           'name' => 'language',
           'label' => ucfirst(trans('my-crm::lang.language')),
           'options' => ['english' => 'English'],
           'value' => old('language', $language->value ?? 'english'),
           'required' => 'true'
        ])
        @include('my-crm::partials.form.select',[
           'name' => 'currency',
           'label' => ucfirst(trans('my-crm::lang.currency')),
           'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\currencies(),
           'value' => old('currency', $currency->value ?? 'USD'),
           'required' => 'true'
       ])
        @include('my-crm::partials.form.select',[
             'name' => 'timezone',
             'label' => ucfirst(trans('my-crm::lang.timezone')),
             'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\timezones(),
             'value' => old('timezone', $timezoneSetting->value ?? null),
             'required' => 'true'
        ])
        @include('my-crm::partials.form.select',[
            'name' => 'date_format',
            'label' => ucfirst(trans('my-crm::lang.date_format')),
            'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\dateFormats(),
            'value' => old('date_format', $dateFormatSetting->value ?? null),
            'required' => 'true'
       ])
        @include('my-crm::partials.form.select',[
            'name' => 'time_format',
            'label' => ucfirst(trans('my-crm::lang.time_format')),
            'options' => \Kv\MyCrm\Http\Helpers\SelectOptions\timeFormats(),
            'value' => old('time_format', $timeFormatSetting->value ?? null),
            'required' => 'true'
       ])
        @include('my-crm::partials.form.text',[
            'name' => 'tax_name',
            'label' => ucfirst(trans('my-crm::lang.tax_name')),
            'value' => old('tax_name', $taxNameSetting->value ?? null)
       ])
        @include('my-crm::partials.form.text',[
            'name' => 'tax_rate',
            'label' => ucfirst(trans('my-crm::lang.tax_rate')),
            'value' => old('tax_rate', $taxRateSetting->value ?? null),
            'append' => '%'
       ])
        @hasleadsenabled
        @include('my-crm::partials.form.text',[
         'name' => 'lead_prefix',
         'label' => ucfirst(trans('my-crm::lang.lead_prefix')),
         'value' => old('lead_prefix', $leadPrefix->value ?? null)
        ])
        @endhasleadsenabled
        @hasdealsenabled
        @include('my-crm::partials.form.text',[
         'name' => 'deal_prefix',
         'label' => ucfirst(trans('my-crm::lang.deal_prefix')),
         'value' => old('deal_prefix', $dealPrefix->value ?? null)
        ])
        @endhasdealsenabled
        @hasquotesenabled
        @include('my-crm::partials.form.text',[
         'name' => 'quote_prefix',
         'label' => ucfirst(trans('my-crm::lang.quote_prefix')),
         'value' => old('quote_prefix', $quotePrefix->value ?? null)
        ])
        @endhasquotesenabled
        @hasordersenabled
        @include('my-crm::partials.form.text',[
         'name' => 'order_prefix',
         'label' => ucfirst(trans('my-crm::lang.order_prefix')),
         'value' => old('order_prefix', $orderPrefix->value ?? null)
        ])
        @endhasordersenabled
        @hasinvoicesenabled
        @include('my-crm::partials.form.text',[
         'name' => 'invoice_prefix',
         'label' => ucfirst(trans('my-crm::lang.invoice_prefix')),
         'value' => old('invoice_prefix', $invoicePrefix->value ?? null)
        ])
        @endhasinvoicesenabled
        @hasdeliveriesenabled
        @include('my-crm::partials.form.text',[
         'name' => 'delivery_prefix',
         'label' => ucfirst(trans('my-crm::lang.delivery_prefix')),
         'value' => old('delivery_prefix', $deliveryPrefix->value ?? null)
        ])
        @endhasdeliveriesenabled
        @haspurchaseordersenabled
        @include('my-crm::partials.form.text',[
         'name' => 'purchase_order_prefix',
         'label' => ucfirst(trans('my-crm::lang.purchase_order_prefix')),
         'value' => old('purchase_order_prefix', $purchaseOrderPrefix->value ?? null)
        ])
        @endhaspurchaseordersenabled
        @hasquotesenabled
        @include('my-crm::partials.form.textarea',[
         'name' => 'quote_terms',
         'label' => ucfirst(trans('my-crm::lang.quote_terms')),
         'rows' => 5,
         'value' => old('quote_terms', $quoteTerms->value ?? null)
        ])
        @endhasquotesenabled
        @hasinvoicesenabled
        @include('my-crm::partials.form.textarea',[
         'name' => 'invoice_contact_details',
         'label' => ucfirst(trans('my-crm::lang.invoice_contact_details')),
         'rows' => 5,
         'value' => old('invoice_contact_details', $invoiceContactDetails->value ?? null)
        ])
        @include('my-crm::partials.form.textarea',[
         'name' => 'invoice_terms',
         'label' => ucfirst(trans('my-crm::lang.invoice_terms')),
         'rows' => 5,
         'value' => old('invoice_terms', $invoiceTerms->value ?? null)
        ])
        @include('my-crm::partials.form.textarea',[
         'name' => 'invoice_payment_instructions',
         'label' => ucfirst(trans('my-crm::lang.invoice_payment_instructions')),
         'rows' => 5,
         'value' => old('invoice_payment_instructions', $invoicePaymentInstructions->value ?? null)
        ])
        @endhasinvoicesenabled
        @haspurchaseordersenabled
        @include('my-crm::partials.form.textarea',[
         'name' => 'purchase_order_terms',
         'label' => ucfirst(trans('my-crm::lang.purchase_order_terms')),
         'rows' => 5,
         'value' => old('purchase_order_terms', $purchaseOrderTerms->value ?? null)
        ])
        @include('my-crm::partials.form.textarea',[
         'name' => 'purchase_order_delivery_instructions',
         'label' => ucfirst(trans('my-crm::lang.purchase_order_delivery_instructions')),
         'rows' => 5,
         'value' => old('purchase_order_delivery_instructions', $purchaseOrderDeliveryInstructions->value ?? null)
        ])
        @endhaspurchaseordersenabled
        <div class="form-group">
            <label for="dynamic_products">{{ ucfirst(__('my-crm::lang.allow_creating_products_when_creating_quotes_orders_and_invoices')) }}</label>
            <span class="form-control-toggle">
                 <input id="dynamic_products" type="checkbox" name="dynamic_products" {{ (isset($dynamicProductsSetting->value) && ($dynamicProductsSetting->value == 1)) ? 'checked' : null }} data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
            </span>
        </div>
        <div class="form-group">
            <label for="show_related_activity">{{ ucfirst(__('my-crm::lang.show_related_contact_activity')) }}</label>
            <span class="form-control-toggle">
                 <input id="show_related_activity" type="checkbox" name="show_related_activity" {{ (isset($showRelatedActivity->value) && ($showRelatedActivity->value == 1)) ? 'checked' : null }} data-toggle="toggle" data-size="sm" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
            </span>
        </div>
    </div>
    <div class="col">
        @livewire('phone-edit', [
        'phones' => $phones ?? null,
        'old' => old('phones')
        ])

        @livewire('email-edit', [
        'emails' => $emails ?? null,
        'old' => old('emails')
        ])

        @livewire('address-edit', [
        'addresses' => $addresses ?? null,
        'old' => old('addresses')
        ])
    </div>
</div>
