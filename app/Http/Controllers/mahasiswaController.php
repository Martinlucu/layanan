<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class mahasiswaController extends Controller
{
    public function mhscuti()
    {
        $ct = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->count();
        $ctt = DB::table('dokumen')->where('jenis','Cuti')->where('status','setuju by dosen')->count();
        $cttt = DB::table('dokumen')->where('jenis','Cuti')->where('status','setuju by kaprodi')->count();
        $ctmaha = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->get();
        $ctmahas = DB::table('dokumen')->where('jenis','Cuti')->where('status','setuju by dosen')->get();
        $ctmahass = DB::table('dokumen')->where('jenis','Cuti')->where('status','setuju by aak')->get();
        
        return view('mhscuti', compact('ct', 'ctt', 'ctt', 'ctmaha', 'ctmahas', 'ctmahass'));
    }
    public function mhsdispen()
    {
    	$dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
    	$dpp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by dosen')->count();
    	$dppp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by kaprodi')->count();
        $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
        $dpmahas = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by dosen')->get();
        $dpmahass = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by kaprodi')->get();
        
        return view('mhsdispen', compact('dp', 'dpp', 'dppp', 'dpmaha', 'dpmahas', 'dpmahass'));
    }
    public function mhsbst()
    {
    	$bs = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->count();
    	$bss = DB::table('dokumen')->where('jenis','BST')->where('status','setuju by dosen')->count();
    	$bsss = DB::table('dokumen')->where('jenis','BST')->where('status','setuju by aak')->count();
        $bsmaha = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->where('nim', Auth::user()->nim)->get();
        $bsmahas = DB::table('dokumen')->where('jenis','BST')->where('status','setuju by dosen')->where('nim', Auth::user()->nim)->get();
        $bsmahass = DB::table('dokumen')->where('jenis','BST')->where('status','setuju by aak')->where('nim', Auth::user()->nim)->get();
        
        return view('mhsbst', compact('bs', 'bss', 'bsss', 'bsmaha', 'bsmahas', 'bsmahass'));
    }
    public function mhsyudi()
    {
    	$ydm = DB::table('dokumen')->where('status','proses')->count();
    	$ydmm = DB::table('dokumen')->where('status','setuju by dosen')->count();
    	$ydmmm = DB::table('dokumen')->where('status','setuju by kaprodi')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses')->get();
        $ydmahas = DB::table('dokumen')->where('jenis','Yudisium')->where('status','setuju by dosen')->get();
        $ydmahass = DB::table('dokumen')->where('jenis','Yudisium')->where('status','setuju by kaprodi')->get();
        
        return view('mhsyudi', compact('ydm', 'ydmm','ydmmm', 'ydmaha', 'ydmahas', 'ydmahass'));
    }

    public function createdispensasi(Request $request){
        $date = Carbon::now();
        $s = DB::table('matkul_pkn')->where('nim', '=', Auth::user()->nim)->value('sakit');
        $i = DB::table('matkul_pkn')->where('nim', '=', Auth::user()->nim)->value('ijin');
        $a = DB::table('matkul_pkn')->where('nim', '=', Auth::user()->nim)->value('alpha');
        
        
        if($s < 2 && $i < 2 && $a < 2){
            $berkas= $request->berkas_ketidakhadiran;
            $nama_berkas = $request->file('berkas_ketidakhadiran')->getClientOriginalName();
            
            DB::table('dokumen')->insert([
                'nim'           => Auth::user()->nim,
                'nama_mhs'      => Auth::user()->nama,
                'no_telp'       => Auth::user()->no_telp,
                'email_mhs'     => Auth::user()->email,
                'semester'      => Auth::user()->semester,
                'angkatan'      => Auth::user()->angkatan,
                'jurusan'       => Auth::user()->jurusan,
                'fakultas'      => Auth::user()->fakultas,
                'tanggal_absen' => $request->absen,
                'tanggal_masuk' => $request->masuk,
                'jenis'         => 'Dispensasi',
                'berkas'        => $nama_berkas,
                'status'        => 'proses',
                'created_at' => $date
            ]);
            
            
            $tujuan_simpan = public_path('/berkas_mhs/'.Auth::user()->nim.'_dispensasi');
            $berkas->move($tujuan_simpan, $nama_berkas);
            
            
            return redirect('/mhs')->with('alert', 'Pengajuan dispensasi anda berhasil di upload! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
        }else{
            return redirect('/mhs')->with('alert', 'Mohon maaf, pengajuan dispensasi anda ditolak! Alasan : Jumlah sakit/ijin/alpha anda melebihi batas.');
        }
        
        
    }

    public function createyudi(Request $request){
        $date = Carbon::now();
        $foto = $request->foto;
        $toefl = $request->toefl;
        $ijazah_sma = $request->ijazah_sma;
        $akta = $request->akta;
        $kk = $request->kk;
        $ktm = $request->ktm;
        $ktp = $request->ktp;

        $nama_foto = $request->file('foto')->getClientOriginalName();
        $nama_toefl = $request->file('toefl')->getClientOriginalName();
        $nama_ijazah = $request->file('ijazah_sma')->getClientOriginalName();
        $nama_akta = $request->file('akta')->getClientOriginalName();
        $nama_kk = $request->file('kk')->getClientOriginalName();
        $nama_ktm = $request->file('ktm')->getClientOriginalName();
        $nama_ktp = $request->file('ktp')->getClientOriginalName();

        DB::table('dokumen')->insert([
            'nim'           => Auth::user()->nim,
            'no_ktp'        => Auth::user()->no_ktp,
            'nama_mhs'      => Auth::user()->nama,
            'no_telp'       => Auth::user()->no_telp,
            'email_mhs'     => Auth::user()->email,
            'semester'      => Auth::user()->semester,
            'jurusan'       => Auth::user()->jurusan,
            'fakultas'      => Auth::user()->fakultas,
            'jenis'         => 'Yudisium',
            'berkas'        => $nama_foto,
            'berkas'        => $nama_toefl,
            'berkas'        => $nama_ijazah,
            'berkas'        => $nama_akta,
            'berkas'        => $nama_kk,
            'berkas'        => $nama_ktm,
            'berkas'        => $nama_ktp,
            'status'        => 'proses',
            'created_at'    => $date
        ]);
        
       
        
        // BETA TEST CODE !!!! MASIH TESTING, KALO EROR WAJAR !!!! -Fadhli
        // $nim = Auth::user()->nim;
        // $nama = Auth::user()->nama;
        // $tanggal = date('Y-m-d');
        // $reference = $nim.$nama.$tanggal; 
        $tujuan_simpan = public_path('/berkas_mhs/'.Auth::user()->nim.'_yudisium');
        
        $foto->move($tujuan_simpan, $nama_foto);
        $toefl->move($tujuan_simpan, $nama_toefl);
        $ijazah_sma->move($tujuan_simpan, $nama_ijazah);
        $akta->move($tujuan_simpan, $nama_akta);
        $kk->move($tujuan_simpan, $nama_kk);
        $ktm->move($tujuan_simpan, $nama_ktm);
        $ktp->move($tujuan_simpan, $nama_ktp);
        return redirect('/mhs')->with('alert', 'Berkas yudisium anda telah berhasil diupload! Tetap cek notifikasi untuk mengetahui kabar selanjutnya.');

        // BETA TEST CODE !!!! MASIH TESTING, KALO EROR WAJAR !!!! -Fadhli
    }

    
    public function createbss(Request $request){
        $date = date(Carbon::now());
        $tanggungan = 11000000 - Auth::user()->jml_bop_dibayar;
        $tanggal_sekarang = new Carbon();
        $masuk_kuliah = new Carbon(Auth::user()->tanggal_masuk);

        $minggu_kuliah = $tanggal_sekarang->diffInWeeks($masuk_kuliah);

        echo $minggu_kuliah;
        
        if(Auth::user()->semester >= 3 & Auth::user()->jml_pengajuan_cuti <= 2 && $minggu_kuliah >= 4){
            DB::table('dokumen')->insert([
                'nim'               => Auth::user()->nim,
                'nama_mhs'          => Auth::user()->nama,
                'no_telp'           => Auth::user()->no_telp,
                'email_mhs'         => Auth::user()->email,
                'semester'          => Auth::user()->semester,
                'angkatan'          => Auth::user()->angkatan,
                'jurusan'           => Auth::user()->jurusan,
                'fakultas'          => Auth::user()->fakultas,
                'alasan_pengajuan'  => $request->alasan,
                'jenis'             => 'Cuti',
                'status'            => 'proses',
                'created_at'            => $date,                
            ]);

            DB::table('mhs')->where('nim', '=', Auth::user()->nim)
                    ->update([
                        'jml_pengajuan_cuti' =>  Auth::user()->jml_pengajuan_cuti + 1
                ]);

                return redirect('/mhs')->with('alert', 'Pengajuan Cuti anda telah berhasil di upload! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
        }elseif(Auth::user()->semester < 3 & Auth::user()->jml_pengajuan_cuti <= 2 && $minggu_kuliah >= 4){
            return redirect('/mhs')->with('alert', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Anda sekarang semester'.Auth::user()->semester);
        }elseif(Auth::user()->semester >= 3 & Auth::user()->jml_pengajuan_cuti > 2 && $minggu_kuliah >= 4){
            return redirect('/mhs')->with('alert', 'Mohon maaf, Anda tidak bisa mengajukan Cuti!<br><br>Alasan : Jumlah Pengajuan cuti anda melalui batas! (Anda sudah mengajukan cuti sebanyak'.Auth::user()->jml_pengajuan_cuti.'x');
        }elseif(Auth::user()->semester >= 3 & Auth::user()->jml_pengajuan_cuti <= 2 && $minggu_kuliah < 4){
            return redirect('/mhs')->with('alert', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Alasan : Anda masih belum memasuki minggu ke 4 perkuliahan! (perkuliahan anda masih pada minggu ke : '.$minggu_kuliah);
        }else{
            return redirect('/mhs')->with('alert', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Alasan : Anda masih memiliki tanggungan keuangan sebesar Rp. '.$tanggungan);
        }
            
    }


    public function createbst(Request $request){
        $date = date(Carbon::now()); 
        DB::table('dokumen')->insert([
            'nim'               => Auth::user()->nim,
            'nama_mhs'          => Auth::user()->nama,
            'no_telp'           => Auth::user()->no_telp,
            'email_mhs'         => Auth::user()->email,
            'semester'          => Auth::user()->semester,
            'angkatan'          => Auth::user()->angkatan,
            'jurusan'           => Auth::user()->jurusan,
            'fakultas'          => Auth::user()->fakultas,
            'alasan_pengajuan'  => $request->alasan,
            'jenis'             => 'BST',
            'status'            => 'proses',
            'created_at'            => $date
        ]);

        // DB::table('mhs')->update([
        //     'status_bst'        => 'proses'
        // ])->where('nim', Auth::user()->nim);
        return redirect('/mhs')->with('alert', 'Permohonan BST anda telah berhasil di upload! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
    }
    
}