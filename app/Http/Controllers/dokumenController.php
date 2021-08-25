<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\dokumendispen;
use App\Exports\dispenExport;
use App\Exports\cutiExport;
use App\Exports\bstExport;
use App\Exports\yudiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
class dokumenController extends Controller
{
    public function dokdispen()
    {
        $lapdis = DB::table('dokumen')->where('jenis','Dispensasi')->wherein('status',['selesai','ditolak'])->get();
        
        return view('dokdispen',compact('lapdis'));
}
public function dokcuti()
{
    $lapdis = DB::table('dokumen')->where('jenis','Cuti')->wherein('status',['selesai','ditolak'])->get();
    
    return view('dokcuti',compact('lapdis'));
}
public function dokbst()
{
    $lapdis = DB::table('dokumen')->where('jenis','BST')->wherein('status',['selesai','ditolak'])->get();
    
    return view('dokbst',compact('lapdis'));
}
public function dokyudi()
{
    $lapdis = DB::table('dokumen')->where('jenis','Yudisium')->wherein('status',['selesai','ditolak'])->get();
    
    return view('dokyudi',compact('lapdis'));
}
public function export_excel()
	{
		return Excel::download(new dispenExport, 'dispen.xlsx');
	}
    public function export_cuti()
	{
		return Excel::download(new cutiExport, 'cuti.xlsx');
	}
    public function export_yudi()
	{
		return Excel::download(new yudiExport, 'yudisium.xlsx');
	}
    public function export_bst()
	{
		return Excel::download(new bstExport, 'bst.xlsx');
	}
}
