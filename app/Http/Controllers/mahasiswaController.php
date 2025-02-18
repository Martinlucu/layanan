<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Mail\Disepnsasi;
use App\Mail\Yudisium;
use App\Mail\BST;
use App\Mail\Cuti;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;

class mahasiswaController extends Controller
{
    public function mhscuti()
    {
        $date = date(Carbon::now());
        $tanggungan = 11000000 - Auth::user()->jml_bop_dibayar;
        $tanggal_sekarang = new Carbon();
        $masuk_kuliah = new Carbon(Auth::user()->tanggal_masuk);
        $minggu_kuliah = $tanggal_sekarang->diffInWeeks($masuk_kuliah);
        
        $ctmaha = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Cuti')->where('status','proses')->get();
        $ctmahas = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Cuti')->where('status','setuju by dosen')->get();
        $ctmahass = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Cuti')->where('status','setuju by kaprodi')->get();
        $ctmahasss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Cuti')->where('status','ditolak by dosen')->get();
        $ctmahassss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Cuti')->where('status','ditolak by kaprodi')->get();
        $ctmahasssss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Cuti')->where('status','ditolak by aak')->get();
        $ctmahassssss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Cuti')->wherein('status',['update ke dosen','update ke aak'])->get();
        
        if(Auth::user()->semester >= 3 & Auth::user()->jml_pengajuan_cuti < 2 && $minggu_kuliah <= 4 && Auth::user()->status_peminjaman == "tidak ada" && $tanggungan == 0){
            return view('mhscuti', compact('ctmaha', 'ctmahas', 'ctmahass', 'ctmahasss', 'ctmahassss', 'ctmahasssss', 'ctmahassssss'));
        }elseif(Auth::user()->semester < 3 & Auth::user()->jml_pengajuan_cuti < 2 && $minggu_kuliah <= 4 && Auth::user()->status_peminjaman == "tidak ada" && $tanggungan == 0){
            return redirect('/mhs')->with('danger', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Alasan : Minimal pengajuan cuti adalah semester 3. Anda sekarang semester '.Auth::user()->semester);
        }elseif(Auth::user()->semester >= 3 & Auth::user()->jml_pengajuan_cuti > 2 && $minggu_kuliah <= 4 && Auth::user()->status_peminjaman == "tidak ada" && $tanggungan == 0){
            return redirect('/mhs')->with('danger', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Alasan : Jumlah Pengajuan cuti anda melalui batas! (Anda sudah mengajukan cuti sebanyak '.Auth::user()->jml_pengajuan_cuti.'x)');
        }elseif(Auth::user()->semester >= 3 & Auth::user()->jml_pengajuan_cuti < 2 && $minggu_kuliah > 4 && Auth::user()->status_peminjaman == "tidak ada" && $tanggungan == 0){
            return redirect('/mhs')->with('danger', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Alasan : Anda sudah melebihi minggu ke 4 perkuliahan! (perkuliahan anda masih pada minggu ke : '.$minggu_kuliah);
        }elseif(Auth::user()->semester >= 3 & Auth::user()->jml_pengajuan_cuti < 2 && $minggu_kuliah <= 4 && Auth::user()->status_peminjaman == "ada" && $tanggungan == 0){
            return redirect('/mhs')->with('danger', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Alasan : ada buku yang belum dikembalikan ke perpustakaan. Harap cek SICYCA anda!');
        }else{
            return redirect('/mhs')->with('danger', 'Mohon maaf, Anda tidak bisa mengajukan Cuti! Alasan : Anda masih memiliki tanggungan keuangan sebesar Rp. '.$tanggungan);
        }
    }

    public function lapcuti(){
        $ctmaha = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Cuti')->where('nim',Auth::user()->nim)->where('status','selesai')->orderBy('created_at', 'desc')->get();
        
        return view('mhslapcuti', compact('ctmaha'));
    }

    public function mhsdispen()
    {
    	$dpmaha = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Dispensasi')->wherein('status',['proses', 'update ke dosen', 'update ke kaprodi'])->get();
        $dpmahas = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Dispensasi')->where('status','setuju by dosen')->get();
        $dpmahass = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Dispensasi')->where('status','setuju by kaprodi')->get();
        $dpmahasss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Dispensasi')->where('status','ditolak by dosen')->get();
        $dpmahassss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Dispensasi')->where('status','ditolak by kaprodi')->get();
        $dpmahasssss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Dispensasi')->where('status','ditolak by aak')->get();
               
        return view('mhsdispen', compact('dpmaha', 'dpmahas', 'dpmahass', 'dpmahasss', 'dpmahassss', 'dpmahasssss'));
    }

    public function lapdispen()
    {
    	$dpmaha = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Dispensasi')->where('nim', Auth::user()->nim)->where('status','selesai')->orderBy('created_at', 'desc')->get();
        return view('mhslapdispen', compact('dpmaha'));
    }

    public function mhsbst()
    {
    	$tanggungan = 11000000 - Auth::user()->jml_bop_dibayar;
        
        $bsmaha = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->where('status','proses')->get();
        $bsmahas = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->where('status','setuju by dosen')->get();
        $bsmahass = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->where('status','setuju by kaprodi')->get();
        $bsmahasss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->where('status','ditolak by dosen')->get();
        $bsmahassss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->where('status','ditolak by kaprodi')->get();
        $bsmahasssss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->where('status','ditolak by aak')->get();
        $bsmahasssssss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->where('status','ditolak by keuangan')->get();
        $bsmahassssssss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->where('status','ditolak by perpustakaan')->get();
        $bsmahassssss = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->wherein('status',['update ke dosen','update ke kaprodi','update ke aak'])->get();
        
        if(Auth::user()->status_peminjaman == "tidak ada" && $tanggungan == 0){
            return view('mhsbst', compact('bsmaha', 'bsmahas', 'bsmahass', 'bsmahasss', 'bsmahassss', 'bsmahasssss', 'bsmahassssss', 'bsmahasssssss', 'bsmahassssssss'));
        }elseif(Auth::user()->status_peminjaman == "ada" && $tanggungan == 0){
            return redirect('/mhs')->with('danger', 'Mohon maaf, Anda tidak bisa mengajukan BST! Alasan : ada buku yang belum dikembalikan ke perpustakaan. Harap cek SICYCA anda!');
        }else{
            return redirect('/mhs')->with('danger', 'Mohon maaf, Anda tidak bisa mengajukan BST! Alasan : Anda masih memiliki tanggungan keuangan sebesar Rp. '.$tanggungan);
        }
    }

    public function lapbst()
    {
    	$bsmaha = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','BST')->where('nim',Auth::user()->nim)->where('status','selesai')->orderBy('created_at', 'desc')->get();
        
        return view('mhslapbst', compact('bsmaha'));
    }

    public function mhsyudi()
    {
    	$ydmaha = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Yudisium')->where('status','proses')->get();
        $ydmahas = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Yudisium')->where('status','ditolak by aak')->get();
        $ydmahass = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Yudisium')->where('status','update ke aak')->get();
        
        return view('mhsyudi', compact('ydmaha', 'ydmahas', 'ydmahass'));
    }

    public function lapyudi()
    {
    	
    	$ydmaha = DB::table('dokumen')->where('nim', Auth::user()->nim)->where('jenis','Yudisium')->where('nim',Auth::user()->nim)->where('status','selesai')->orderBy('created_at', 'desc')->get();
        
        return view('mhslapyudi', compact('ydmaha'));
    }
    
    public function verifikasifile(){
        
        // if(DB::table('dokumen')->where('id_verifikasi', $id)){
        //     $vd = DB::table('dokumen')->where('id_verifikasi', $id)->count();
        //     $vdmaha = DB::table('dokumen')->where('id_verifikasi', $id)->get();
            return view('verifikasi');            
        // }
    }
    
    public function createdispensasi(Request $request){
        $date = Carbon::now();
                
        \Mail::to('david.thehackedone@gmail.com')->send(new \App\Mail\Dispensasi);
        
            $berkas= $request->berkas_dispensasi;
            $nama_berkas = $request->file('berkas_dispensasi')->getClientOriginalName();
            
            DB::table('dokumen')->insert([
                'id_verifikasi'     => Str::random(9),
                'nim'               => Auth::user()->nim,
                'kode_dosen'        => Auth::user()->kode_dosen,
                'nama_mhs'          => Auth::user()->nama,
                'no_telp'           => Auth::user()->no_telp,
                'email_mhs'         => Auth::user()->email,
                'semester'          => Auth::user()->semester,
                'jurusan'           => Auth::user()->jurusan,
                'fakultas'          => Auth::user()->fakultas,
                'alasan_pengajuan'  => $request->alasan,
                'tanggal_absen'     => $request->tanggal_awal,
                'tanggal_masuk'     => $request->tanggal_akhir,
                'jenis'             => 'Dispensasi',
                'berkas_dispensasi' => $nama_berkas,
                'status'            => 'proses',
                'created_at'        => $date
            ]);
            
            
            // $tujuan_simpan = public_path('/berkas_mhs/'.Auth::user()->nim.'_Dispensasi');
            $tujuan_simpan = storage_path('app/public/berkas_mhs/'.Auth::user()->nim.'_Dispensasi');
            $berkas->move($tujuan_simpan, $nama_berkas);
            
           return redirect('/mhs')->with('alert', 'Pengajuan dispensasi anda berhasil di upload! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
        
        
    }

    public function edispen(Request $request, $id){
        $date = Carbon::now();
        
        if($request->berkas_dispensasi == null){
            if(DB::table('dokumen')->where('id', $id)->value('status') == 'ditolak by dosen'){
                \Mail::to('david.thehackeddone@gmail.com')->send(new \App\Mail\dispensasi_edit_ke_dosen);

                DB::table('dokumen')->where('id',$id)->update([
                    'nim'               => Auth::user()->nim,
                    'kode_dosen'        => Auth::user()->kode_dosen,
                    'nama_mhs'          => Auth::user()->nama,
                    'no_telp'           => Auth::user()->no_telp,
                    'email_mhs'         => Auth::user()->email,
                    'semester'          => Auth::user()->semester,
                    'jurusan'           => Auth::user()->jurusan,
                    'fakultas'          => Auth::user()->fakultas,
                    'alasan_pengajuan'          => $request->alasan,
                    'tanggal_absen'     => $request->absen,
                    'tanggal_masuk'     => $request->masuk,
                    'jenis'             => 'Dispensasi',
                    'status'            => 'update ke dosen',
                    'created_at'        => $date
                ]);
            }else if(DB::table('dokumen')->where('id', $id)->value('status') == 'ditolak by kaprodi'){
                \Mail::to('fadhlidzil.prakoso@gmail.com')->send(new \App\Mail\dispensasi_edit_ke_kaprodi);

                DB::table('dokumen')->where('id',$id)->update([
                    'nim'               => Auth::user()->nim,
                    'kode_dosen'        => Auth::user()->kode_dosen,
                    'nama_mhs'          => Auth::user()->nama,
                    'no_telp'           => Auth::user()->no_telp,
                    'email_mhs'         => Auth::user()->email,
                    'semester'          => Auth::user()->semester,
                    'jurusan'           => Auth::user()->jurusan,
                    'fakultas'          => Auth::user()->fakultas,
                    'tanggal_absen'     => $request->absen,
                    'tanggal_masuk'     => $request->masuk,
                    'jenis'             => 'Dispensasi',
                    'status'            => 'update ke kaprodi',
                    'created_at'        => $date
                ]);
            }
                return redirect('/mhsdispen')->with('alert', 'Pengajuan dispensasi anda telah berhasil di ubah! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
        }else{
            $berkas= $request->berkas_dispensasi;
            $nama_berkas = $request->file('berkas_dispensasi')->getClientOriginalName();
            
            if(DB::table('dokumen')->where('id', $id)->value('status') == 'ditolak by dosen'){
                \Mail::to('fadhlidzil.prakoso@gmail.com')->send(new \App\Mail\dispensasi_edit_ke_dosen);

                DB::table('dokumen')->where('id',$id)->update([
                    'nim'               => Auth::user()->nim,
                    'kode_dosen'        => Auth::user()->kode_dosen,
                    'nama_mhs'          => Auth::user()->nama,
                    'no_telp'           => Auth::user()->no_telp,
                    'email_mhs'         => Auth::user()->email,
                    'semester'          => Auth::user()->semester,
                    'jurusan'           => Auth::user()->jurusan,
                    'fakultas'          => Auth::user()->fakultas,
                    'tanggal_absen'     => $request->absen,
                    'tanggal_masuk'     => $request->masuk,
                    'jenis'             => 'Dispensasi',
                    'berkas_dispensasi' => $nama_berkas,
                    'status'            => 'update ke dosen',
                    'created_at'        => $date
                ]);
            }else if(DB::table('dokumen')->where('id', $id)->value('status') == 'ditolak by kaprodi'){
                \Mail::to('fadhlidzil.prakoso@gmail.com')->send(new \App\Mail\dispensasi_edit_ke_kaprodi);

                DB::table('dokumen')->where('id',$id)->update([
                    'nim'               => Auth::user()->nim,
                    'kode_dosen'        => Auth::user()->kode_dosen,
                    'nama_mhs'          => Auth::user()->nama,
                    'no_telp'           => Auth::user()->no_telp,
                    'email_mhs'         => Auth::user()->email,
                    'semester'          => Auth::user()->semester,
                    'jurusan'           => Auth::user()->jurusan,
                    'fakultas'          => Auth::user()->fakultas,
                    'tanggal_absen'     => $request->absen,
                    'tanggal_masuk'     => $request->masuk,
                    'jenis'             => 'Dispensasi',
                    'berkas_dispensasi' => $nama_berkas,
                    'status'            => 'update ke kaprodi',
                    'created_at'        => $date
                ]);
            }
            
                // $tujuan_simpan = public_path('/berkas_mhs/'.Auth::user()->nim.'_Dispensasi');
                $tujuan_simpan = storage_path('app/public/berkas_mhs/'.Auth::user()->nim.'_Dispensasi');
                $berkas->move($tujuan_simpan, $nama_berkas);
                
                return redirect('/mhsdispen')->with('alert', 'Pengajuan dispensasi anda telah berhasil di ubah! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
            }
    }

    public function createyudi(Request $request){
        $date = Carbon::now();
        $sskm = $request->sskm;
        $toefl = $request->berkas_toefl;
        $ijazah_sma = $request->berkas_ijazah_sma;
        $akta = $request->berkas_akta;
        $kk = $request->berkas_kk;
        $ktm = $request->berkas_ktm;
        $ktp = $request->berkas_ktp;

        $nama_sskm = $request->file('sskm')->getClientOriginalName();
        $nama_toefl = $request->file('berkas_toefl')->getClientOriginalName();
        $nama_ijazah = $request->file('berkas_ijazah_sma')->getClientOriginalName();
        $nama_akta = $request->file('berkas_akta')->getClientOriginalName();
        $nama_kk = $request->file('berkas_kk')->getClientOriginalName();
        $nama_ktm = $request->file('berkas_ktm')->getClientOriginalName();
        $nama_ktp = $request->file('berkas_ktp')->getClientOriginalName();

        \Mail::to('howland2nd@gmail.com')->send(new \App\Mail\Yudisium);

        DB::table('dokumen')->insert([
            'id_verifikasi'     => Str::random(9),
            'nim'            => Auth::user()->nim,
            'kode_dosen'     => Auth::user()->kode_dosen,
            'nama_mhs'       => Auth::user()->nama,
            'tempat_lahir'   => Auth::user()->tempat_lahir,
            'tanggal_lahir'  => Auth::user()->tanggal_lahir,
            'no_ktp'         => Auth::user()->no_ktp,
            'alamat'         => Auth::user()->alamat,
            'no_telp'        => $request->no_telp,
            'email_mhs'      => Auth::user()->email,
            'semester'       => Auth::user()->semester,
            'jurusan'        => Auth::user()->jurusan,
            'fakultas'       => Auth::user()->fakultas,
            'jenis'          => 'Yudisium',
            'berkas_sskm'    => $nama_sskm,
            'berkas_toefl'   => $nama_toefl,
            'berkas_ijazah'  => $nama_ijazah,
            'berkas_akta'    => $nama_akta,
            'berkas_kk'      => $nama_kk,
            'berkas_ktm'     => $nama_ktm,
            'berkas_ktp'     => $nama_ktp,
            'status'         => 'proses',
            'created_at'     => $date
        ]);
        
        // $tujuan_simpan = public_path('/berkas_mhs/'.Auth::user()->nim.'_Yudisium');
        // $tujuan_simpan = storage_path('app/public/berkas_mhs/'.Auth::user()->nim.'_Yudisium');
        $tujuan_simpan = storage_path('app/public/berkas_mhs/'.Auth::user()->nim.'_Yudisium');
        
        $sskm->move($tujuan_simpan, $nama_sskm);
        $toefl->move($tujuan_simpan, $nama_toefl);
        $ijazah_sma->move($tujuan_simpan, $nama_ijazah);
        $akta->move($tujuan_simpan, $nama_akta);
        $kk->move($tujuan_simpan, $nama_kk);
        $ktm->move($tujuan_simpan, $nama_ktm);
        $ktp->move($tujuan_simpan, $nama_ktp);
        
        return redirect('/mhs')->with('alert', 'Berkas yudisium anda telah berhasil diupload! Tetap cek notifikasi untuk mengetahui kabar selanjutnya.');
    }

    public function eyudi(Request $request, $id){
        $date = Carbon::now();
        $sskm = $request->sskm;
        $toefl = $request->toefl;
        $ijazah_sma = $request->ijazah_sma;
        $akta = $request->akta;
        $kk = $request->kk;
        $ktm = $request->ktm;
        $ktp = $request->ktp;

        $nama_sskm = $request->file('sskm')->getClientOriginalName();
        $nama_toefl = $request->file('toefl')->getClientOriginalName();
        $nama_ijazah = $request->file('ijazah_sma')->getClientOriginalName();
        $nama_akta = $request->file('akta')->getClientOriginalName();
        $nama_kk = $request->file('kk')->getClientOriginalName();
        $nama_ktm = $request->file('ktm')->getClientOriginalName();
        $nama_ktp = $request->file('ktp')->getClientOriginalName();

        \Mail::to('howland2nd@gmail.com')->send(new \App\Mail\yudisium_edit_ke_aak);

        DB::table('dokumen')->where('id', $id)->update([
            'nim'            => $request->nim,
            'kode_dosen'     => Auth::user()->kode_dosen,
            'nama_mhs'       => $request->nama,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'no_ktp'         => $request->no_ktp,
            'alamat'         => $request->alamat,
            'no_telp'        => $request->no_telp,
            'email_mhs'      => $request->email,
            'semester'       => Auth::user()->semester,
            'jurusan'        => Auth::user()->jurusan,
            'fakultas'       => Auth::user()->fakultas,
            'jenis'          => 'Yudisium',
            'berkas_sskm'    => $nama_sskm,
            'berkas_toefl'   => $nama_toefl,
            'berkas_ijazah'  => $nama_ijazah,
            'berkas_akta'    => $nama_akta,
            'berkas_kk'      => $nama_kk,
            'berkas_ktm'     => $nama_ktm,
            'berkas_ktp'     => $nama_ktp,
            'status'         => 'update ke aak',
            'created_at'     => $date
        ]);
        
       
        
        // $tujuan_simpan = public_path('/berkas_mhs/'.Auth::user()->nim.'_Yudisium');
        $tujuan_simpan = storage_path('app/public/berkas_mhs/'.$request_nim.'_Yudisium');
        
        $sskm->move($tujuan_simpan, $nama_sskm);
        $toefl->move($tujuan_simpan, $nama_toefl);
        $ijazah_sma->move($tujuan_simpan, $nama_ijazah);
        $akta->move($tujuan_simpan, $nama_akta);
        $kk->move($tujuan_simpan, $nama_kk);
        $ktm->move($tujuan_simpan, $nama_ktm);
        $ktp->move($tujuan_simpan, $nama_ktp);
        
        return redirect('/mhsyudi')->with('alert', 'Berkas yudisium anda telah berhasil di ubah! Tetap cek notifikasi untuk mengetahui kabar selanjutnya.');
    }

    
    public function createbss(Request $request){
        $date = date(Carbon::now());    
        \Mail::to('david.thehackedone@gmail.com')->send(new \App\Mail\Cuti);
        
        
            DB::table('dokumen')->insert([
                'id_verifikasi'     => Str::random(9),
                'nim'               => Auth::user()->nim,
                'kode_dosen'        => Auth::user()->kode_dosen,
                'nama_mhs'          => Auth::user()->nama,
                'no_telp'           => Auth::user()->no_telp,
                'email_mhs'         => Auth::user()->email,
                'semester'          => Auth::user()->semester,
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
        
            
    }

    public function ecuti(Request $request, $id){
        $date = date(Carbon::now());

        if(DB::table('dokumen')->where('id', $id)->value('status') == 'ditolak by dosen'){
            \Mail::to('david.thehackedone@gmail.com')->send(new \App\Mail\cuti_edit_ke_dosen);
            DB::table('dokumen')->where('id', $id)->update([
                'nim'               => Auth::user()->nim,
                'kode_dosen'        => Auth::user()->kode_dosen,
                'nama_mhs'          => Auth::user()->nama,
                'no_telp'           => Auth::user()->no_telp,
                'email_mhs'         => Auth::user()->email,
                'semester'          => Auth::user()->semester,
                'jurusan'           => Auth::user()->jurusan,
                'fakultas'          => Auth::user()->fakultas,
                'alasan_pengajuan'  => $request->alasan,
                'jenis'             => 'Cuti',
                'status'            => 'update ke dosen',
                'created_at'            => $date,                
            ]);

        }

        return redirect('/mhscuti')->with('alert', 'Pengajuan Cuti anda telah berhasil di edit! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
        
    }


    public function createbst(Request $request){
        $date = date(Carbon::now());
        

        \Mail::to('david.thehackedone@gmail.com')->send(new \App\Mail\BST);
        
        
            DB::table('dokumen')->insert([
                'id_verifikasi'     => Str::random(9),
                'nim'               => Auth::user()->nim,
                'kode_dosen'        => Auth::user()->kode_dosen,
                'nama_mhs'          => Auth::user()->nama,
                'no_telp'           => Auth::user()->no_telp,
                'email_mhs'         => Auth::user()->email,
                'semester'          => Auth::user()->semester,
                'jurusan'           => Auth::user()->jurusan,
                'fakultas'          => Auth::user()->fakultas,
                'alasan_pengajuan'  => $request->alasan,
                'jenis'             => 'BST',
                'status'            => 'proses',
                'created_at'            => $date
            ]);

            return redirect('/mhs')->with('alert', 'Permohonan BST anda telah berhasil di upload! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
    }

    public function ebst(Request $request, $id){
        $date = date(Carbon::now());
        
        if(DB::table('dokumen')->where('id', $id)->value('status') == 'ditolak by dosen'){
            \Mail::to('david.thehackedone@gmail.com')->send(new \App\Mail\bst_edit_ke_dosen);
            DB::table('dokumen')->where('id', $id)->update([
                'nim'               => Auth::user()->nim,
                'kode_dosen'        => Auth::user()->kode_dosen,
                'nama_mhs'          => Auth::user()->nama,
                'no_telp'           => Auth::user()->no_telp,
                'email_mhs'         => Auth::user()->email,
                'semester'          => Auth::user()->semester,
                'jurusan'           => Auth::user()->jurusan,
                'fakultas'          => Auth::user()->fakultas,
                'alasan_pengajuan'  => $request->alasan,
                'jenis'             => 'BST',
                'status'            => 'update ke dosen',
                'created_at'            => $date
            ]);
        }elseif(DB::table('dokumen')->where('id', $id)->value('status') == 'ditolak by kaprodi'){
            \Mail::to('howland2nd@gmail.com')->send(new \App\Mail\bst_edit_ke_kaprodi);
            DB::table('dokumen')->where('id', $id)->update([
                'nim'               => Auth::user()->nim,
                'nama_mhs'          => Auth::user()->nama,
                'no_telp'           => Auth::user()->no_telp,
                'email_mhs'         => Auth::user()->email,
                'semester'          => Auth::user()->semester,
                'jurusan'           => Auth::user()->jurusan,
                'fakultas'          => Auth::user()->fakultas,
                'alasan_pengajuan'  => $request->alasan,
                'jenis'             => 'BST',
                'status'            => 'update ke kaprodi',
                'created_at'            => $date
            ]);
        }
        
        return redirect('/mhsbst')->with('alert', 'Permohonan BST anda telah berhasil di edit! Harap menunggu pihak terkait untuk menyetujui pengajuan anda. Tetap cek notifikasi');
    }
    
}