<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BST_kaprodi_tlk extends Mailable
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
        return $this->subject('Pemberitahuan pengajuan BST oleh Kaprodi')
                    ->from('howland2nd@gmail.com', 'Layanan Administrasi Akademik')
                    ->view('emails.BST_kaprodi_tlk');
    }
}
