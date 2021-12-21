<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class DosenController extends Controller
{
    public function doshome()
    {
        
    	return view('doshome');
    }

    public function detyudi()
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $ydm = DB::table('dokumen')->where('status','proses')->count();
            $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','Proses')->get();
            $ydmahas = DB::table('dokumen')->where('jenis','Yudisium')->where('status','selesai')->get();
            
            return view('dosdetyudi',compact('ydm','ydmaha','ydmahas'));
        }else{
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $ydm = DB::table('dokumen')->where('status','proses')->count();
            $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','setuju by dosen')->get();
            $ydmahas = DB::table('dokumen')->where('jenis','Yudisium')->where('status','selesai')->get();
            return view('dosdetyudi',compact('ydm','ydmaha','ydmahas'));
        }
}

    public function detcuti()
    { 
        $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ct = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->count();
        $ctmaha = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->get();
        $ctmahas = DB::table('dokumen')->where('jenis','Cuti')->where('status','selesai')->get();
        
        return view('dosdetcuti',compact('ct','ctmaha', 'ctmahas'));
}

    public function detbst()
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $bs = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->count();
            $bsmaha = DB::table('dokumen')->where('jenis','BST')->where('status','Proses')->get();
            $bsmahas = DB::table('dokumen')->where('jenis','BST')->where('status','selesai')->get();
            return view('dosdetbst',compact('bs','bsmaha','bsmahas'));
        }else{
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $bs = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->count();
            $bsmaha = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->get();
            $bsmahas = DB::table('dokumen')->where('jenis','BST')->where('status','selesai')->get();
            return view('dosdetbst',compact('bs','bsmaha','bsmahas'));
        }
}

    public function detdispen()
    {$from = date('2021-04-01');
        $to = date('2021-07-30');
        $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
        $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
        return view('detdispen',compact('dpmaha','dp'));
}
public function stjcuti($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "selesai",
            'updated_at'=> $date
        ]);
    
        return redirect('/detcuti');
    }
    
public function stjbst($id)
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
            'status' => "selesai",
            'updated_at'=> $date
        ]);
    
        return redirect('/detdispen');
    }
    
public function stjyudi($id)
{
    $date = date("Y-m-d");
    DB::table('dokumen')->where('id',$id)->update([
        'status' => "selesai",
        'updated_at'=> $date
    ]);

    return redirect('/detyudi');
}
    public function tlkcuti($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detcuti');
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
    public function tlkyudi($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detyudi');
    }
    public function tlkbst($id)
    {
        $date = date("Y-m-d");
        DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak",
            'updated_at'=> $date
        ]);
    
        return redirect('/detbst');
    }
}
