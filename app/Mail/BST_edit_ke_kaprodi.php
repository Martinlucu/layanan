<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class BST_edit_ke_kaprodi extends Mailable
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
        return $this->subject('Pemberitahuan perubahan data pengajuan BST oleh'.Auth::user()->nama.' '.Auth::user()->nim)
                    ->from('fadhlidzil.prakoso@gmail.com', 'Layanan Administrasi Akademik')
                    ->view('emails.BST_edit_ke_kaprodi');
    }
}
