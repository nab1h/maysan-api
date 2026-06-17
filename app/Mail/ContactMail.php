<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('رسالة جديدة من نموذج اتصل بنا - ' . $this->data['subject'])
            ->replyTo($this->data['email'], $this->data['name']) // مهم جداً: يتيح لك الرد مباشرة على العميل
            ->view('emails.contact');
    }
}
