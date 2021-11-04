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
        $date1 = date("Y-m-d",strtotime("-$s->cuti day"));
        $date2 = date("Y-m-d",strtotime("-$s->yudisium day"));
        $date3 = date("Y-m-d",strtotime("-$s->bst day"));
        $date4 = date("Y-m-d",strtotime("-$s->dispensasi day"));
       
        $sts = DB::table('dokumen')->where('semester','8')->whereyear('created_at',2021)->count();
        $cuti = DB::table('dokumen')->where('status','proses')->where('jenis','Cuti')->count();
    	$yudi = DB::table('dokumen')->where('status','proses')->where('jenis','Yudisium')->count();
    	$bst = DB::table('dokumen')->where('status','proses')->where('jenis','BST')->count();
    	$dis = DB::table('dokumen')->where('status','proses')->where('jenis','Dispensasi')->count();
    	
        $laya = DB::table('dokumen')->where('status','selesai')->whereyear('created_at',2021)->orderBy('jurusan','asc')->get();
        $jumlahthnini= DB::table('dokumen')->where('status','selesai')->whereyear('created_at',2021)->count();
        $jumlahthnlalu = DB::table('dokumen')->where('status','selesai')->whereyear('created_at',2020)->count();
        $ydm = DB::table('dokumen')->where('jenis','Yudisium')->whereyear('created_at',2021)->where('status','selesai')->count();
        $hit1 = DB::table('dokumen')->wheredate('created_at','<=',$date1)->where('jenis','Cuti')->where('status','proses')->count();
        $hit3 = DB::table('dokumen')->wheredate('created_at','<=',$date3)->where('jenis','BST')->where('status','proses')->count();
        $hit4 = DB::table('dokumen')->wheredate('created_at','<=',$date4)->where('jenis','Dispensasi')->where('status','proses')->count();
        $bstindi = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->get();
        $cutindi = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->get();
        $disindi = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();

        return view('aak',compact('disindi','cutindi','bstindi','sts','ydm','set',
        'hit1','hit3','hit4','jumlahthnlalu','cuti','yudi','bst','dis'
        ,'laya','jumlahthnini','tanggal','isidata'));
    	
    }
}
