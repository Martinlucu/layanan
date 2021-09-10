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
            'nim' => Auth::user()->nim,
            'nama_mhs' => Auth::user()->nama,
            'tempat_lahir' => Auth::user()->tempat_lahir,
            'tanggal_lahir' => Auth::user()->tanggal_lahir,
            'no_telp' => Auth::user()->no_telp,
            'email_mhs' => Auth::user()->email,
            'semester' => Auth::user()->semester,
            'angkatan' => Auth::user()->angkatan,
            'jurusan' => Auth::user()->jurusan,
            'fakultas' => Auth::user()->fakultas,
            'alasan_pengajuan' => $request->alasan,
            'jenis' => 'Cuti',
            'status' => 'Proses'
        ]);

        return redirect('/mhs');
    }

    public function createyudi(Request $request){
        DB::table('dokumen')->insert([
            'nim' => Auth::user()->nim,
            'nama_mhs' => Auth::user()->nama,
            'tempat_lahir' => Auth::user()->tempat_lahir,
            'tanggal_lahir' => Auth::user()->tanggal_lahir,
            'no_telp' => Auth::user()->no_telp,
            'no_ktp' => $request->ktp,
            'email' => Auth::user()->email,
            'alamat' => Auth::user()->alamat,
            'semester' => Auth::user()->semester,
            'angkatan' => Auth::user()->angkatan,
            'jurusan' => Auth::user()->jurusan,
            'fakultas' => Auth::user()->fakultas,
            'jenis' => 'Yudisium',
            'berkas' => $request->foto,
            'berkas' => $request->toefl,
            'berkas' => $request->ijazah_sma,
            'berkas' => $request->akta,
            'berkas' => $request->kk,
            'berkas' => $request->ktm,
            'berkas' => $request->ktp,
            'status' => 'Proses'
        ]);
        
        return redirect('/mhs');
    }

    public function createdispensasi(Request $request){
        $create = DB::table('dokumen')->insert([
            'nim' => Auth::user()->nim,
            'nama_mhs' => Auth::user()->nama,
            'tempat_lahir' => Auth::user()->tempat_lahir,
            'tanggal_lahir' => Auth::user()->tanggal_lahir,
            'no_telp' => Auth::user()->no_telp,
            'email' => Auth::user()->email,
            'alamat' => Auth::user()->alamat,
            'semester' => Auth::user()->semester,
            'angkatan' => Auth::user()->angkatan,
            'jurusan' => Auth::user()->jurusan,
            'fakultas' => Auth::user()->fakultas,
            'tanggal_absen' => $request->absen,
            'tanggal_masuk' => $request->masuk,
            'jenis' => 'Dispensasi',
            'berkas' => $request->surat,
            'status' => 'Proses'
        ]);

        if($create){
            return redirect('/mhs');
        }
    }

    public function createbst(Request $request){
        DB::table('dokumen')->insert([
            'nim' => Auth::user()->nim,
            'nama_mhs' => Auth::user()->nama,
            'tempat_lahir' => Auth::user()->tempat_lahir,
            'tanggal_lahir' => Auth::user()->tanggal_lahir,
            'no_telp' => Auth::user()->no_telp,
            'email_mhs' => Auth::user()->email,
            'semester' => Auth::user()->semester,
            'angkatan' => Auth::user()->angkatan,
            'jurusan' => Auth::user()->jurusan,
            'fakultas' => Auth::user()->fakultas,
            'alasan_pengajuan' => $request->alasan,
            'jenis' => 'BST',
            'status' => 'Proses'
        ]);

        return redirect('/mhs');
    }
    
}