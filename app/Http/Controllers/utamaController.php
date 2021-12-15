<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class utamaController extends Controller
{
    public function aak()
    {
        //data count ganjil
        $monthlyArray = array();
        $emptyMonth = array('count' => 0, 'month' => 0);
        for($i = 1; $i <= 12; $i++){//generate an array with default values
            $emptyMonth['month'] = $i;
            $monthlyArray[$i-1] = $emptyMonth;
        
        }
        //data count genap
        $mongen = array();
        $em = array('count' => 0, 'month' => 0);
        for($i = 1; $i <= 12; $i++){//generate an array with default values
            $em['month'] = $i;
            $mongen[$i-1] = $em;
        
        }
        //ganjil smt lama
  $mojil = array();
  $emm = array('count' => 0, 'month' => 0);
  for($i = 1; $i <= 12; $i++){//generate an array with default values
      $emm['month'] = $i;
      $mojil[$i-1] = $emm;
  }
//memanggil bulan januari sampai desember
        $month = [];
for ($m=1; $m<=12; $m++) {
     $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
}
       /* versi bulan tidak semua masuk
        $tanggal = DB::table('dokumen')
        ->select(DB::raw('MONTHNAME(created_at) AS month'))
        ->where('status','selesai')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('month'))->pluck('month');  */
        
        $set = DB::table('setting')->where('id_set','1')->get();
        $m9= new Carbon('first day of september');
        $m12= new Carbon('last day of december');
        $m3= new Carbon('first day of march');
        $m8= new Carbon('last day of august');

       
        $ganjil = DB::table('dokumen')
        ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
        ->where('status','selesai')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))
        ->whereyear('created_at',Carbon::now())
        ->groupBy('month')->orderBy('month')->get()->toarray(); 
    
        foreach($ganjil as $key => $array){//add the results to the default array
                $monthlyArray[$array->month-1] = $array;
        }
        $hslganjil= collect($monthlyArray)->pluck('count');
       
        $genap = DB::table('dokumen')
        ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
        ->where('status','selesai')
        ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))
        ->whereyear('created_at',Carbon::now())
        ->groupBy('month')->orderBy('month')->get()->toarray();
        foreach($genap as $key => $array){//add the results to the default array
            $mongen[$array->month-1] = $array;
            
        }
        $hslgenap= collect($mongen)->pluck('count');
        $ganjillama = DB::table('dokumen')
        ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
        ->where('status','selesai')
        ->where('created_at', '>=', Carbon::parse('first day of january'))
        ->where('created_at', '<=', Carbon::parse('last day of february'))
        ->whereyear('created_at',Carbon::now())
        ->groupBy('month')->orderBy('month')->get()->toarray();
        foreach($ganjillama as $key => $array){//add the results to the default array
            $mojil[$array->month-1] = $array;
            
        }
        $hslganjillama= collect($mojil)->pluck('count');
       

        foreach($set as $s)
        $date2 = date("Y-m-d",strtotime("-$s->yudisium day"));
       
        $sts = DB::table('mhs')->where('ket_yud','T')->count();
        $cuti = DB::table('dokumen')->where('status','proses')->where('jenis','Cuti')->count();
    	$yudi = DB::table('dokumen')->where('status','proses')->where('jenis','Yudisium')->count();
    	$bst = DB::table('dokumen')->where('status','proses')->where('jenis','BST')->count();
    	$dis = DB::table('dokumen')->where('status','proses')->where('jenis','Dispensasi')->count();
    	
        $laya = DB::table('dokumen')->where('status','selesai')->whereyear('created_at',Carbon::now())->orderBy('jurusan','asc')->get();
        $jumlahthnini= DB::table('dokumen')->where('status','selesai')->whereyear('created_at',Carbon::now())->count();
        $jumlahthnlalu = DB::table('dokumen')->where('status','selesai')->whereyear('created_at',Carbon::now()->subyear(1))->count();
        
        $bstindi = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->orderBy('created_at','desc')->get();
        $cutindi = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->orderBy('created_at','desc')->get();
        $disindi = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->orderBy('created_at','desc')->get();
       
        $thnini=Carbon::now()->format('Y');
        $thnlalu=Carbon::now()->subyear(1)->format('Y');
        
        $gjl= substr($thnini, -2);
        $gnp= substr($thnlalu, -2);
        if(Carbon::now()>=$m9 && Carbon::now()<=$m12){
            $ydm = DB::table('dokumen')->where('jenis','Yudisium')->where('status','selesai')
            ->where('created_at', '>=', Carbon::parse('first day of september'))
            ->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->count();
        } elseif( Carbon::now()>=$m3 && Carbon::now()<=$m8){
            $ydm = DB::table('dokumen')->where('jenis','Yudisium')->where('status','selesai') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->count();
        }else{
            $ydm = DB::table('dokumen')->where('jenis','Yudisium')->where('status','selesai')->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->count();
        }
        return view('aak',compact('disindi','cutindi','bstindi','sts','ydm','set',
        'jumlahthnlalu','cuti','yudi','bst','dis','month','gjl','gnp','hslganjillama'
        ,'laya','jumlahthnini','genap','ganjil','monthlyArray','hslgenap','hslganjil'));
    	
    }
}
