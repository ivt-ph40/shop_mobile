<?php

use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
        	'name'=>'Quảng Nam',
        	'name'=>'Đà Nẵng',
        	'name'=>'TT.Huế',
        	'name'=>'Quảng Bình',
        	'name'=>'Quảng Trị',
        	'name'=>'Hà Tĩnh',
        	'name'=>'Thanh Hóa',
        	'name'=>'Ngệ An',
        	'name'=>'Quảng Ngãi',
        	'name'=>'Bình Đinh',
        	'name'=>'Phú Yên',
        	'name'=>'Quảng Ngãi',
        	'name'=>'Quảng Ngãi',
        	'name'=>'Quảng Ngãi',
        	'name'=>'Quảng Ngãi',
        	'name'=>'Quảng Ngãi',
        ]);
    }
}
