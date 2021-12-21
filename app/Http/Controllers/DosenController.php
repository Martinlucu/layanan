<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
        $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ydm = DB::table('dokumen')->where('status','proses')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->where('status','Proses')->get();
        $ydmahaa = DB::table('dokumen')->where('jenis','Yudisium')->where('status','setuju by dosen')->get();
        $ydmahas = DB::table('dokumen')->where('jenis','Yudisium')->get();
            
        return view('dosdetyudi',compact('ydm','ydmaha', 'ydmahaa','ydmahas'));
        
}

    public function detcuti()
    { 
        $from = date('2021-04-01');
        $to = date('2021-07-30');
        $ct = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->count();
        $ctmaha = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->get();
        $ctmahas = DB::table('dokumen')->where('jenis','Cuti')->get();
        
        return view('dosdetcuti',compact('ct','ctmaha', 'ctmahas'));
}

    public function detbst()
    {
        $from = date('2021-04-01');
        $to = date('2021-07-30');
        $bs = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->count();
        $bsmaha = DB::table('dokumen')->where('jenis','BST')->where('status','Proses')->get();
        $bsmahaa = DB::table('dokumen')->where('jenis','BST')->where('status','setuju by dosen')->get();
        $bsmahas = DB::table('dokumen')->where('jenis','BST')->get();
            
        return view('dosdetbst',compact('bs','bsmaha', 'bsmahaa','bsmahas'));
        
}

    public function detdispen()
        {
            $from = date('2021-04-01');
            $to = date('2021-07-30');
            $dp = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();
            $dpmaha = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
            $dpmahaa = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','setuju by dosen')->get();
            $dpmahas = DB::table('dokumen')->where('jenis','Dispensasi')->get();
            
            return view('dosdetdispen',compact('dpmaha', 'dpmahaa','dp','dpmahas'));
        }
    
    public function stjcuti($id)
        {
            
                $date = date("Y-m-d H:i:s");
                DB::table('dokumen')->where('id',$id)->update([
                'status' => "setuju by dosen",
                'updated_at'=> $date
                ]);
            
            
        
            return redirect('/dosdetcuti');
        }
    
public function stjbst($id)
{
    if(Auth::user()->jabatan == "Pengajar"){
        $date = date("Y-m-d H:i:s");
        DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju by dosen",
        'updated_at'=> $date
        ]);
    }else{
        $date = date("Y-m-d H:i:s");
        DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju by kaprodi",
        'updated_at'=> $date
    ]);
    }
    

    return redirect('/dosdetbst');
}

public function stjdis($id)
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by dosen",
            'updated_at'=> $date
            ]);
        }else{
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "setuju by kaprodi",
            'updated_at'=> $date
            ]);
        }
        
        return redirect('/dosdetdispen');
    }
    
public function stjyudi($id)
{
    if(Auth::user()->jabatan == "Pengajar"){
        $date = date("Y-m-d H:i:s");
        DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju by dosen",
        'updated_at'=> $date
        ]);
    }else{
        $date = date("Y-m-d H:i:s");
        DB::table('dokumen')->where('id',$id)->update([
        'status' => "setuju by kaprodi",
        'updated_at'=> $date
        ]);
    }
    
    return redirect('/dosdetyudi');
}
    public function tlkcuti(Request $request, $id)
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by dosen",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
            ]);
        }else{
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by kaprodi",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
            ]);
        }
        
        return redirect('/dosdetcuti');
    }
    public function tlkdis(Request $request, $id)
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by dosen",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
        }else{
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by kaprodi",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
        }
        
        return redirect('/dosdetdispen');
    }
    public function tlkyudi(Request $request, $id)
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by dosen",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
        }else{
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by kaprodi",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
        ]);
        }
        
        return redirect('/dosdetyudi');
    }

    public function tlkbst(Request $request, $id)
    {
        if(Auth::user()->jabatan == "Pengajar"){
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by dosen",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
            ]);
        }else{
            $date = date("Y-m-d H:i:s");
            DB::table('dokumen')->where('id',$id)->update([
            'status' => "ditolak by kaprodi",
            'alasan_penolakan' => $request->alasan,
            'updated_at'=> $date
            ]);
        }
        
    
        return redirect('/dosdetbst');
    }
}
