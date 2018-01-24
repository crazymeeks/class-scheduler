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
        $this->call(LevelsTableSeeder::class);
        $this->call(SpecialtiesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(YearActiveTableSeeder::class);
        $this->call(CreateFacultyTableSeeder::class);
        $this->call(CreateFacultySpecialtyTableSeeder::class);
        $this->call(CreateFacultySubjectTableSeeder::class);
        $this->call(CreateFacultyYearActiveTableSeeder::class);
        $this->call(CreateFacultyYearLevelTableSeeder::class);
        $this->call(CreateFacultyProgramTableSeeder::class);
    }
}
