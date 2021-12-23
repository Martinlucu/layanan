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
       
        $ydm = DB::table('dokumen')->where('status','proses')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','setuju by kaprodi')->get();
        return view('detyudi',compact('ydm','ydmaha'));
}

    public function detcuti()
    { $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ct = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->count();
        $ctmaha = DB::table('dokumen')->where('jenis','Cuti')->where('status','setuju by dosen')->get();
        return view('detcuti',compact('ct','ctmaha'));
}

    public function detbst()
    {$from = date('2021-04-01');
        $to = date('2021-07-30');
        $bs = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->count();
        $bsmaha = DB::table('dokumen')->where('jenis','BST')->where('status','setuju by kaprodi')->get();
        return view('detbst',compact('bs','bsmaha'));
}

    public function detdispen()
    {$from = date('2021-04-01');
        $to = date('2021-07-30');
        $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
        $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by kaprodi')->get();
        
        return view('detdispen',compact('dpmaha','dp'));
}
public function stjcuti($id)
    {
        $date = date(Carbon::now());
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "selesai",
            'updated_at'=> $date
        ]);
    
        return redirect('/detcuti');
    }
    
public function stjbst($id)
{
    $date = date(Carbon::now());
    DB::table('dokumen')->where('id',$id)->update([
        'status' => "selesai",
        'updated_at'=> $date
    ]);

    return redirect('/detbst');
}

public function stjdis($id)
    {
        $date = date(Carbon::now());
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "selesai",
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }
    
public function stjyudi($id)
{
    $date = date(Carbon::now());
    DB::table('dokumen')->where('id',$id)->update([
        'status' => "selesai",
        'updated_at'=> $date
    ]);

    return redirect('/detyudi');
}
    public function tlkcuti(Request $request, $id)
    {
        $date = date(Carbon::now());
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
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by aak",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
    
        return redirect('/detbst');
    }
}
