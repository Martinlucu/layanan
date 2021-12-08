<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class detailController extends Controller
{
    public function detyudi()
    {
        $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ydm = DB::table('dokumen')->where('status','proses')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses')->get();
        return view('detyudi',compact('ydm','ydmaha'));
}

    public function dosdetyudi()
    {
        $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ydm = DB::table('dokumen')->where('status','proses')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses')->get();
        return view('detyudi',compact('ydm','ydmaha'));
}

    public function kapdetyudi()
    {
        $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ydm = DB::table('dokumen')->where('status','proses')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses')->get();
        return view('detyudi',compact('ydm','ydmaha'));
}

    public function dosdetcuti()
    { $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ct = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->count();
        $ctmaha = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->get();
        return view('detcuti',compact('ct','ctmaha'));
}

    public function dosdetbst()
    {$from = date('2021-04-01');
        $to = date('2021-07-30');
        $bs = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->count();
        $bsmaha = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->get();
        return view('detbst',compact('bs','bsmaha'));
}

    public function detdispen()
    {$from = date('2021-04-01');
        $to = date('2021-07-30');
        $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
        $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
        return view('detdispen',compact('dpmaha','dp'));
}

    public function dosdetdispen()
    {$from = date('2021-04-01');
        $to = date('2021-07-30');
        $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
        $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
        return view('detdispen',compact('dpmaha','dp'));
}

    public function kapdetdispen()
        {$from = date('2021-04-01');
            $to = date('2021-07-30');
            $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
            $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
            return view('detdispen',compact('dpmaha','dp'));
}
public function dosstjcuti($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "selesai",
            'updated_at'=> $date
        ]);
    
        return redirect('/dosdetcuti');
    }
    
public function dosstjbst($id)
{
    $date = date("Y-m-d");
    DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju oleh dosen",
        'updated_at'=> $date
    ]);

    return redirect('/dosdetbst');
}

public function kapstjbst($id)
{
    $date = date("Y-m-d");
    DB::table('dokumen')->where('id',$id)->update([
        'status' => "selesai",
        'updated_at'=> $date
    ]);

    return redirect('/detbst');
}

public function stjdis($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by dosen",
            'updated_at'=> $date
        ]);
    
        return redirect('/dosdetdispen');
    }

public function dosstjdis($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by dosen",
            'updated_at'=> $date
        ]);
    
        return redirect('/dosdetdispen');
    }

public function kapstjdis($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by dosen",
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }
    
public function stjyudi($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by dosen",
            'updated_at'=> $date
        ]);
    
        return redirect('/dosdetyudi');
    }

    public function dosstjyudi($id)
{
    $date = date("Y-m-d");
    DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju by dosen",
        'updated_at'=> $date
    ]);

    return redirect('/dosdetyudi');
}

public function kapdosstjyudi($id)
{
    $date = date("Y-m-d");
    DB::table('dokumen')->where('id',$id)->update([
        'status' => "selesai",
        'updated_at'=> $date
    ]);

    return redirect('/detyudi');
}
    public function dostlkcuti($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/dosdetcuti');
    }

public function tlkdis($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }

    public function dostlkdis($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }

    public function kaptlkdis($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }

    public function tlkyudi($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detyudi');
    }

    public function dostlkyudi($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detyudi');
    }

    public function kaptlkyudi($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detyudi');
    }

    public function dostlkbst($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detbst');
    }

    public function kaptlkbst($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detbst');
    }
}
