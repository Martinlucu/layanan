<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class detailController extends Controller
{
    public function detyudi()
    {
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status', 'proses')->orderBy('created_at', 'DESC')->get();
        $ydmahaa = DB::table('dokumen')->where('jenis','Yudisium')->where('status', 'update ke aak')->orderBy('created_at', 'DESC')->get();

        return view('detyudi',compact('ydmaha', 'ydmahaa'));
}

    public function detcuti()
    { $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ctmaha = DB::table('dokumen')->where('jenis','Cuti')->where('status','setuju by dosen')->orderBy('created_at', 'DESC')->get();
        return view('detcuti',compact('ctmaha'));
}

    public function detbst()
    {$from = date('2021-04-01');
        $to = date('2021-07-30');
        $bsmaha = DB::table('dokumen')->where('jenis','BST')->where('status','setuju by kaprodi')->orderBy('created_at', 'DESC')->get();
        return view('detbst',compact('bsmaha'));
}

    public function detdispen()
    {$from = date('2021-04-01');
        $to = date('2021-07-30');
        $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by kaprodi')->orderBy('created_at', 'DESC')->get();
        $dpmahaa = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','update by mhs')->orderBy('created_at', 'DESC')->get();
        
        return view('detdispen',compact('dpmaha', 'dpmahaa'));
    }

    public function stjcuti($id)
    {
        $date = date(Carbon::now());
        \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\cuti_aak_stj);
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "selesai",
            'updated_at'=> $date
        ]);
    
        return redirect('/detcuti');
    }
    
public function stjbst($id)
{
    $date = date(Carbon::now());
    \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\BST_aak_stj);
    DB::table('dokumen')->where('id',$id)->update([
        'status' => "selesai",
        'updated_at'=> $date
    ]);

    return redirect('/detbst');
}

public function stjdis($id)
    {
        $date = date(Carbon::now());
        \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\dispensasi_aak_stj);
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "selesai",
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }
    
public function stjyudi($id)
{
    $date = date(Carbon::now());
    \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\yudisium_aak_stj);
    DB::table('dokumen')->where('id',$id)->update([
        'status' => "selesai",
        'updated_at'=> $date
    ]);

    return redirect('/detyudi');
}
    public function tlkcuti(Request $request, $id)
    {
        $date = date(Carbon::now());
        \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\cuti_aak_tlk);
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by aak",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
    
        return redirect('/detcuti');
    }
    public function tlkdis(Request $request, $id)
    {
        $date = date(Carbon::now());;
        \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\dispensasi_aak_tlk);
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by aak",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }
    public function tlkyudi(Request $request, $id)
    {
        $date = date(Carbon::now());;
        \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\yudisium_aak_tlk);
        
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by aak",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
    
        return redirect('/detyudi');
    }
    public function tlkbst(Request $request, $id)
    {
        $date = date(Carbon::now());;
        \Mail::to('17410100019@dinamika.ac.id')->send(new \App\Mail\BST_aak_tlk);
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by aak",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
    
        return redirect('/detbst');
    }
}
