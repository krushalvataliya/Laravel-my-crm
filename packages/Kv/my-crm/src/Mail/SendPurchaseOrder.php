<?php

namespace Kv\MyCrm\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPurchaseOrder extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $emailTo;

    public $subject;

    public $content;

    public $onlinePurchaseOrderLink;

    public $copyMe = false;

    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->emailTo = $data['to'];
        $this->subject = $data['subject'];
        $this->content = $data['message'];
        $this->copyMe = $data['cc'];
        $this->onlinePurchaseOrderLink = $data['onlinePurchaseOrderLink'];
        $this->pdf = $data['pdf'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->content = str_replace('[Online Purchase Order Link]', '<a href="'.$this->onlinePurchaseOrderLink.'">'.$this->onlinePurchaseOrderLink.'</a>', $this->content);

        $this->content = nl2br($this->content);

        $mailable = $this->subject($this->subject)
            ->from(auth()->user()->email, auth()->user()->name)
            ->to($this->emailTo)
            ->markdown('my-crm::mail.email');

        if ($this->copyMe == 1) {
            $mailable->cc(auth()->user()->email);
        }

        $mailable->attach(storage_path($this->pdf));

        return $mailable;
    }
}
