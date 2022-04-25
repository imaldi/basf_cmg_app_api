<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\FormEGateCheck;

class FormEGateCheckMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(FormEGateCheck $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.gate_truck_ditolak');
            
    }
}
