<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class dispensasi_edit_ke_aak extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemberitahuan perubahan data pengajuan dispensasi dari '.Auth::user()->nama.' '.Auth::user()->nim)
                    ->from('howland2nd@gmail.com', 'Layanan Administrasi Akademik')
                    ->view('emails.dispensasi_edit_ke_aak');
    }
}
