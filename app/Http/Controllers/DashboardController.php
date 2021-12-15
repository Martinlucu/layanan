<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashcuti()
    {
        $m9= new Carbon('first day of september');
        $m12= new Carbon('last day of december');
        $m3= new Carbon('first day of march');
        $m8= new Carbon('last day of august');

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
   //ganjil smt lama
   $mojil = array();
   $emm = array('count' => 0, 'month' => 0);
   for($i = 1; $i <= 12; $i++){//generate an array with default values
       $emm['month'] = $i;
       $mojil[$i-1] = $emm;
   }

 $ganjil = DB::table('dokumen')
 ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
 ->where('status','selesai')
 ->where('created_at', '>=', Carbon::parse('first day of september'))
 ->where('created_at', '<=', Carbon::parse('last day of december'))
 ->whereyear('created_at',Carbon::now())->where('jenis','Cuti')
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
 ->whereyear('created_at',Carbon::now())->where('jenis','Cuti')
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
 ->whereyear('created_at',Carbon::now())->where('jenis','Cuti')
 ->groupBy('month')->orderBy('month')->get()->toarray();
 foreach($ganjillama as $key => $array){//add the results to the default array
     $mojil[$array->month-1] = $array;
     
 }
 $hslganjillama= collect($mojil)->pluck('count');

 if(Carbon::now()>=$m9 && Carbon::now()<=$m12){
    $dia = DB::table('dokumen')
    ->select(DB::raw('jurusan as js'))
    ->whereyear('created_at',Carbon::now())->where('created_at', '>=', Carbon::parse('first day of september'))
    ->where('created_at', '<=', Carbon::parse('last day of december'))
    ->where('status','selesai')->where('jenis','Cuti')
    ->groupBy(DB::raw('js'))
    ->orderBy('js','asc')
    ->pluck('js');  

$isi = DB::table('dokumen')
->select(DB::raw('count(jurusan) as total'))
->where('status','selesai')->where('jenis','Cuti')
->whereyear('created_at',Carbon::now())
->where('created_at', '>=', Carbon::parse('first day of september'))
->where('created_at', '<=', Carbon::parse('last day of december'))
->groupBy(DB::raw('jurusan'))
->orderBy('jurusan','asc')
->pluck('total');  

$hit = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')
->where('created_at', '>=', Carbon::parse('first day of september'))
->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->count();
$cutimaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())
->where('created_at', '>=', Carbon::parse('first day of september'))
->where('created_at', '<=', Carbon::parse('last day of december'))->where('jenis','Cuti')->where('status','selesai')->orderBy('jurusan','asc')->get();
$cut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')
->where('created_at', '>=', Carbon::parse('first day of september'))
->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
$datecut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')
->where('created_at', '>=', Carbon::parse('first day of september'))
->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
}
elseif( Carbon::now()>=$m3 && Carbon::now()<=$m8){
    $dia = DB::table('dokumen')
    ->select(DB::raw('jurusan as js'))
    ->whereyear('created_at',Carbon::now())->where('created_at', '>=', Carbon::parse('first day of march'))
    ->where('created_at', '<=', Carbon::parse('last day of august'))
    ->where('status','selesai')->where('jenis','Cuti')
    ->groupBy(DB::raw('js'))
    ->orderBy('js','asc')
    ->pluck('js');  

    $isi = DB::table('dokumen')
->select(DB::raw('count(jurusan) as total'))
->where('status','selesai')->where('jenis','Cuti')
->whereyear('created_at',Carbon::now())
->where('created_at', '>=', Carbon::parse('first day of march'))
->where('created_at', '<=', Carbon::parse('last day of august'))
->groupBy(DB::raw('jurusan'))
->orderBy('jurusan','asc')
->pluck('total');  
$hit = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->count();
$cutimaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','Cuti') ->where('created_at', '>=', Carbon::parse('first day of march'))
->where('created_at', '<=', Carbon::parse('last day of august'))->where('status','selesai')->orderBy('jurusan','asc')->get();
$cut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
$datecut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
}else{
    $dia = DB::table('dokumen')
    ->select(DB::raw('jurusan as js'))
    ->whereyear('created_at',Carbon::now())
    ->where('created_at', '>=', Carbon::parse('first day of january'))
    ->where('created_at', '<=', Carbon::parse('last day of february'))
    ->where('status','selesai')->where('jenis','Cuti')
    ->groupBy(DB::raw('js'))
    ->orderBy('js','asc')
    ->pluck('js');  

    $isi = DB::table('dokumen')
    ->select(DB::raw('count(jurusan) as total'))
    ->where('status','selesai')->where('jenis','Cuti')
    ->whereyear('created_at',Carbon::now())
    ->where('created_at', '>=', Carbon::parse('first day of january'))
    ->where('created_at', '<=', Carbon::parse('last day of february'))
    ->groupBy(DB::raw('jurusan'))
    ->orderBy('jurusan','asc')
    ->pluck('total');  
    $hit = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses')->where('created_at', '>=', Carbon::parse('first day of january'))
    ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->count();
    $cutimaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','Cuti')->where('created_at', '>=', Carbon::parse('first day of january'))
    ->where('created_at', '<=', Carbon::parse('last day of february'))->where('status','selesai')->orderBy('jurusan','asc')->get();
    $cut = DB::table('dokumen')->where('jenis','Cuti')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of january'))
    ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
    $datecut = DB::table('dokumen')->where('jenis','DispCutiensasi')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of january'))
    ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
}
$thnini=Carbon::now()->format('Y');
$thnlalu=Carbon::now()->subyear(1)->format('Y');

