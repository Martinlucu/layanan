<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\mhs;

class MyTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $nim;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $nim)
    {
        //
        $this->email = $email;
        $this->nim = $nim;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nama_baru = strtoupper($this->email);
       return $this->subject('')
                   ->from('howland2nd@gmail.com', 'Layanan Administrasi Akademik')
                   ->view('emails.MyTestMail')
                   ->with(
                    [
                        // 'nama' => 'Diki Alfarabi Hadi',
                        'nama' => $this->email,
                        'nim' => $this->nim,
                        'website' => 'www.malasngoding.com',
                    ]);
    }
}
