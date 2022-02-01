<?php

namespace Database\Seeders;

use App\Models\Bac;
use App\Models\Cycle;
use App\Models\Filiere;
use App\Models\License;
use App\Models\Path;
use App\Models\PathItem;
use Faker\Factory;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentAndPathsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::truncate();
        Path::truncate();
        PathItem::truncate();

        $faker = Factory::create();
        $bacs = Bac::pluck('id')->toArray();
        $Y = now()->year;
        for ($i = 1; $i <= 1000; $i++) {
            $gender = rand(0, 1) ? 'F' : 'M';
            $bacId = $bacs[ rand(0, count($bacs)-1) ];
            $student = Student::create([
                'name' => $faker->firstName($gender == 'M' ? 'male' : 'female') . ' ' . $faker->lastName(),
                'matricule' => md5(uniqid()),
                'gender' => $gender,
                'birthdate' => $faker->date('Y-m-d', now()->subYears(16)),
                'is_handicap' => rand(0, 50) === 0,
                'region' => ['Nord', 'Adamoua', 'Centre', 'Littoral', 'Ouest', 'Est', 'Sud', 'Nord Ouest', 'Sud Ouest'][rand(0,8)],
                'country' => rand(0, 100) < 90 ? 'CM' : ['GB', 'TD'][rand(0,1)],
                'bac_id' => $bacId
            ]);

            $entryYear = $Y - rand(0, 8);
            $cycle = Cycle::find( rand(1, Cycle::count()) );
            $license = License::whereId( rand(0, License::count() * 2) )->first();
            $entryLevel = $license != null ? 3 : 1;
            $path = Path::create([
                'student_id' => $student->id,
                'entry_year' => $entryYear,
                'entry_level' => $entryLevel,
                'bac_id' => $bacId,
                'entry_diploma' => $license ? $license->name : Bac::whereId($bacId)->value('name'),
                'license_id' => $license ? $license->id : null,
                'cycle_id' => $cycle->id
            ]);

            $exitYear = $entryYear + rand(0, $license != null ? 3 : 5);
            if ($exitYear > $Y) {
                $exitYear = $Y;
            }
            $n = $exitYear - $entryYear;
            $filieresIds = Filiere::where('cycle_id', $cycle->id)->pluck('id')->toArray();
            $fid = $filieresIds[rand(0, count($filieresIds)-1)];
            $l = $entryLevel;
            for ($j = 0; $j <= $n; $j++) {
                $removed = rand(0,1) === 0;
                PathItem::create([
                    'path_id' => $path->id,
                    'year' => $entryYear + $j,
                    'level' => $l,
                    'filiere_id' => $fid,
                    'school_certificate_removed' => $removed,
                    'status' => ['Normal', 'Abandon', 'Suspension', 'Decès'][$removed ? 0 : rand(0,3)]
                ]);

                if ($l < 5 && rand(0,3) !== 0) {    // increase level with 25% of chance for student to loss this class
                    $l++;
                }
            }
        }
    }
}
