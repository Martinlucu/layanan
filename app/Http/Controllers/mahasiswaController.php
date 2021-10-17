<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class mahasiswaController extends Controller
{
    public function mhscuti()
    {
        
    	return view('mhscuti');
    }
    public function mhsdispen()
    {
    	return view('mhsdispen');
    }
    public function mhsbst()
    {
    	return view('mhsbst');
    }
    public function mhsyudi()
    {
    	return view('mhsyudi');
    }

    // Bug di if yang terakhir & tidak bisa menghitung minggu dari perkuliahan
    public function createbss(Request $request){
        $tanggungan = 11000000 - Auth::user()->jml_bop_dibayar;
        
        if(Auth::user()->semester >= 3 & Auth::user()->jml_pengajuan_cuti <= 2){
            DB::table('dokumen')->insert([
                'nim'               => Auth::user()->nim,
                'nama_mhs'          => Auth::user()->nama,
                'tempat_lahir'      => Auth::user()->tempat_lahir,
                'tanggal_lahir'     => Auth::user()->tanggal_lahir,
                'no_telp'           => Auth::user()->no_telp,
                'email_mhs'         => Auth::user()->email,
                'semester'          => Auth::user()->semester,
                'angkatan'          => Auth::user()->angkatan,
                'jurusan'           => Auth::user()->jurusan,
                'fakultas'          => Auth::user()->fakultas,
                'alasan_pengajuan'  => $request->alasan,
                'jenis'             => 'BST',
                'status'            => 'Proses']);

            DB::table('mhs')->where('nim', '=', Auth::user()->nim)
                    ->update([
                        'jml_pengajuan_cuti' =>  Auth::user()->jml_pengajuan_cuti + 1
                ]);

                return redirect('/mhs')->with('alert', 'Pengajuan Cuti anda telah berhasil di upload! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
        }elseif(Auth::user()->semester < 3 & Auth::user()->jml_pengajuan_cuti <= 2){
            return redirect('/mhs')->with('alert', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Anda sekarang semester'.Auth::user()->semester);
        }elseif(Auth::user()->semester >= 3 & Auth::user()->jml_pengajuan_cuti > 2){
            return redirect('/mhs')->with('alert', 'Mohon maaf, Anda tidak bisa mengajukan Cuti!<br><br>Alasan : Jumlah Pengajuan cuti anda melalui batas! (Anda sudah mengajukan cuti sebanyak'.Auth::user()->jml_pengajuan_cuti.'x');
        }else{
            return redirect('/mhs')->with('alert', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Alasan : Anda masih memiliki tanggungan keuangan sebesar Rp. '.$tanggungan);
        }
            
    }

    public function createyudi(Request $request){
        DB::table('dokumen')->insert([
            'nim'           => Auth::user()->nim,
            'no_ktp'        => $request->no_ktp,
            'nama_mhs'      => Auth::user()->nama,
            'tempat_lahir'  => Auth::user()->tempat_lahir,
            'tanggal_lahir' => Auth::user()->tanggal_lahir,
            'no_telp'       => Auth::user()->no_telp,
            'email_mhs'     => Auth::user()->email,
            'semester'      => Auth::user()->semester,
            'angkatan'      => Auth::user()->angkatan,
            'jurusan'       => Auth::user()->jurusan,
            'fakultas'      => Auth::user()->fakultas,
            'jenis'         => 'Yudisium',
            'berkas'        => $request->foto,
            'berkas'        => $request->toefl,
            'berkas'        => $request->ijazah_sma,
            'berkas'        => $request->akta,
            'berkas'        => $request->kk,
            'berkas'        => $request->ktm,
            'berkas'        => $request->ktp,
            'status' => 'Proses'
        ]);
        
        $foto = $request->foto;
        $toefl = $request->toefl;
        $ijazah_sma = $request->ijazah_sma;
        $akta = $request->akta;
        $kk = $request->kk;
        $ktm = $request->ktm;
        $ktp = $request->ktp;
        
        // BETA TEST CODE !!!! MASIH TESTING, KALO EROR WAJAR !!!! -Fadhli
        $nim = Auth::user()->nim;
        $nama = Auth::user()->nama;
        $tanggal = date('Y-m-d');
        $reference = $nim.$nama.$tanggal; 
        $tujuan_simpan = Storage::makeDirectory(public_path('/berkas_mhs'.$reference));
        
        $foto->move($tujuan_simpan, $foto->getClientOriginalName());
        $toefl->move($tujuan_simpan, $toefl->getClientOriginalName());
        $ijazah_sma->move($tujuan_simpan, $ijazah_sma->getClientOriginalName());
        $akta->move($tujuan_simpan, $akta->getClientOriginalName());
        $kk->move($tujuan_simpan, $kk->getClientOriginalName());
        $ktm->move($tujuan_simpan, $ktm->getClientOriginalName());
        $ktp->move($tujuan_simpan, $ktp->getClientOriginalName());
        return redirect('/mhs')->with('alert', 'Berkas yudisium anda telah berhasil diupload! Tetap cek notifikasi untuk mengetahui kabar selanjutnya.');

        // BETA TEST CODE !!!! MASIH TESTING, KALO EROR WAJAR !!!! -Fadhli
    }

    public function createdispensasi(Request $request){
        $s = DB::table('matkul_pkn')->get(['sakit'])->where('nim', '=', Auth::user()->nim);
        $i = DB::table('matkul_pkn')->get(['ijin'])->where('nim', '=', Auth::user()->nim);
        $a = DB::table('matkul_pkn')->get(['alpha'])->where('nim', '=', Auth::user()->nim);

        if($s < 2 & $i < 2 & $a < 2){
            
            DB::table('dokumen')->insert([
                'nim'           => Auth::user()->nim,
                'nama_mhs'      => Auth::user()->nama,
                'tempat_lahir'  => Auth::user()->tempat_lahir,
                'tanggal_lahir' => Auth::user()->tanggal_lahir,
                'no_telp'       => Auth::user()->no_telp,
                'email_mhs'     => Auth::user()->email,
                'semester'      => Auth::user()->semester,
                'angkatan'      => Auth::user()->angkatan,
                'jurusan'       => Auth::user()->jurusan,
                'fakultas'      => Auth::user()->fakultas,
                'tanggal_absen' => $request->absen,
                'tanggal_masuk' => $request->masuk,
                'jenis'         => 'Dispensasi',
                'berkas'        => $request->berkas_ketidakhadiran,
                'status'        => 'Proses'
            ]);
            
            
            $berkas = $request->berkas_ketidakhadiran;
            $tujuan_simpan = public_path('/berkas_mhs');
            $berkas->move($tujuan_simpan, $berkas->getClientOriginalName());
            
            
            return redirect('/mhs')->with('alert', 'Pengajuan dispensasi anda berhasil di upload! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
        }else{
            return redirect('/mhs')->with('alert', 'Mohon maaf, pengajuan anda kami tolak!');
        }
        
        
    }

    public function createbst(Request $request){
        DB::table('dokumen')->insert([
            'nim'               => Auth::user()->nim,
            'nama_mhs'          => Auth::user()->nama,
            'tempat_lahir'      => Auth::user()->tempat_lahir,
            'tanggal_lahir'     => Auth::user()->tanggal_lahir,
            'no_telp'           => Auth::user()->no_telp,
            'email_mhs'         => Auth::user()->email,
            'semester'          => Auth::user()->semester,
            'angkatan'          => Auth::user()->angkatan,
            'jurusan'           => Auth::user()->jurusan,
            'fakultas'          => Auth::user()->fakultas,
            'alasan_pengajuan'  => $request->alasan,
            'jenis'             => 'BST',
            'status'            => 'Proses'
        ]);

        return redirect('/mhs')->with('alert', 'Permohonan BST anda telah berhasil di upload! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
    }
    
}