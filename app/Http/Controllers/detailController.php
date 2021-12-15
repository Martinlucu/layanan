<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class detailController extends Controller
{
    public function detyudi()
    {
        $ydm = DB::table('dokumen')->where('status','proses')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses')->get();
        return view('detyudi',compact('ydm','ydmaha'));
}

    public function dosdetyudi()
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $ydm = DB::table('dokumen')->where('status','proses')->count();
            $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','Proses')->get();
            return view('dosdetyudi',compact('ydm','ydmaha'));
        }else{
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $ydm = DB::table('dokumen')->where('status','proses')->count();
            $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','setuju by dosen')->get();
            return view('dosdetyudi',compact('ydm','ydmaha'));
        }
        
}

    public function dosdetcuti()
    { 
        $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ct = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->count();
        $ctmaha = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->get();
        return view('dosdetcuti',compact('ct','ctmaha'));
}

    public function dosdetbst()
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $bs = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->count();
            $bsmaha = DB::table('dokumen')->where('jenis','BST')->where('status','Proses')->get();
            return view('dosdetbst',compact('bs','bsmaha'));
        }else{
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $bs = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->count();
            $bsmaha = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->get();
            return view('dosdetbst',compact('bs','bsmaha'));
        }
}

    public function detdispen()
    {
        $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
        $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
        return view('detdispen',compact('dpmaha','dp'));
}

    public function dosdetdispen()
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $from = date('2021-04-01');
            $to = date('2021-07-30');   
            $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
            $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','Proses')->get();
            return view('dosdetdispen',compact('dpmaha','dp'));
        }else{
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
            $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by dosen')->get();
            return view('dosdetdispen',compact('dpmaha','dp'));
        }
        
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
    if(Auth::user()->jabatan == "Pengajar"){
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by dosen",
            'updated_at'=> $date
        ]);
    }else{
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "selesai",
            'updated_at'=> $date
        ]);
    }
    
    return redirect('/dosdetbst');
}

public function stjdis($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "Proses",
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }

public function dosstjdis($id)
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $date = date("Y-m-d");
            DB::table('dokumen')->where('id',$id)->update([
                'status' => "setuju by dosen",
                'updated_at'=> $date
            ]);
        }else{
            $date = date("Y-m-d");
            DB::table('dokumen')->where('id',$id)->update([
                'status' => "selesai",
                'updated_at'=> $date
            ]);
        }
        
        return redirect('/dosdetdispen');
    }

    
public function stjyudi($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "Proses",
            'updated_at'=> $date
        ]);
    
        return redirect('/detyudi');
    }

    public function dosstjyudi($id)
{
    if(Auth::user()->jabatan == "Pengajar"){
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by dosen",
            'updated_at'=> $date
        ]);
    }else{
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "selesai",
            'updated_at'=> $date
        ]);
    }
    
    return redirect('/dosdetyudi');
}

public function dostlkcuti($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by dosen",
            'updated_at'=> $date
        ]);
    
        return redirect('/dosdetcuti');
    }

public function tlkdis($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by aak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }

    public function dostlkdis($id)
    {
        if(Auth::user()->jurusan == "Pengajar"){
            $date = date("Y-m-d");
            DB::table('dokumen')->where('id',$id)->update([
                'status' => "ditolak by dosen",
                'updated_at'=> $date
            ]);
        }else{
            $date = date("Y-m-d");
            DB::table('dokumen')->where('id',$id)->update([
                'status' => "ditolak by kaprodi",
                'updated_at'=> $date
            ]);
        }
        
        return redirect('/dosdetdispen');
    }


    public function tlkyudi($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by aak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detyudi');
    }

    public function dostlkyudi($id)
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $date = date("Y-m-d");
            DB::table('dokumen')->where('id',$id)->update([
                'status' => "ditolak by dosen",
                'updated_at'=> $date
            ]);
        }else{
            $date = date("Y-m-d");
            DB::table('dokumen')->where('id',$id)->update([
                'status' => "ditolak by kaprodi",
                'updated_at'=> $date
            ]);
        }
        
        return redirect('/detyudi');
    }


    public function dostlkbst($id)
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $date = date("Y-m-d");
            DB::table('dokumen')->where('id',$id)->update([
                'status' => "ditolak by dosen",
                'updated_at'=> $date
            ]);
        }else{
            $date = date("Y-m-d");
            DB::table('dokumen')->where('id',$id)->update([
                'status' => "ditolak by kaprodi",
                'updated_at'=> $date
            ]);
        }
        
        return redirect('/dosdetbst');
    }

}
