<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Mail\Disepnsasi;
use App\Mail\Yudisium;
use App\Mail\BST;
use App\Mail\Cuti;

class KeuanganController extends Controller
{
    public function home(){
        return view('keuanganhome');
    }

    public function keuanganbst(){
        $kbst = DB::table('dokumen')->where('jenis', 'BST')->where('status', 'setuju by kaprodi')->count();
        $kbstt = DB::table('dokumen')->where('jenis', 'BST')->where('status', 'setuju by kaprodi')->get();
        
        $kbstm = DB::table('dokumen')->where('jenis', 'BST')->get();

        return view('keuanganbst', compact('kbst', 'kbstt', 'kbstm'));
    }

    public function stjbst($id)
    {
        $date = date("Y-m-d H:i:s");
        
        \Mail::to('david.thehackedone@gmail.com')->send(new \App\Mail\BST_keuangan_stj);

        DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju by keuangan",
        'updated_at'=> $date
        ]);
    
        return redirect('/keuanganbst');
    }

    public function tlkbst(Request $request, $id)
    {
        $date = date("Y-m-d H:i:s");
        
        \Mail::to('david.thehackedone@gmail.com')->send(new \App\Mail\BST_keuangan_tlk);

        DB::table('dokumen')->where('id',$id)->update([
        'status' => "ditolak by keuangan",
        'alasan_penolakan' => $request->alasan,
        'updated_at'=> $date
        ]);
    
        return redirect('/keuanganbst');
    }
}
