<?php

namespace Kv\MyCrm\Http\Livewire;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Kv\MyCrm\Services\SettingService;
use Kv\MyCrm\Traits\NotifyToast;

class SendInvoice extends Component
{
    use NotifyToast;

    private $settingService;

    public $invoice;

    public $to;

    public $subject;

    public $message;

    public $cc;

    public $pdf;

    public $signedUrl;

    public function boot(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function mount($invoice)
    {
        $this->invoice = $invoice;
        $this->to = ($invoice->person) ? ($invoice->person->getPrimaryEmail()->address ?? null) : null;
        $this->subject = view('my-crm::mail.templates.send-invoice.subject', ['invoice' => $this->invoice])->render();
        $this->message = view('my-crm::mail.templates.send-invoice.message', ['invoice' => $this->invoice])->render();
    }

    /**
     * Returns validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'to' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ];
    }

    public function send()
    {
        $this->validate();

        $this->generateUrl();

        $pdfLocation = 'laravel-crm/'.strtolower(class_basename($this->invoice)).'/'.$this->invoice->id.'/';

        if (! File::exists($pdfLocation)) {
            Storage::makeDirectory($pdfLocation);
        }

        $this->pdf = 'app/'.$pdfLocation.'invoice-'.strtolower($this->invoice->invoice_id).'.pdf';

        Pdf::setOption([
            'fontDir' => public_path('vendor/laravel-crm/fonts'),
        ])
            ->loadView('my-crm::invoices.pdf', [
                'invoice' => $this->invoice,
                'contactDetails' => $this->settingService->get('invoice_contact_details')->value ?? null,
                'paymentInstructions' => $this->settingService->get('invoice_payment_instructions')->value ?? null,
                'email' => $email ?? null,
                'phone' => $phone ?? null,
                'address' => $address ?? null,
                'organisation_address' => $organisation_address ?? null,
                'fromName' => $this->settingService->get('organisation_name')->value ?? null,
                'logo' => $this->settingService->get('logo_file')->value ?? null,
            ])->save(storage_path($this->pdf));
        ;

        Mail::send(new \Kv\MyCrm\Mail\SendInvoice([
            'to' => $this->to,
            'subject' => $this->subject,
            'message' => $this->message,
            'cc' => $this->cc,
            'onlineInvoiceLink' => $this->signedUrl,
            'pdf' => $this->pdf,
        ]));

        $this->notify(
            'Invoice sent',
        );

        $this->invoice->update([
            'sent' => 1
        ]);

        $this->resetFields();

        $this->dispatchBrowserEvent('invoiceSent');
    }

    public function generateUrl()
    {
        $this->signedUrl = URL::temporarySignedRoute(
            'laravel-crm.portal.invoices.show',
            now()->addDays(14),
            [
                'invoice' => $this->invoice,
            ]
        );
    }

    private function resetFields()
    {
        $this->reset('to', 'subject', 'message', 'cc');
    }

    public function render()
    {
        return view('my-crm::livewire.send-invoice');
    }
}
