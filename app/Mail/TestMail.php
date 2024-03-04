<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Test Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $data = $this->mailData;

        return new Content(
            view: 'admin.mail.sendMail',
            with: [
                'name' => $data['name'],
                'nrc' => $data['nrc'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'hotelName' => $data['hotelName'],
                'noOfRoom' => $data['noOfRoom'],
                'noOfEmployee' => $data['noOfEmployee'],
                'hotelAddress' => $data['hotelAddress'],
                'zone' => $data['zone'],
                'fax' => $data['fax'],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
