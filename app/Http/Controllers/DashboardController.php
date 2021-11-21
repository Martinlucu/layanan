<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashcuti()
    {
        $tanggal = DB::table('dokumen')
        ->select(DB::raw('MONTHNAME(created_at) AS month'))
        ->where('status','selesai')->whereyear('created_at',2021)->where('jenis','Cuti')->orderBy('created_at','ASC')
        ->groupBy(DB::raw('month'))->pluck('month');  

        $tes = DB::table('dokumen')
        ->select(DB::raw('count(*) as count, YEAR(created_at) as year,MONTH(created_at) as month'))
        ->where('status','selesai')->where('jenis','Cuti')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('year,month'))->pluck('count');  

        $dia = DB::table('dokumen')
        ->select(DB::raw('jurusan as js'))
        ->whereyear('created_at',2021)
        ->where('status','selesai')->where('jenis','Cuti')
        ->groupBy(DB::raw('js'))
        ->orderBy('js','asc')
        ->pluck('js');  
        
        $isid = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Cuti')
        ->whereyear('created_at',2021)
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  



        
        $set = DB::table('setting')->where('id_set','1')->get();
        foreach($set as $s)
        $date = date("Y-m-d",strtotime("-$s->cuti day"));
        $cutimaha = DB::table('dokumen')->where('jenis','Cuti')->whereyear('created_at',2021)->where('status','selesai')->orderBy('jurusan','asc')->get();
        
        $hit = DB::table('dokumen')->wheredate('created_at','<=',$date)->where('jenis','Cuti')->where('status','proses')->count();
        $cut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->orderBy('jurusan','asc')->get();
        $datecut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->orderBy('created_at','desc')->get();
        return view('dashcuti',compact('datecut','tanggal','tes','dia','isid','cut','hit','set','cutimaha'));
    	
    }
    public function dashdispen()
    {	
        $tanggal = DB::table('dokumen')
        ->select(DB::raw('MONTHNAME(created_at) AS month'))
        ->where('status','selesai')->whereyear('created_at',2021)->where('jenis','Dispensasi')->orderBy('created_at','ASC')
        ->groupBy(DB::raw('month'))->pluck('month');  

        $tes = DB::table('dokumen')
        ->select(DB::raw('count(*) as count, YEAR(created_at) as year,MONTH(created_at) as month'))
        ->where('status','selesai')->where('jenis','Dispensasi')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('year,month'))->pluck('count');  

        $dia = DB::table('dokumen')
        ->select(DB::raw('jurusan as js'))
        ->whereyear('created_at',2021)
        ->where('status','selesai')->where('jenis','Dispensasi')
        ->groupBy(DB::raw('js'))
        ->orderBy('js','asc')
        ->pluck('js');  
        
        $isid = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Dispensasi')
        ->whereyear('created_at',2021)
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  
            

        $set = DB::table('setting')->where('id_set','1')->get();
        foreach($set as $s)
        $disp = DB::table('dokumen')->whereyear('created_at',2021)->where('jenis','Dispensasi')->where('status','proses')->count();
        $date = date("Y-m-d",strtotime("-$s->dispensasi day"));
        $hit = DB::table('dokumen')->wheredate('created_at','<=',$date)->where('jenis','Dispensasi')->where('status','proses')->count();

        $dispmaha = DB::table('dokumen')->whereyear('created_at',2021)->where('jenis','Dispensasi')->where('status','selesai')->orderBy('jurusan','asc')->get();
        $dis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->orderBy('jurusan','asc')->get();
        $datedis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->orderBy('created_at','desc')->get();
        
        return view('dashdispen',compact('datedis','dis','hit','set','disp','dispmaha','tanggal','tes','dia','isid'));
    }
    public function dashbst()
    {
        $tanggal = DB::table('dokumen')
        ->select(DB::raw('MONTHNAME(created_at) AS month'))
        ->where('status','selesai')->where('jenis','BST')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('month'))->pluck('month');  

        $tes = DB::table('dokumen')
        ->select(DB::raw('count(*) as count, YEAR(created_at) as year,MONTH(created_at) as month'))
        ->where('status','selesai')->where('jenis','BST')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('year,month'))->pluck('count');  

        $dia = DB::table('dokumen')
        ->select(DB::raw('jurusan as js'))
        ->whereyear('created_at',2021)
        ->where('status','selesai')->where('jenis','BST')
        ->groupBy(DB::raw('js'))
        ->orderBy('js','asc')
        ->pluck('js');  
        
        $isid = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','BST')
        ->whereyear('created_at',2021)
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');


        $set = DB::table('setting')->where('id_set','1')->get();
        foreach($set as $s)
        $date = date("Y-m-d",strtotime("-$s->bst day"));
        $bstmaha = DB::table('dokumen')->where('jenis','BST')->whereyear('created_at',2021)->where('status','selesai')->orderBy('jurusan','asc')->get();
        $hit = DB::table('dokumen')->wheredate('created_at','<=',$date)->where('jenis','BST')->where('status','proses')->count();
        $bst = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->whereyear('created_at',2021)->orderBy('jurusan','asc')->get();
        $datebst = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->whereyear('created_at',2021)->orderBy('created_at','desc')->get();
        return view('dashbst',compact('datebst','tanggal','tes','dia','isid','bst','hit','set','bstmaha'));
    }
    public function dashyudi()
    {
        $tanggal = DB::table('dokumen')
        ->select(DB::raw('MONTHNAME(created_at) AS month'))
        ->where('status','selesai')->where('jenis','Yudisium')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('month'))->pluck('month');  

        $tes = DB::table('dokumen')
        ->select(DB::raw('count(*) as count, YEAR(created_at) as year,MONTH(created_at) as month'))
        ->where('status','selesai')->where('jenis','Yudisium')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('year,month'))->pluck('count');  

        $dia = DB::table('dokumen')
        ->select(DB::raw('jurusan as js'))
        ->whereyear('created_at',2021)
        ->where('status','selesai')->where('jenis','Yudisium')
        ->groupBy(DB::raw('js'))
        ->orderBy('js','asc')
        ->pluck('js');  
        
        $isid = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Yudisium')
        ->whereyear('created_at',2021)
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');
       
        $sts = DB::table('dokumen')->where('semester','8')->whereyear('created_at',2021)->count();
        
        $ydm = DB::table('dokumen')->where('jenis','Yudisium')->whereyear('created_at',2021)->where('status','selesai')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->whereyear('created_at',2021)->where('status','selesai')->orderBy('jurusan','asc')->get();
        $yudi = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses')->orderBy('jurusan','asc')->get();
        $set = DB::table('setting')->where('id_set','1')->get();
        
        return view('dashyudi',compact('tanggal','tes','dia','isid','yudi','set','sts','ydm','ydmaha'));
    }
}
