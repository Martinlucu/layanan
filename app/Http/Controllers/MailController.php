<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){
 
		$emails = [
            [
                'nama' => 'aku 1',
                'email' => 'david.thehackedone@gmail.com',
                'nimku' => '151515151'
            ],
            [
                'nama' => 'aku 2',
                'email' => 'fadhlidzil.prakoso@gmail.com',
                'nimku' => '151515151'
            ]
        ];

        // $mhs = mhs::select('nam','email','nim')->where()....->get();
        // $value['email'] : array
        // $value->email : object
        

        // Mail::to("david.thehackedone@gmail.com")->send(new MyTestMail());
        // Mail::to("david.thehackedone@gmail.com")->send(new MyTestMail());
        
        // foreach($mhs as $value){
            // Mail::to($value->email)->send(new MyTestMail($value['nama'], $value['nimku']));
        foreach($emails as $value){
            Mail::to($value['email'])->send(new MyTestMail($value['nama'], $value['nimku']));
        }
 
		return "Email telah dikirim";
 
	}
        
}
