<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashcuti()
    {
        $month = [];
        for ($m=1; $m<=12; $m++) {
             $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }
 //ganjil
 $monthlyArray = array();
 $emptyMonth = array('count' => 0, 'month' => 0);
 for($i = 1; $i <= 12; $i++){//generate an array with default values
     $emptyMonth['month'] = $i;
     $monthlyArray[$i-1] = $emptyMonth;
 
 }//genap
 $mongen = array();
 $em = array('count' => 0, 'month' => 0);
 for($i = 1; $i <= 12; $i++){//generate an array with default values
     $em['month'] = $i;
     $mongen[$i-1] = $em;
 
 }  
 $ganjil = DB::table('dokumen')
 ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
 ->where('status','selesai')
 ->where('created_at', '>=', Carbon::parse('first day of january'))
 ->where('created_at', '<=', Carbon::parse('last day of december'))
 ->whereyear('created_at',Carbon::now())->where('jenis','Cuti')
 ->groupBy('month')->orderBy('month')->get()->toarray(); 

 foreach($ganjil as $key => $array){//add the results to the default array
     if(in_array($array->month,[1,2,9,10,11,12]))
     {
         $monthlyArray[$array->month-1] = $array;
     }
 }
 $hslganjil= collect($monthlyArray)->pluck('count');

 $genap = DB::table('dokumen')
 ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
 ->where('status','selesai')
 ->where('created_at', '>=', Carbon::parse('first day of march'))
 ->where('created_at', '<=', Carbon::parse('last day of august'))
 ->whereyear('created_at',Carbon::now())->where('jenis','Cuti')
 ->groupBy('month')->orderBy('month')->get()->toarray();
 foreach($genap as $key => $array){//add the results to the default array
     $mongen[$array->month-1] = $array;
     
 }
 $hslgenap= collect($mongen)->pluck('count');

        $dia = DB::table('dokumen')
        ->select(DB::raw('jurusan as js'))
        ->whereyear('created_at',Carbon::now())
        ->where('status','selesai')->where('jenis','Cuti')
        ->groupBy(DB::raw('js'))
        ->orderBy('js','asc')
        ->pluck('js');  
        
        $isid = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Cuti')
        ->whereyear('created_at',Carbon::now())
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  
        $set = DB::table('setting')->where('id_set','1')->get();
        $cutimaha = DB::table('dokumen')->where('jenis','Cuti')->whereyear('created_at',Carbon::now())->where('status','selesai')->orderBy('created_at','asc')->get();
        
        $hit = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->count();
        $cut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->orderBy('jurusan','asc')->get();
        $datecut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->orderBy('created_at','desc')->get();
        return view('dashcuti',compact('datecut','set','dia'
        ,'isid','cut','hit','set','cutimaha','month','hslganjil','hslgenap'));
    	
    }
    public function dashdispen()
    {	
        $month = [];
        for ($m=1; $m<=12; $m++) {
             $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }
        //ganjil
        $monthlyArray = array();
        $emptyMonth = array('count' => 0, 'month' => 0);
        for($i = 1; $i <= 12; $i++){//generate an array with default values
            $emptyMonth['month'] = $i;
            $monthlyArray[$i-1] = $emptyMonth;
        
        }//genap
        $mongen = array();
        $em = array('count' => 0, 'month' => 0);
        for($i = 1; $i <= 12; $i++){//generate an array with default values
            $em['month'] = $i;
            $mongen[$i-1] = $em;
        
        }   $ganjil = DB::table('dokumen')
        ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
        ->where('status','selesai')
        ->where('created_at', '>=', Carbon::parse('first day of january'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))
        ->whereyear('created_at',Carbon::now())->where('jenis','Dispensasi')
        ->groupBy('month')->orderBy('month')->get()->toarray(); 
    
        foreach($ganjil as $key => $array){//add the results to the default array
            if(in_array($array->month,[1,2,9,10,11,12]))
            {
                $monthlyArray[$array->month-1] = $array;
            }
        }
        $hslganjil= collect($monthlyArray)->pluck('count');

        $genap = DB::table('dokumen')
        ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
        ->where('status','selesai')
        ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))
        ->whereyear('created_at',Carbon::now())->where('jenis','Dispensasi')
        ->groupBy('month')->orderBy('month')->get()->toarray();
        foreach($genap as $key => $array){//add the results to the default array
            $mongen[$array->month-1] = $array;
            
        }
        $hslgenap= collect($mongen)->pluck('count');
        /*
        $tanggal = DB::table('dokumen')
        ->select(DB::raw('MONTHNAME(created_at) AS month'))
        ->where('status','selesai')->whereyear('created_at',2021)->where('jenis','Dispensasi')->orderBy('created_at','ASC')
        ->groupBy(DB::raw('month'))->pluck('month');  

        $tes = DB::table('dokumen')
        ->select(DB::raw('count(*) as count, YEAR(created_at) as year,MONTH(created_at) as month'))
        ->where('status','selesai')->where('jenis','Dispensasi')->whereyear('created_at',2021)->orderBy('created_at','ASC')
        ->groupBy(DB::raw('year,month'))->pluck('count');  */

        $dia = DB::table('dokumen')
        ->select(DB::raw('jurusan as js'))
        ->whereyear('created_at',Carbon::now())
        ->where('status','selesai')->where('jenis','Dispensasi')
        ->groupBy(DB::raw('js'))
        ->orderBy('js','asc')
        ->pluck('js');  
        
        $isid = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Dispensasi')
        ->whereyear('created_at',Carbon::now())
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  
            

        $set = DB::table('setting')->where('id_set','1')->get();
        
        $disp = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','Dispensasi')->where('status','proses')->count();
       
        $hit = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->count();

        $dispmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','Dispensasi')->where('status','selesai')->orderBy('jurusan','asc')->get();
        $dis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->orderBy('created_at','asc')->get();
        $datedis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->orderBy('created_at','desc')->get();
        
        return view('dashdispen',compact('datedis','dis','hit','set','disp','dispmaha',
        'dia','isid','month','hslganjil','hslgenap'));
    }
    public function dashbst()
    {
        $month = [];
        for ($m=1; $m<=12; $m++) {
             $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }
 //ganjil
 $monthlyArray = array();
 $emptyMonth = array('count' => 0, 'month' => 0);
 for($i = 1; $i <= 12; $i++){//generate an array with default values
     $emptyMonth['month'] = $i;
     $monthlyArray[$i-1] = $emptyMonth;
 
 }//genap
 $mongen = array();
 $em = array('count' => 0, 'month' => 0);
 for($i = 1; $i <= 12; $i++){//generate an array with default values
     $em['month'] = $i;
     $mongen[$i-1] = $em;
 
 }  
 $ganjil = DB::table('dokumen')
 ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
 ->where('status','selesai')
 ->where('created_at', '>=', Carbon::parse('first day of january'))
 ->where('created_at', '<=', Carbon::parse('last day of december'))
 ->whereyear('created_at',Carbon::now())->where('jenis','BST')
 ->groupBy('month')->orderBy('month')->get()->toarray(); 

 foreach($ganjil as $key => $array){//add the results to the default array
     if(in_array($array->month,[1,2,9,10,11,12]))
     {
         $monthlyArray[$array->month-1] = $array;
     }
 }
 $hslganjil= collect($monthlyArray)->pluck('count');

 $genap = DB::table('dokumen')
 ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
 ->where('status','selesai')
 ->where('created_at', '>=', Carbon::parse('first day of march'))
 ->where('created_at', '<=', Carbon::parse('last day of august'))
 ->whereyear('created_at',Carbon::now())->where('jenis','BST')
 ->groupBy('month')->orderBy('month')->get()->toarray();
 foreach($genap as $key => $array){//add the results to the default array
     $mongen[$array->month-1] = $array;
     
 }
 $hslgenap= collect($mongen)->pluck('count');

        $dia = DB::table('dokumen')
        ->select(DB::raw('jurusan as js'))
        ->whereyear('created_at',Carbon::now())
        ->where('status','selesai')->where('jenis','BST')
        ->groupBy(DB::raw('js'))
        ->orderBy('js','asc')
        ->pluck('js');  
        
        $isid = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','BST')
        ->whereyear('created_at',Carbon::now())
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');

        $set = DB::table('setting')->where('id_set','1')->get();
      /*  $set = DB::table('setting')->where('id_set','1')->get();
        foreach($set as $s)
        $date = date("Y-m-d",strtotime("-$s->bst day"));*/
        $bstmaha = DB::table('dokumen')->where('jenis','BST')->whereyear('created_at',Carbon::now())->where('status','selesai')->orderBy('jurusan','asc')->get();
        $hit = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->count();
        $bst = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
        $datebst = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
        return view('dashbst',compact('datebst','dia','isid',
        'bst','hit','set','bstmaha','month','hslganjil','hslgenap'));
    }
    public function dashyudi()
    {
        $month = [];
        for ($m=1; $m<=12; $m++) {
             $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }
 //ganjil
 $monthlyArray = array();
 $emptyMonth = array('count' => 0, 'month' => 0);
 for($i = 1; $i <= 12; $i++){//generate an array with default values
     $emptyMonth['month'] = $i;
     $monthlyArray[$i-1] = $emptyMonth;
 
 }//genap
 $mongen = array();
 $em = array('count' => 0, 'month' => 0);
 for($i = 1; $i <= 12; $i++){//generate an array with default values
     $em['month'] = $i;
     $mongen[$i-1] = $em;
 
 }  
 $ganjil = DB::table('dokumen')
 ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
 ->where('status','selesai')
 ->where('created_at', '>=', Carbon::parse('first day of january'))
 ->where('created_at', '<=', Carbon::parse('last day of december'))
 ->whereyear('created_at',Carbon::now())->where('jenis','Yudisium')
 ->groupBy('month')->orderBy('month')->get()->toarray(); 

 foreach($ganjil as $key => $array){//add the results to the default array
     if(in_array($array->month,[1,2,9,10,11,12]))
     {
         $monthlyArray[$array->month-1] = $array;
     }
 }
 $hslganjil= collect($monthlyArray)->pluck('count');

 $genap = DB::table('dokumen')
 ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
 ->where('status','selesai')
 ->where('created_at', '>=', Carbon::parse('first day of march'))
 ->where('created_at', '<=', Carbon::parse('last day of august'))
 ->whereyear('created_at',Carbon::now())->where('jenis','Yudisium')
 ->groupBy('month')->orderBy('month')->get()->toarray();
 foreach($genap as $key => $array){//add the results to the default array
     $mongen[$array->month-1] = $array;
     
 }
 $hslgenap= collect($mongen)->pluck('count');

        $dia = DB::table('dokumen')
        ->select(DB::raw('jurusan as js'))
        ->whereyear('created_at',Carbon::now())
        ->where('status','selesai')->where('jenis','Yudisium')
        ->groupBy(DB::raw('js'))
        ->orderBy('js','asc')
        ->pluck('js');  
        
        $isid = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Yudisium')
        ->whereyear('created_at',Carbon::now())
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');
       
        $sts = DB::table('mhs')->where('ket_yud','T')->count();
        
        $ydm = DB::table('dokumen')->where('jenis','Yudisium')
        ->whereyear('created_at',Carbon::now())->where('status','selesai')->count();
        $ydmaha = DB::table('dokumen')->where('jenis','Yudisium')
        ->whereyear('created_at',Carbon::now())->where('status','selesai')->orderBy('jurusan','asc')->get();
        $yudi = DB::table('dokumen')->where('jenis','Yudisium')
        ->where('status','proses')->orderBy('jurusan','asc')->get();
        $set = DB::table('setting')->where('id_set','1')->get();
        
        return view('dashyudi',compact('dia','isid','yudi',
        'set','sts','ydm','ydmaha','month','hslganjil','hslgenap'));
    }
}
