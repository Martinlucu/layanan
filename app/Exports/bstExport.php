<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
class bstExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $bst = DB::table('dokumen')->select('nim','nama_mhs','email_mhs','jurusan','jenis','status','created_at','updated_at')
        ->where('jenis','BST')->wherein('status',['selesai','ditolak'])->orderBy('jurusan','asc')->get();
        return $bst;
    }
    public function headings(): array
    {
        return [
            'NIM','Nama','E-mail Mahasiswa','Jurusan','Jenis','Status','Tanggal masuk','Tanggal selesai'
        ];
    }
}
