<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
                'title'=>'Jual celana murah',
                'price'=>'150000',
                'description'=>'size: S, color: white',
                'image'=>"public/web app project new/images/fashion.jpg"               

            ],
            [
                'title'=>'Jual polo shirt',
                'price'=>'300000',
                'description'=>'size: L, color: black',
                'image'=>"public/web app project new/images/fashion.jpg"               

            ],
            [
                'title'=>'Dress polkadot',
                'price'=>'200000',
                'description'=>'size: All Size, color: polkadot',
                'image'=>"public/web app project new/images/fashion 1.jpg"               
            ]
            
        ]);

    }
}
