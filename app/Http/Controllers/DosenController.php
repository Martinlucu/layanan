<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Mail\Disepnsasi;
use App\Mail\Yudisium;
use App\Mail\BST;
use App\Mail\Cuti;
use Illuminate\Support\Facades\Mail;

class DosenController extends Controller
{
    public function dotdoshome()
    {
        
    	return view('doshome');
    }

    public function dosdetcuti()
    { 
        $ctmaha = DB::table('dokumen')->where('jenis','Cuti')->wherein('status',['proses', 'update ke dosen'])->where('kode_dosen', Auth::user()->kode_dosen)->orderBy('created_at', 'DESC')->get();
        $ctmahas = DB::table('dokumen')->where('jenis','Cuti')->where('kode_dosen', Auth::user()->kode_dosen)->orderBy('created_at', 'DESC')->get();
        
        return view('dosdetcuti',compact('ctmaha', 'ctmahas'));
    }

    public function dosdetbst()
    {
        $bsmaha = DB::table('dokumen')->where('jenis','BST')->wherein('status',['Proses','update ke dosen'])->where('kode_dosen', Auth::user()->kode_dosen)->orderBy('created_at', 'DESC')->get();
        $bsmahaa = DB::table('dokumen')->where('jenis','BST')->wherein('status',['setuju by dosen','update ke kaprodi'])->orderBy('created_at', 'DESC')->get();
        
        $bsmahas = DB::table('dokumen')->where('jenis','BST')->where('kode_dosen', Auth::user()->kode_dosen)->orderBy('created_at', 'DESC')->get();
        $bsmahass = DB::table('dokumen')->where('jenis','BST')->where('jurusan', 'S1 Sistem informasi')->orderBy('created_at', 'DESC')->get();
            
        return view('dosdetbst',compact('bsmaha', 'bsmahaa','bsmahas', 'bsmahass'));
    }

    public function dosdetdispen()
        {
            $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->wherein('status',['proses', 'update ke dosen',])->where('kode_dosen', Auth::user()->kode_dosen)->orderBy('created_at', 'DESC')->get();
            $dpmahaa = DB::table('dokumen')->where('jenis','Dispensasi')->wherein('status',['setuju by dosen','update ke kaprodi'])->orderBy('created_at', 'DESC')->get();
            
            $dpmahas = DB::table('dokumen')->where('jenis','Dispensasi')->where('kode_dosen', Auth::user()->kode_dosen)->orderBy('created_at', 'DESC')->get();
            $dpmahass = DB::table('dokumen')->where('jenis','Dispensasi')->where('jurusan', 'S1 Sistem Informasi')->orderBy('created_at', 'DESC')->get();
            
            return view('dosdetdispen',compact('dpmaha', 'dpmahaa', 'dpmahas', 'dpmahass'));
        }
    
    public function disrange(Request $request){
            $awal = $request->get("tgllawal");
           
            $akhir=date('tglakhir');
            $dpmahas = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by dosen')
            ->whereBetween('created_at', [$request->get('tgllawal'),$request->get('tglakhir')])->get();
            
            $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
            $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
            $dpmahaa = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by dosen')->get();
            
            return view('dosdetdispen',compact('dpmaha', 'dpmahaa','dp','dpmahas','awal'));;
        }
        
