<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $products;
    /**
     * Create a new message instance.
     */
    public function __construct($order, $products) 
    {
        $this->order = $order;
        $this->products = $products; 
    }
    public function build()
    {
        return $this->view('components.invoice')->subject('Invoice')->with('products', $this->products); 
    }
    
    public function content(): Content
    {
        return new Content(
            markdown: ''
        );
    }
    

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
