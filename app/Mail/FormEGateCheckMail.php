<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\FormEGateCheck;
use Illuminate\Http\Request;
use app\Providers\MailServiceProvider;

class FormEGateCheckMail extends Mailable 
{
    use Queueable, SerializesModels;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->gate_checkin_date = $request->input('gate_checkin_date');
        $this->emp_name = $request->emp_name;
        $this->gate_nama_angkutan = $request->input('gate_nama_angkutan');
        $this->gate_nomor_plat = $request->input('gate_nomor_plat');
        $this->gate_nomor_tangki = $request->input('gate_nomor_tangki');
        $this->gate_delete_reason = $request->input('gate_delete_reason');
        $this->id = $request->form_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.gate_truck_ditolak')
        ->with([
            'gate_checkin_date' => $this->gate_checkin_date,
            'emp_name' => $this->emp_name,
            'gate_nama_angkutan' => $this->gate_nama_angkutan,
            'gate_nomor_plat' => $this->gate_nomor_plat,
            'gate_nomor_tangki' => $this->gate_nomor_tangki,
            'gate_delete_reason' => $this->gate_delete_reason,
            'id' => $this->id
        ]);
            
    }
}
