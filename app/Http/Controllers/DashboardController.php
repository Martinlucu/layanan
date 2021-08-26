<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashcuti()
    {
        //line chart
        $from = date('2021-06-01');
        $to = date('2021-06-30');
        $from1 = date('2021-04-01');
        $to1 = date('2021-04-30');
        $from2 = date('2021-05-01');
        $to2 = date('2021-05-30');
        $from3 = date('2021-07-01');
        $to3 = date('2021-07-30');
         //donut chart
    	$si = DB::table('dokumen')->where('jurusan','S1 Sistem Informasi')->where('jenis','Cuti')->where('status','selesai')->whereBetween('created_at',[$from1,$to3])->count();
    	$sk = DB::table('dokumen')->where('jurusan','S1 Sistem Komputer')->where('jenis','Cuti')->where('status','selesai')->whereBetween('created_at',[$from1,$to3])->count();
    	$d3 = DB::table('dokumen')->where('jurusan','D3 Sistem Informasi')->where('jenis','Cuti')->where('status','selesai')->whereBetween('created_at',[$from1,$to3])->count();
    	$sa = DB::table('dokumen')->where('jurusan','S1 Akutansi')->where('jenis','Cuti')->where('status','selesai')->whereBetween('created_at',[$from1,$to3])->count();
    	$dkv = DB::table('dokumen')->where('jurusan','S1 Desain Komunikasi Visual')->where('jenis','Cuti')->where('status','selesai')->whereBetween('created_at',[$from1,$to3])->count();
    	$dp = DB::table('dokumen')->where('jurusan','S1 Desain Produk')->where('jenis','Cuti')->where('status','selesai')->whereBetween('created_at',[$from1,$to3])->count();
    	$pft = DB::table('dokumen')->where('jurusan','S1 Produksi Film Dan Telivisi')->where('jenis','Cuti')->where('status','selesai')->whereBetween('created_at',[$from1,$to3])->count();
        
    	$juni = DB::table('dokumen')->whereBetween('created_at',[$from,$to])->where('jenis','Cuti')->where('status','selesai')->count();
    	$april = DB::table('dokumen')->whereBetween('created_at',[$from1,$to1])->where('jenis','Cuti')->where('status','selesai')->count();
    	$mei = DB::table('dokumen')->whereBetween('created_at',[$from2,$to2])->where('jenis','Cuti')->where('status','selesai')->count();
    	$juli = DB::table('dokumen')->whereBetween('created_at',[$from3,$to3])->where('jenis','Cuti')->where('status','selesai')->count();
    	//$agustus = DB::table('dokumen')->whereBetween('created_at',[$from,$to])->where('jenis','Cuti')->count();
        $set = DB::table('setting')->where('id_set','1')->get();
        foreach($set as $s)
        $date = date("Y-m-d",strtotime("-$s->cuti day"));
        $cutimaha = DB::table('dokumen')->where('jenis','Cuti')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->get();
        
        $hit = DB::table('dokumen')->wheredate('created_at','<=',$date)->where('jenis','Cuti')->where('status','proses')->count();
        $cut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->get();
        return view('dashcuti',compact('cut','hit','set','si','sk','d3','sa','dkv','dp','pft',
        'april','mei','juni','juli','cutimaha'));
    	
    }
    public function dashdispen()
    {	
        $from = date('2021-06-01');
        $to = date('2021-06-30');
        $from1 = date('2021-04-01');
        $to1 = date('2021-04-30');
        $from2 = date('2021-05-01');
        $to2 = date('2021-05-30');
        $from3 = date('2021-07-01');
        $to3 = date('2021-07-30');
    	$juni = DB::table('dokumen')->whereBetween('created_at',[$from,$to])->where('jenis','Dispensasi')->where('status','selesai')->count();
    	$april = DB::table('dokumen')->whereBetween('created_at',[$from1,$to1])->where('jenis','Dispensasi')->where('status','selesai')->count();
    	$mei = DB::table('dokumen')->whereBetween('created_at',[$from2,$to2])->where('jenis','Dispensasi')->where('status','selesai')->count();
    	$juli = DB::table('dokumen')->whereBetween('created_at',[$from3,$to3])->where('jenis','Dispensasi')->where('status','selesai')->count();

        $si = DB::table('dokumen')->where('jurusan','S1 Sistem Informasi')->where('jenis','Dispensasi')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$sk = DB::table('dokumen')->where('jurusan','S1 Sistem Komputer')->where('jenis','Dispensasi')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$d3 = DB::table('dokumen')->where('jurusan','D3 Sistem Informasi')->where('jenis','Dispensasi')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$sa = DB::table('dokumen')->where('jurusan','S1 Akutansi')->where('jenis','Dispensasi')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$dkv = DB::table('dokumen')->where('jurusan','S1 Desain Komunikasi Visual')->where('jenis','Dispensasi')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$dp = DB::table('dokumen')->where('jurusan','S1 Desain Produk')->where('jenis','Dispensasi')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$pft = DB::table('dokumen')->where('jurusan','S1 Produksi Film Dan Telivisi')->where('jenis','Dispensasi')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
        
        $set = DB::table('setting')->where('id_set','1')->get();
        foreach($set as $s)
        $disp = DB::table('dokumen')->whereBetween('created_at',[$from1,$to3])->where('jenis','Dispensasi')->where('status','proses')->count();
        $date = date("Y-m-d",strtotime("-$s->dispensasi day"));
        $hit = DB::table('dokumen')->wheredate('created_at','<=',$date)->where('jenis','Dispensasi')->where('status','proses')->count();

        $dispmaha = DB::table('dokumen')->whereBetween('created_at',[$from1,$to3])->where('jenis','Dispensasi')->where('status','selesai')->get();
        $dis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
        
        return view('dashdispen',compact('dis','hit','set','si','sk','d3','sa','dkv','dp',
        'pft','april','mei','juni','juli','disp','dispmaha'));
    }
    public function dashbst()
    {
        $from = date('2021-06-01');
        $to = date('2021-06-30');
        $from1 = date('2021-04-01');
        $to1 = date('2021-04-30');
        $from2 = date('2021-05-01');
        $to2 = date('2021-05-30');
        $from3 = date('2021-07-01');
        $to3 = date('2021-07-30');
        $to4 = date('2021-08-30');
    	$juni = DB::table('dokumen')->whereBetween('created_at',[$from,$to])->where('jenis','BST')->where('status','selesai')->count();
    	$april = DB::table('dokumen')->whereBetween('created_at',[$from1,$to1])->where('jenis','BST')->where('status','selesai')->count();
    	$mei = DB::table('dokumen')->whereBetween('created_at',[$from2,$to2])->where('jenis','BST')->where('status','selesai')->count();
    	$juli = DB::table('dokumen')->whereBetween('created_at',[$from3,$to3])->where('jenis','BST')->where('status','selesai')->count();

        $si = DB::table('dokumen')->where('jurusan','S1 Sistem Informasi')->where('jenis','BST')->whereBetween('created_at',[$from1,$to4])->where('status','selesai')->count();
    	$sk = DB::table('dokumen')->where('jurusan','S1 Sistem Komputer')->where('jenis','BST')->whereBetween('created_at',[$from1,$to4])->where('status','selesai')->count();
    	$d3 = DB::table('dokumen')->where('jurusan','D3 Sistem Informasi')->where('jenis','BST')->whereBetween('created_at',[$from1,$to4])->where('status','selesai')->count();
    	$sa = DB::table('dokumen')->where('jurusan','S1 Akutansi')->where('jenis','BST')->whereBetween('created_at',[$from1,$to4])->where('status','selesai')->count();
    	$dkv = DB::table('dokumen')->where('jurusan','S1 Desain Komunikasi Visual')->where('jenis','BST')->whereBetween('created_at',[$from1,$to4])->where('status','selesai')->count();
    	$dp = DB::table('dokumen')->where('jurusan','S1 Desain Produk')->where('jenis','BST')->whereBetween('created_at',[$from1,$to4])->where('status','selesai')->count();
    	$pft = DB::table('dokumen')->where('jurusan','S1 Produksi Film Dan Telivisi')->where('jenis','BST')->whereBetween('created_at',[$from1,$to4])->where('status','selesai')->count();

        $set = DB::table('setting')->where('id_set','1')->get();
        foreach($set as $s)
        $date = date("Y-m-d",strtotime("-$s->bst day"));
        $bstmaha = DB::table('dokumen')->where('jenis','BST')->whereBetween('created_at',[$from1,$to4])->where('status','selesai')->get();
        $hit = DB::table('dokumen')->wheredate('created_at','<=',$date)->where('jenis','BST')->where('status','proses')->count();
        $bst = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->get();
        return view('dashbst',compact('bst','hit','set','si','sk','d3','sa','dkv',
        'dp','pft','april','mei','juni','juli','bstmaha'));
    }
    public function dashyudi()
    {
        $from = date('2021-06-01');
        $to = date('2021-06-30');
        $from1 = date('2021-04-01');
        $to1 = date('2021-04-30');
        $from2 = date('2021-05-01');
        $to2 = date('2021-05-30');
        $from3 = date('2021-07-01');
        $to3 = date('2021-07-30');
    	$juni = DB::table('dokumen')->whereBetween('created_at',[$from,$to])->where('jenis','Yudisium')->where('status','selesai')->count();
    	$april = DB::table('dokumen')->whereBetween('created_at',[$from1,$to1])->where('jenis','Yudisium')->where('status','selesai')->count();
    	$mei = DB::table('dokumen')->whereBetween('created_at',[$from2,$to2])->where('jenis','Yudisium')->where('status','selesai')->count();
    	$juli = DB::table('dokumen')->whereBetween('created_at',[$from3,$to3])->where('jenis','Yudisium')->where('status','selesai')->count();

        $si = DB::table('dokumen')->where('jurusan','S1 Sistem Informasi')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$sk = DB::table('dokumen')->where('jurusan','S1 Sistem Komputer')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$d3 = DB::table('dokumen')->where('jurusan','D3 Sistem Informasi')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$sa = DB::table('dokumen')->where('jurusan','S1 Akutansi')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$dkv = DB::table('dokumen')->where('jurusan','S1 Desain Komunikasi Visual')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$dp = DB::table('dokumen')->where('jurusan','S1 Desain Produk')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
    	$pft = DB::table('dokumen')->where('jurusan','S1 Produksi Film Dan Telivisi')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
        
        $sts = DB::table('dokumen')->where('semester','8')->whereBetween('created_at',[$from1,$to3])->count();
        
        $ydm = DB::table('dokumen')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->get();
        $yudi = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses')->get();
        $set = DB::table('setting')->where('id_set','1')->get();
        
        return view('dashyudi',compact('yudi','set','sts','si','sk','d3','sa','dkv','dp',
        'pft','april','mei','juni','juli','ydm','ydmaha'));
    }
}
