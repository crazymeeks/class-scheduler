<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FacultyTypeUnitsTableSeeder::class);
        $this->call(FacultyTypesTableSeeder::class);
        $this->call(InstitutionTableSeeder::class);
        $this->call(CreateProgramsTableSeeder::class);
        $this->call(CreateBlocksTableSeeder::class);
    }
}
