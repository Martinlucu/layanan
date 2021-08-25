<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class dokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {/*
        DB::table('dokumen')->insert([
        	'nim' => '17410100039',
        	'nama_mhs' => 'aditya martin',
        	'email_mhs' => '17410100039@dinamika.ac.id',
        	'semester' => '8',
        	'angkatan' => '2017',
        	'jurusan' => 'Sistem informasi',
        	'jenis' => 'Cuti',
        	'file' => '17410100039_cuti.pdf',
        	'batas_cuti' => '1',
        ]);*/
        $faker = Faker::create('id_ID');
 
    	for($i = 29; $i <= 45; $i++){
 
    	      // insert data ke table dokumen menggunakan Faker
    		DB::table('dokumen')->insert([
    			'nim' => $faker->numerify($string = '###'),
    			'nama_mhs' => $faker->name,
    			'email_mhs' => $faker->safeEmail,
                'semester' =>  $faker->numberBetween(3,8),
        	    'angkatan' =>  $faker->numberBetween(2016,2021),
        	    'jurusan' => $faker->randomElement(['S1 Sistem Informasi',
                'S1 Sistem Komputer','D3 Sistem Informasi','S1 Akutansi','S1 Desain Komunikasi Visual',
                'S1 Desain Produk','S1 Produksi Film Dan Telivisi']),
        	    'jenis' => $faker->randomElement(['Cuti','Yudisium','Dispensasi','BST']),
        	    'file' =>  $faker->fileExtension('pdf'),
            	'batas_cuti' => $faker->numberBetween(0,2),
				'status'=>'selesai',
            	'created_at' => $faker->dateTimeBetween('2020-04-01', '2020-07-30'),

    		]);
        }
    }
}
