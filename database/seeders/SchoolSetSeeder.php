<?php

namespace Database\Seeders;

use App\Models\Bac;
use App\Models\Cycle;
use App\Models\Department;
use App\Models\Filiere;
use App\Models\License;
use Illuminate\Database\Seeder;

class SchoolSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bac::truncate();
        Bac::create(['name' => 'Bac F4']);
        Bac::create(['name' => 'Bac C']);
        Bac::create(['name' => 'Bac D']);
        Bac::create(['name' => 'Bac TI']);

        License::truncate();
        License::create(['name' => 'Licence Mathématique']);
        License::create(['name' => 'Licence Informatique']);
        License::create(['name' => 'Licence Physique']);
        License::create(['name' => 'Licence Chimie']);
        License::create(['name' => 'Licence Biologie']);

        Cycle::truncate();
        $c1 = Cycle::create(['name' => 'Ingenieur', 'entry_mode' => ENTRY_MODE_CONCOURS]);
        $c2 = Cycle::create(['name' => 'Master PRO', 'entry_mode' => ENTRY_MODE_STUDY]);
        $c3 = Cycle::create(['name' => "Master Recherche en Science de l'ingenieur", 'entry_mode' => ENTRY_MODE_STUDY]);
        $c4 = Cycle::create(['name' => "Science de l'ingenieur", 'entry_mode' => ENTRY_MODE_CONCOURS]);

        Department::truncate();
        $d0 = Department::create(['name' => 'TCO']);
        $d1 = Department::create(['name' => 'GIT']);
        $d2 = Department::create(['name' => 'GCI']);
        $d3 = Department::create(['name' => 'GAM']);
        $d4 = Department::create(['name' => 'GQHSE']);

        Filiere::truncate();
        Filiere::create([
            'name' => "Science de l'ingenieur",
            'department_id' => $d0->id,
            'cycle_id' => $c4->id
        ]);

        Filiere::create([
            'name' => "Science de l'ingenieur",
            'department_id' => $d0->id,
            'cycle_id' => $c3->id
        ]);

        Filiere::create([
            'name' => "Génie Logiciel",
            'department_id' => $d1->id,
            'cycle_id' => $c1->id
        ]);

        Filiere::create([
            'name' => "Génie Logiciel",
            'department_id' => $d1->id,
            'cycle_id' => $c2->id
        ]);

        Filiere::create([
            'name' => "Réseau et télécom",
            'department_id' => $d1->id,
            'cycle_id' => $c1->id
        ]);

        Filiere::create([
            'name' => "Réseau et télécom",
            'department_id' => $d1->id,
            'cycle_id' => $c2->id
        ]);

        Filiere::create([
            'name' => "Managment de l'information",
            'department_id' => $d1->id,
            'cycle_id' => $c1->id
        ]);

        Filiere::create([
            'name' => "Managment de l'information",
            'department_id' => $d1->id,
            'cycle_id' => $c2->id
        ]);

        Filiere::create([
            'name' => "Génie civil",
            'department_id' => $d2->id,
            'cycle_id' => $c1->id
        ]);

        Filiere::create([
            'name' => "Génie automobile",
            'department_id' => $d3->id,
            'cycle_id' => $c1->id
        ]);

        Filiere::create([
            'name' => "Mécatronique",
            'department_id' => $d3->id,
            'cycle_id' => $c1->id
        ]);

        Filiere::create([
            'name' => "Génie Qualité Hygiène et sécurité de l'environement",
            'department_id' => $d4->id,
            'cycle_id' => $c1->id
        ]);
    }
}
