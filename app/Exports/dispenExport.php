<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class dispenExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $set = DB::table('setting')->where('id_set','1')->get();
        foreach($set as $s){
            $gjlawal=$s->gjlawal;
            $gnpawal=$s->gnpawal;
            $gjlakhir=$s->gjlakhir;
            $gnpakhir=$s->gnpakhir;
        } if(Carbon::now()>=$gjlawal && Carbon::now()<=$gjlakhir){
        $dispen = DB::table('dokumen')->select('nim','nama_mhs','email_mhs','jurusan','jenis','status','created_at','updated_at')
        ->where('jenis','Dispensasi')->whereBetween('created_at', [$gjlawal, $gjlakhir])->wherein('status',['selesai','ditolak'])->orderBy('jurusan','asc')->get();
    } elseif(Carbon::now()>=$gnpawal && Carbon::now()<=$gnpakhir){
        $dispen = DB::table('dokumen')->select('nim','nama_mhs','email_mhs','jurusan','jenis','status','created_at','updated_at')
        ->where('jenis','Dispensasi')->whereBetween('created_at', [$gnpawal, $gnpakhir])->wherein('status',['selesai','ditolak'])->orderBy('jurusan','asc')->get();
    }
        return $dispen;
    }
    public function headings(): array
    {
        return [
            'NIM','Nama','E-mail Mahasiswa','Jurusan','Jenis','Status','Tanggal masuk','Tanggal selesai'
        ];
    }
}
