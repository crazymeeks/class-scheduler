<?php

use Scheduler\App\Models\Day;
use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		array('code' => 'M'),
    		array('code' => 'T'),
    		array('code' => 'W'),
    		array('code' => 'TH'),
    		array('code' => 'F'),
    		array('code' => 'MT'),
    		array('code' => 'MTH'),
    		array('code' => 'MF'),
    		array('code' => 'MWF'),
    		array('code' => 'TTH'),
    	];

        Day::insert($data);
    }
}
