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

    public function createbss(Request $request){
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
            'jenis'             => 'Cuti',
            'status'            => 'Proses'
        ]);

        return redirect('/mhs');
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
        
        $tujuan_simpan = public_path('/berkas_mhs');
        
        
        $foto->move($tujuan_simpan, $foto->getClientOriginalName());
        $toefl->move($tujuan_simpan, $toefl->getClientOriginalName());
        $ijazah_sma->move($tujuan_simpan, $ijazah_sma->getClientOriginalName());
        $akta->move($tujuan_simpan, $akta->getClientOriginalName());
        $kk->move($tujuan_simpan, $kk->getClientOriginalName());
        $ktm->move($tujuan_simpan, $ktm->getClientOriginalName());
        $ktp->move($tujuan_simpan, $ktp->getClientOriginalName());
        return redirect('/mhs');
    }

    public function createdispensasi(Request $request){
        $create = DB::table('dokumen')->insert([
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
        
        if($create){
            return redirect('/mhs');
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

        return redirect('/mhs');
    }
    
}