$gjl= substr($thnini, -2);
$gnp= substr($thnlalu, -2);

        $set = DB::table('setting')->where('id_set','1')->get();
      
        return view('dashcuti',compact('datecut','set','dia','hslganjillama'
        ,'isi','cut','hit','set','cutimaha','month','hslganjil','hslgenap','gjl','gnp'));
    	
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
        }
        
        //ganjil smt lama
        $mojil = array();
        $emm = array('count' => 0, 'month' => 0);
        for($i = 1; $i <= 12; $i++){//generate an array with default values
            $emm['month'] = $i;
            $mojil[$i-1] = $emm;
        }
        //genap
        $mongen = array();
        $em = array('count' => 0, 'month' => 0);
        for($i = 1; $i <= 12; $i++){//generate an array with default values
            $em['month'] = $i;
            $mongen[$i-1] = $em;
        
        }   $ganjil = DB::table('dokumen')
        ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
        ->where('status','selesai')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))
        ->whereyear('created_at',Carbon::now())->where('jenis','Dispensasi')
        ->groupBy('month')->orderBy('month')->get()->toarray(); 
    
        foreach($ganjil as $key => $array){//add the results to the default array
            /*if(in_array($array->month,[1,2,9,10,11,12]))
            {
                $monthlyArray[$array->month-1] = $array;
            }*/
            $monthlyArray[$array->month-1] = $array;
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

        $ganjillama = DB::table('dokumen')
        ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
        ->where('status','selesai')
        ->where('created_at', '>=', Carbon::parse('first day of january'))
        ->where('created_at', '<=', Carbon::parse('last day of february'))
        ->whereyear('created_at',Carbon::now())->where('jenis','Dispensasi')
        ->groupBy('month')->orderBy('month')->get()->toarray();
        foreach($ganjillama as $key => $array){//add the results to the default array
            $mojil[$array->month-1] = $array;
            
        }
        $hslganjillama= collect($mojil)->pluck('count');

        $m9= new Carbon('first day of september');
        $m12= new Carbon('last day of december');
        $m3= new Carbon('first day of march');
        $m8= new Carbon('last day of august');
        if(Carbon::now()>=$m9 && Carbon::now()<=$m12){
            $dia = DB::table('dokumen')
            ->select(DB::raw('jurusan as js'))
            ->whereyear('created_at',Carbon::now())->where('created_at', '>=', Carbon::parse('first day of september'))
            ->where('created_at', '<=', Carbon::parse('last day of december'))
            ->where('status','selesai')->where('jenis','Dispensasi')
            ->groupBy(DB::raw('js'))
            ->orderBy('js','asc')
            ->pluck('js');  

        $isi = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Dispensasi')
        ->whereyear('created_at',Carbon::now())
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  

        $hit = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->count();
        $dispmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->where('jenis','Dispensasi')->where('status','selesai')->orderBy('jurusan','asc')->get();
        $dis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
        $datedis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
    }
        elseif( Carbon::now()>=$m3 && Carbon::now()<=$m8){
            $dia = DB::table('dokumen')
            ->select(DB::raw('jurusan as js'))
            ->whereyear('created_at',Carbon::now())->where('created_at', '>=', Carbon::parse('first day of march'))
            ->where('created_at', '<=', Carbon::parse('last day of august'))
            ->where('status','selesai')->where('jenis','Dispensasi')
            ->groupBy(DB::raw('js'))
            ->orderBy('js','asc')
            ->pluck('js');  

            $isi = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Dispensasi')
        ->whereyear('created_at',Carbon::now())
        ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  
        $hit = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->count();
        $dispmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','Dispensasi') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->where('status','selesai')->orderBy('jurusan','asc')->get();
        $dis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
        $datedis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
        }else{
            $dia = DB::table('dokumen')
            ->select(DB::raw('jurusan as js'))
            ->whereyear('created_at',Carbon::now())
            ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))
            ->where('status','selesai')->where('jenis','Dispensasi')
            ->groupBy(DB::raw('js'))
            ->orderBy('js','asc')
            ->pluck('js');  

            $isi = DB::table('dokumen')
            ->select(DB::raw('count(jurusan) as total'))
            ->where('status','selesai')->where('jenis','Dispensasi')
            ->whereyear('created_at',Carbon::now())
            ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))
            ->groupBy(DB::raw('jurusan'))
            ->orderBy('jurusan','asc')
            ->pluck('total');  
            $hit = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses')->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->count();
            $dispmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','Dispensasi')->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->where('status','selesai')->orderBy('jurusan','asc')->get();
            $dis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
            $datedis = DB::table('dokumen')->where('jenis','Dispensasi')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
        }
        $thnini=Carbon::now()->format('Y');
        $thnlalu=Carbon::now()->subyear(1)->format('Y');
       
        $gjl= substr($thnini, -2);
        $gnp= substr($thnlalu, -2);

        $set = DB::table('setting')->where('id_set','1')->get();
      
        
        return view('dashdispen',compact('datedis','dis','hit','set','dispmaha',
        'dia','isi','month','hslganjil','hslgenap','gjl','gnp','hslganjillama'));
    }
    public function dashbst()
    {
        $m9= new Carbon('first day of september');
        $m12= new Carbon('last day of december');
        $m3= new Carbon('first day of march');
        $m8= new Carbon('last day of august');

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
  //ganjil smt lama
  $mojil = array();
  $emm = array('count' => 0, 'month' => 0);
  for($i = 1; $i <= 12; $i++){//generate an array with default values
      $emm['month'] = $i;
      $mojil[$i-1] = $emm;
  }

 $ganjil = DB::table('dokumen')
 ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
 ->where('status','selesai')
 ->where('created_at', '>=', Carbon::parse('first day of september'))
 ->where('created_at', '<=', Carbon::parse('last day of december'))
 ->whereyear('created_at',Carbon::now())->where('jenis','BST')
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
 ->whereyear('created_at',Carbon::now())->where('jenis','BST')
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
        ->whereyear('created_at',Carbon::now())->where('jenis','BST')
        ->groupBy('month')->orderBy('month')->get()->toarray();
        foreach($ganjillama as $key => $array){//add the results to the default array
            $mojil[$array->month-1] = $array;
            
        }
        $hslganjillama= collect($mojil)->pluck('count');
       
        if(Carbon::now()>=$m9 && Carbon::now()<=$m12){
            $dia = DB::table('dokumen')
            ->select(DB::raw('jurusan as js'))
            ->whereyear('created_at',Carbon::now())
            ->where('created_at', '>=', Carbon::parse('first day of september'))
            ->where('created_at', '<=', Carbon::parse('last day of december'))
            ->where('status','selesai')->where('jenis','BST')
            ->groupBy(DB::raw('js'))
            ->orderBy('js','asc')
            ->pluck('js');  

        $isi = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','BST')
        ->whereyear('created_at',Carbon::now())
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  

        $hit = DB::table('dokumen')->where('jenis','BST')->where('status','proses')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->count();
        $bstmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->where('jenis','BST')->where('status','selesai')->orderBy('jurusan','asc')->get();
        $bst = DB::table('dokumen')->where('jenis','BST')->where('status','proses')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
        $datebst = DB::table('dokumen')->where('jenis','BST')->where('status','proses')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
    }
        elseif( Carbon::now()>=$m3 && Carbon::now()<=$m8){
            $dia = DB::table('dokumen')
            ->select(DB::raw('jurusan as js'))
            ->whereyear('created_at',Carbon::now())->where('created_at', '>=', Carbon::parse('first day of march'))
            ->where('created_at', '<=', Carbon::parse('last day of august'))
            ->where('status','selesai')->where('jenis','BST')
            ->groupBy(DB::raw('js'))
            ->orderBy('js','asc')
            ->pluck('js');  

            $isi = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','BST')
        ->whereyear('created_at',Carbon::now())
        ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  
        $hit = DB::table('dokumen')->where('jenis','BST')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->count();
        $bstmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','BST') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->where('status','selesai')->orderBy('jurusan','asc')->get();
        $bst = DB::table('dokumen')->where('jenis','BST')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
        $datebst = DB::table('dokumen')->where('jenis','BST')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
        }else{
            $dia = DB::table('dokumen')
            ->select(DB::raw('jurusan as js'))
            ->whereyear('created_at',Carbon::now())
            ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))
            ->where('status','selesai')->where('jenis','BST')
            ->groupBy(DB::raw('js'))
            ->orderBy('js','asc')
            ->pluck('js');  

            $isi = DB::table('dokumen')
            ->select(DB::raw('count(jurusan) as total'))
            ->where('status','selesai')->where('jenis','BST')
            ->whereyear('created_at',Carbon::now())
            ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))
            ->groupBy(DB::raw('jurusan'))
            ->orderBy('jurusan','asc')
            ->pluck('total');  
            $hit = DB::table('dokumen')->where('jenis','BST')->where('status','proses')->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->count();
            $bstmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','BST')->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->where('status','selesai')->orderBy('jurusan','asc')->get();
            $bst = DB::table('dokumen')->where('jenis','BST')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
            $datebst = DB::table('dokumen')->where('jenis','BST')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->orderBy('created_at','desc')->get();
        }
        $thnini=Carbon::now()->format('Y');
        $thnlalu=Carbon::now()->subyear(1)->format('Y');
       
        $gjl= substr($thnini, -2);
        $gnp= substr($thnlalu, -2);

        $set = DB::table('setting')->where('id_set','1')->get();
      
        return view('dashbst',compact('datebst','dia','isi','gjl','gnp',
        'bst','hit','set','bstmaha','month','hslganjil','hslgenap','hslganjillama'));
    }
    public function dashyudi()
    {
        $m9= new Carbon('first day of september');
        $m12= new Carbon('last day of december');
        $m3= new Carbon('first day of march');
        $m8= new Carbon('last day of august');


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
  //ganjil smt lama
  $mojil = array();
  $emm = array('count' => 0, 'month' => 0);
  for($i = 1; $i <= 12; $i++){//generate an array with default values
      $emm['month'] = $i;
      $mojil[$i-1] = $emm;
  }

 $ganjil = DB::table('dokumen')
 ->select(DB::raw('count(*) as count,MONTH(created_at) as month'))
 ->where('status','selesai')
 ->where('created_at', '>=', Carbon::parse('first day of september'))
 ->where('created_at', '<=', Carbon::parse('last day of december'))
 ->whereyear('created_at',Carbon::now())->where('jenis','Yudisium')
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
 ->whereyear('created_at',Carbon::now())->where('jenis','Yudisium')
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
        ->whereyear('created_at',Carbon::now())->where('jenis','Yudisium')
        ->groupBy('month')->orderBy('month')->get()->toarray();
        foreach($ganjillama as $key => $array){//add the results to the default array
            $mojil[$array->month-1] = $array;     
        }
        $hslganjillama= collect($mojil)->pluck('count');

        if(Carbon::now()>=$m9 && Carbon::now()<=$m12){
            $dia = DB::table('dokumen')
            ->select(DB::raw('jurusan as js'))
            ->whereyear('created_at',Carbon::now())
            ->where('created_at', '>=', Carbon::parse('first day of september'))
            ->where('created_at', '<=', Carbon::parse('last day of december'))
            ->where('status','selesai')->where('jenis','Yudisium')
            ->groupBy(DB::raw('js'))
            ->orderBy('js','asc')
            ->pluck('js');  

        $isi = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Yudisium')
        ->whereyear('created_at',Carbon::now())
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  

        $ydm = DB::table('dokumen')->where('jenis','Yudisium')->where('status','selesai')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->count();
        $ydmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->where('jenis','Yudisium')->where('status','selesai')->orderBy('jurusan','asc')->get();
        $yudi = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses')
        ->where('created_at', '>=', Carbon::parse('first day of september'))
        ->where('created_at', '<=', Carbon::parse('last day of december'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
     
    }
        elseif( Carbon::now()>=$m3 && Carbon::now()<=$m8){
            $dia = DB::table('dokumen')
            ->select(DB::raw('jurusan as js'))
            ->whereyear('created_at',Carbon::now())->where('created_at', '>=', Carbon::parse('first day of march'))
            ->where('created_at', '<=', Carbon::parse('last day of august'))
            ->where('status','selesai')->where('jenis','Yudisium')
            ->groupBy(DB::raw('js'))
            ->orderBy('js','asc')
            ->pluck('js');  

            $isi = DB::table('dokumen')
        ->select(DB::raw('count(jurusan) as total'))
        ->where('status','selesai')->where('jenis','Yudisium')
        ->whereyear('created_at',Carbon::now())
        ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))
        ->groupBy(DB::raw('jurusan'))
        ->orderBy('jurusan','asc')
        ->pluck('total');  
        $ydm = DB::table('dokumen')->where('jenis','Yudisium')->where('status','selesai') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->count();
        $ydmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','Yudisium') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->where('status','selesai')->orderBy('jurusan','asc')->get();
        $yudi = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of march'))
        ->where('created_at', '<=', Carbon::parse('last day of august'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
        
        }else{
            $dia = DB::table('dokumen')
            ->select(DB::raw('jurusan as js'))
            ->whereyear('created_at',Carbon::now())
            ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))
            ->where('status','selesai')->where('jenis','Yudisium')
            ->groupBy(DB::raw('js'))
            ->orderBy('js','asc')
            ->pluck('js');  

            $isi = DB::table('dokumen')
            ->select(DB::raw('count(jurusan) as total'))
            ->where('status','selesai')->where('jenis','Yudisium')
            ->whereyear('created_at',Carbon::now())
            ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))
            ->groupBy(DB::raw('jurusan'))
            ->orderBy('jurusan','asc')
            ->pluck('total');  
            $ydm = DB::table('dokumen')->where('jenis','Yudisium')->where('status','selesai')->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->count();
            $ydmaha = DB::table('dokumen')->whereyear('created_at',Carbon::now())->where('jenis','Yudisium')->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->where('status','selesai')->orderBy('jurusan','asc')->get();
            $yudi = DB::table('dokumen')->where('jenis','Yudisium')->where('status','proses') ->where('created_at', '>=', Carbon::parse('first day of january'))
            ->where('created_at', '<=', Carbon::parse('last day of february'))->whereyear('created_at',Carbon::now())->orderBy('created_at','asc')->get();
           
        }
        $thnini=Carbon::now()->format('Y');
        $thnlalu=Carbon::now()->subyear(1)->format('Y');
       
        $gjl= substr($thnini, -2);
        $gnp= substr($thnlalu, -2);
        $sts = DB::table('mhs')->where('ket_yud','T')->count();
        $set = DB::table('setting')->where('id_set','1')->get();
        
        return view('dashyudi',compact('dia','isi','yudi','gnp','gjl',
        'set','sts','ydm','ydmaha','month','hslganjil','hslgenap','hslganjillama'));
    }
}