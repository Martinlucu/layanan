<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class utamaController extends Controller
{
    public function aak()
    {
        $tanggal = DB::table('dokumen')
        ->select(DB::raw('MONTHNAME(created_at) AS month'))
        ->where('status','selesai')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('month'))->pluck('month');  
        $set = DB::table('setting')->where('id_set','1')->get();

        $isidata = DB::table('dokumen')
        ->select(DB::raw('count(*) as count, YEAR(created_at) as year,MONTH(created_at) as month'))
        ->where('status','selesai')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('year,month'))->pluck('count');  

        foreach($set as $s)
        $date2 = date("Y-m-d",strtotime("-$s->yudisium day"));
       
       
        $sts = DB::table('dokumen')->where('semester','8')->whereyear('created_at',2021)->count();
        $cuti = DB::table('dokumen')->where('status','proses')->where('jenis','Cuti')->count();
    	$yudi = DB::table('dokumen')->where('status','proses')->where('jenis','Yudisium')->count();
    	$bst = DB::table('dokumen')->where('status','proses')->where('jenis','BST')->count();
    	$dis = DB::table('dokumen')->where('status','proses')->where('jenis','Dispensasi')->count();
    	
        $laya = DB::table('dokumen')->where('status','selesai')->whereyear('created_at',2021)->orderBy('jurusan','asc')->get();
        $jumlahthnini= DB::table('dokumen')->where('status','selesai')->whereyear('created_at',2021)->count();
        $jumlahthnlalu = DB::table('dokumen')->where('status','selesai')->whereyear('created_at',2020)->count();
        $ydm = DB::table('dokumen')->where('jenis','Yudisium')->whereyear('created_at',2021)->where('status','selesai')->count();
       
        $bstindi = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->orderBy('created_at','desc')->get();
        $cutindi = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->orderBy('created_at','desc')->get();
        $disindi = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->orderBy('created_at','desc')->get();

        return view('aak',compact('disindi','cutindi','bstindi','sts','ydm','set',
        'jumlahthnlalu','cuti','yudi','bst','dis'
        ,'laya','jumlahthnini','tanggal','isidata'));
    	
    }
}
