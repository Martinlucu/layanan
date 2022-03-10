<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Mail\Disepnsasi;
use App\Mail\Yudisium;
use App\Mail\BST;
use App\Mail\Cuti;

class PerpustakaanController extends Controller
{
    public function home(){
        return view('perpushome');
    }

    public function perpusbst(){
        $pbst = DB::table('dokumen')->where('jenis', 'BST')->where('status', 'setuju by keuangan')->count();
        $pbstm = DB::table('dokumen')->where('jenis', 'BST')->where('status', 'setuju by keuangan')->get();
        
        $pbstall = DB::table('dokumen')->where('jenis', 'BST')->get();

        return view('perpustakaanbst', compact('pbst', 'pbstm', 'pbstall'));
    }

    public function stjbst($id)
    {
        $date = date("Y-m-d H:i:s");
        
        \Mail::to('david.thehackedone@gmail.com')->send(new \App\Mail\BST_perpustakaan_stj);

        DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju by perpustakaan",
        'updated_at'=> $date
        ]);
    
        return redirect('/perpustakaanbst');
    }

    public function tlkbst(Request $request, $id)
    {
        $date = date("Y-m-d H:i:s");
        
        \Mail::to('david.thehackedone@gmail.com')->send(new \App\Mail\BST_perpustakaan_tlk);

        DB::table('dokumen')->where('id',$id)->update([
        'status' => "ditolak by perpustakaan",
        'alasan_penolakan' => $request->alasan,
        'updated_at'=> $date
        ]);
    
        return redirect('/perpustakaanbst');
    }
}
