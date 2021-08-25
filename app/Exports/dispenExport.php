<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
class dispenExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $dispen = DB::table('dokumen')->select('nim','nama_mhs','email_mhs','jurusan','jenis','status','created_at','updated_at')->where('jenis','Dispensasi')->wherein('status',['selesai','ditolak'])->get();
       // return dokumendispen::where('jenis','Dispensasi')->where('status','selesai')->get();
        return $dispen;
    }
    public function headings(): array
    {
        return [
            'NIM','Nama','E-mail Mahasiswa','Jurusan','Jenis','Status','Tanggal masuk','Tanggal selesai'
        ];
    }
}