    public function stjcuti($id)
        {
            $nama = DB::table('dokumen')->where('id',$id)->value('nama_mhs');
            $nim = DB::table('dokumen')->where('id',$id)->value('nim');

                $date = date("Y-m-d H:i:s");

                $email=[
                    [
                        'email' => '17410100019@dinamika.ac.id',
                        'isi' => 'Pengajuan cuti anda telah disetujui oleh Dosen Wali, Silahkan menunggu persetujuan dari Kaprodi.'
    
                    ],
                    [
                        'email' => 'fadhlidzil.prakoso@gmail.com',
                        'isi' => 'Ada pengajuan cuti yang masuk atas nama '.$nama.' dengan NIM '.$nim.', dimohon untuk melakukan proses persetujuan/penolakan.'
    
                    ]
                ];
                foreach($email as $value){
                    Mail::to($value['email'])->send(new \App\Mail\cuti_dosen_stj($value['isi']));
                }

                DB::table('dokumen')->where('id',$id)->update([
                'status' => "setuju by dosen",
                'updated_at'=> $date
                ]);
            
            
        
            return redirect('/dosdetcuti');
        }
    
public function stjbst($id)
{
    $nama = DB::table('dokumen')->where('id',$id)->value('nama_mhs');
    $nim = DB::table('dokumen')->where('id',$id)->value('nim');

    if(Auth::user()->jabatan == "dosen wali"){
        $date = date("Y-m-d H:i:s");
        
        $email=[
                [
                    'email' => '17410100019@dinamika.ac.id',
                    'isi' => 'Pengajuan BST anda telah disetujui oleh Dosen Wali, silahkan menunggu persetujuan dari Kaprodi.'

                ],
                [
                    'email' => 'fadhlidzil.prakoso@gmail.com',
                    'isi' => 'Ada pengajuan BST yang masuk atas nama '.$nama.' dengan NIM '.$nim.', dimohon untuk melakukan proses persetujuan/penolakan.'

                ]
            ];
            foreach($email as $value){
                Mail::to($value['email'])->send(new \App\Mail\BST_dosen_stj($value['isi']));
            }

        DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju by dosen",
        'updated_at'=> $date
        ]);
    }else{
        $date = date("Y-m-d H:i:s");
        
        $email=[
            [
                'email' => '17410100019@dinamika.ac.id',
                'isi' => 'Pengajuan BST anda telah disetujui oleh Kaprodi, Silahkan menunggu proses dari Bag. AAK.'

            ],
            [
                'email' => 'howland2nd@gmail.com',
                'isi' => 'Ada pengajuan BST yang masuk atas nama '.$nama.' dengan NIM '.$nim.', dimohon untuk melakukan proses persetujuan/penolakan.'

            ]
        ];
        foreach($email as $value){
            Mail::to($value['email'])->send(new \App\Mail\BST_kaprodi_stj($value['isi']));
        }

        DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju by kaprodi",
        'updated_at'=> $date
    ]);
    }
    

    return redirect('/dosdetbst');
}

public function stjdis(Request $request, $id)
    {
        $nama = DB::table('dokumen')->where('id',$id)->value('nama_mhs');
        $nim = DB::table('dokumen')->where('id',$id)->value('nim');
        
        if(Auth::user()->jabatan == "dosen wali"){
            $date = date("Y-m-d H:i:s");
            
            $email=[
                [
                    'email' => '17410100019@dinamika.ac.id',
                    'isi' => 'Pengajuan dispensasi anda telah disetujui oleh Dosen Wali, Silahkan menunggu persetujuan dari Kaprodi.'

                ],
                [
                    'email' => 'fadhlidzil.prakoso@gmail.com',
                    'isi' => 'Ada pengajuan dispensasi yang masuk atas nama '.$nama.' dengan NIM '.$nim.', dimohon untuk melakukan proses persetujuan/penolakan.'

                ]
            ];
            foreach($email as $value){
                Mail::to($value['email'])->send(new \App\Mail\dispensasi_dosen_stj($value['isi']));
            }
            
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by dosen",
            'updated_at'=> $date
            ]);
        }else{
            $date = date("Y-m-d H:i:s");
            
            $email=[
                [
                    'email' => '17410100019@dinamika.ac.id',
                    'isi' => 'Pengajuan dispensasi anda telah disetujui oleh Kaprodi, Silahkan menunggu proses dari Bag. AAK.'

                ],
                [
                    'email' => 'howland2nd@gmail.com',
                    'isi' => 'Ada pengajuan dispensasi yang masuk '.$nama.' dengan NIM '.$nim.', dimohon untuk melakukan proses persetujuan/penolakan.'

                ]
            ];
            foreach($email as $value){
                Mail::to($value['email'])->send(new \App\Mail\dispensasi_kaprodi_stj($value['isi']));
            }
            
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by kaprodi",
            'updated_at'=> $date
            ]);
        }
            
        return redirect('/dosdetdispen');
    }
    
    
    public function tlkcuti(Request $request, $id)
    {
        
            $date = date("Y-m-d H:i:s");
            \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\cuti_dosen_tlk);
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by dosen",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
            ]);
        
        
        return redirect('/dosdetcuti');
    }
    
    public function tlkdis(Request $request, $id)
    {
        
        if(Auth::user()->jabatan == "dosen wali"){
            $date = date("Y-m-d H:i:s");
            \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\dispensasi_dosen_tlk);
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by dosen",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
        }else{
            $date = date("Y-m-d H:i:s");
            \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\dispensasi_kaprodi_tlk);
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by kaprodi",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
        }
            
        return redirect('/dosdetdispen');
    }
   
    public function tlkbst(Request $request, $id)
    {
        if(Auth::user()->jabatan == "dosen wali"){
            $date = date("Y-m-d H:i:s");
            \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\BST_dosen_tlk);
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by dosen",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
            ]);
        }else{
            $date = date("Y-m-d H:i:s");
            \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\BST_kaprodi_tlk);
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by kaprodi",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
            ]);
        }
        
    
        return redirect('/dosdetbst');
    }
}
