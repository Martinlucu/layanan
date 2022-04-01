<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BST_kaprodi_stj extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($isi)
    {
        //
        $this->isi = $isi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemberitahuan pengajuan BST dari Kaprodi')
                    ->from('howland2nd@gmail.com', 'Layanan Administrasi Akademik')
                    ->view('emails.BST_kaprodi_stj')
                    ->with(
                        [
                            'isi' => $this->isi
                        ]);
    }
}
