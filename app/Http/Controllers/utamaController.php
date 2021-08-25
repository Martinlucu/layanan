<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class utamaController extends Controller
{
    public function aak()
    {
        $set = DB::table('setting')->where('id_set','1')->get();
        foreach($set as $s)
        $date1 = date("Y-m-d",strtotime("-$s->cuti day"));
        $date2 = date("Y-m-d",strtotime("-$s->yudisium day"));
        $date3 = date("Y-m-d",strtotime("-$s->bst day"));
        $date4 = date("Y-m-d",strtotime("-$s->dispensasi day"));
        $from = date('2021-06-01');
        $to = date('2021-06-30');
        $from1 = date('2021-04-01');
        $to1 = date('2021-04-30');
        $from2 = date('2021-05-01');
        $to2 = date('2021-05-30');
        $from3 = date('2021-07-01');
        $to3 = date('2021-07-30');
        $from4 = date('2020-04-01');
        $to4 = date('2020-07-30');
        $from5 = date('2021-04-01');
        $to5 = date('2021-07-30');
        $sts = DB::table('dokumen')->where('semester','8')->whereBetween('created_at',[$from1,$to3])->count();
        $cuti = DB::table('dokumen')->where('status','proses')->where('jenis','Cuti')->count();
    	$yudi = DB::table('dokumen')->where('status','proses')->where('jenis','Yudisium')->count();
    	$bst = DB::table('dokumen')->where('status','proses')->where('jenis','BST')->count();
    	$dis = DB::table('dokumen')->where('status','proses')->where('jenis','Dispensasi')->count();
    	$juni = DB::table('dokumen')->where('status','selesai')->whereBetween('created_at',[$from,$to])->count();
    	$april = DB::table('dokumen')->where('status','selesai')->whereBetween('created_at',[$from1,$to1])->count();
    	$mei = DB::table('dokumen')->where('status','selesai')->whereBetween('created_at',[$from2,$to2])->count();
    	$juli = DB::table('dokumen')->where('status','selesai')->whereBetween('created_at',[$from3,$to3])->count();
        $laya = DB::table('dokumen')->where('status','selesai')->whereBetween('created_at',[$from5,$to5])->get();
        $jumlahthnini= DB::table('dokumen')->where('status','selesai')->whereBetween('created_at',[$from5,$to5])->count();
        $jumlahthnlalu = DB::table('dokumen')->where('status','selesai')->whereBetween('created_at',[$from4,$to4])->count();
        $ydm = DB::table('dokumen')->where('jenis','Yudisium')->whereBetween('created_at',[$from1,$to3])->where('status','selesai')->count();
        $hit1 = DB::table('dokumen')->wheredate('created_at','<=',$date1)->where('jenis','Cuti')->where('status','proses')->count();
        $hit3 = DB::table('dokumen')->wheredate('created_at','<=',$date3)->where('jenis','BST')->where('status','proses')->count();
        $hit4 = DB::table('dokumen')->wheredate('created_at','<=',$date4)->where('jenis','Dispensasi')->where('status','proses')->count();
        $bstindi = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->get();
        $cutindi = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->get();
        $disindi = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->get();
        return view('aak',compact('disindi','cutindi','bstindi','sts','ydm','set','hit1','hit3','hit4','jumlahthnlalu','cuti','yudi','bst','dis','april','mei','juni','juli','laya','jumlahthnini'));
    	
    }
}
