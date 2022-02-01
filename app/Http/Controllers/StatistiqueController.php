<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Path;
use App\Models\PathItem;
use App\Models\Student;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{


    function getDataSortedByEffectif(Request $req) {
        $data = [];
        $title = 'Effectifs';
        $columns = ['Effectif'];
        $totaux = [
            'Effectif' => 0
        ];

        return $this->loopThrough(
            $req,
            $title,
            $columns,
            $data,
            $totaux,
            function ($department, $filiere, $level, &$data, &$totaux, $Y) {
                $pathsIds = PathItem::where('filiere_id', $filiere->id)->where('level', $level)->where('year', $Y)->pluck('path_id')->toArray();
                $studentsIds = Path::whereIn('id', $pathsIds)->pluck('student_id')->toArray();
                $count = Student::whereIn('id', $studentsIds)->count();
                $data[$department->name][$filiere->name][$level] = [
                    'Effectif' => $count
                ];

                $totaux['Effectif'] += $count;
            }
        );
    }

    function getDataSortedByAge(Request $req) {
        $data = [];
        $totaux = [];
        $title = "Effectifs par âge";
        $columns = [
            "14-16",
            "17-19",
            "20-22",
            "23-25",
            "26-28",
            "29-31",
            "31-33"
        ];

        foreach($columns as $c) {
            $totaux[$c] = 0;
        }

        return $this->loopThrough(
            $req,
            $title,
            $columns,
            $data,
            $totaux,
            function ($department, $filiere, $level, &$data, &$totaux, $Y) use ($columns) {
                $pathsIds = PathItem::where('filiere_id', $filiere->id)->where('level', $level)->where('year', $Y)->pluck('path_id')->toArray();
                $studentsIds = Path::whereIn('id', $pathsIds)->pluck('student_id')->toArray();
                $a14 = Student::whereIn('id', $studentsIds)->whereYear('birthdate', '>', $Y-17)->whereYear('birthdate', '<=', $Y-14)->count();
                $a18 = Student::whereIn('id', $studentsIds)->whereYear('birthdate', '<=', $Y-18)->whereYear('birthdate', '>=', $Y-19)->count();
                $a22 = Student::whereIn('id', $studentsIds)->whereYear('birthdate', '<=', $Y-20)->whereYear('birthdate', '>=', $Y-22)->count();
                $a26 = Student::whereIn('id', $studentsIds)->whereYear('birthdate', '<=', $Y-23)->whereYear('birthdate', '>=', $Y-25)->count();
                $a30 = Student::whereIn('id', $studentsIds)->whereYear('birthdate', '<=', $Y-26)->whereYear('birthdate', '>=', $Y-28)->count();
                $a34 = Student::whereIn('id', $studentsIds)->whereYear('birthdate', '<=', $Y-29)->whereYear('birthdate', '>=', $Y-31)->count();
                $a38 = Student::whereIn('id', $studentsIds)->whereYear('birthdate', '<=', $Y-32)->count();
                $data[$department->name][$filiere->name][$level] = [
                    "14-16" => $a14,
                    "17-19" => $a18,
                    "20-22" => $a22,
                    "23-25" => $a26,
                    "26-28" => $a30,
                    "29-31" => $a34,
                    "31-33" => $a38
                ];

                $totaux["14-16"] += $a14;
                $totaux["17-19"] += $a18;
                $totaux["20-22"] += $a22;
                $totaux["23-25"] += $a26;
                $totaux["26-28"] += $a30;
                $totaux["29-31"] += $a34;
                $totaux["31-33"] += $a38;
            }
        );
    }


    function getDataSortedByRegion(Request $req) {
        $data = [];
        $totaux = [];
        $title = "Effectifs par region";
        $columns = Student::distinct()->orderBy('region')->pluck('region')->toArray();

        foreach($columns as $c) {
            $totaux[$c] = 0;
        }

        return $this->loopThrough(
            $req,
            $title,
            $columns,
            $data,
            $totaux,
            function ($department, $filiere, $level, &$data, &$totaux, $Y) use ($columns) {
                $pathsIds = PathItem::where('filiere_id', $filiere->id)->where('level', $level)->where('year', $Y)->pluck('path_id')->toArray();
                $studentsIds = Path::whereIn('id', $pathsIds)->pluck('student_id')->toArray();
                foreach($columns as $c) {
                    $count = Student::whereIn('id', $studentsIds)->where('region', $c)->count();
                    $data[$department->name][$filiere->name][$level][$c] = $count;
                    $totaux[$c] += $count;
                }
            }
        );
    }


    function getDataSortedByDiplomeAdmission(Request $req) {
        $data = [];
        $totaux = [];
        $title = "Effectifs par diplome d'admission";
        $columns = Path::distinct()->orderBy('entry_diploma')->pluck('entry_diploma')->toArray();

        foreach($columns as $c) {
            $totaux[$c] = 0;
        }

        return $this->loopThrough(
            $req,
            $title,
            $columns,
            $data,
            $totaux,
            function ($department, $filiere, $level, &$data, &$totaux, $Y) use ($columns) {
                $pathsIds = PathItem::where('filiere_id', $filiere->id)->where('level', $level)->where('year', $Y)->pluck('path_id')->toArray();
                foreach($columns as $c) {
                    $count = Path::whereIn('id', $pathsIds)->where('entry_diploma', $c)->count();
                    $data[$department->name][$filiere->name][$level][$c] = $count;
                    $totaux[$c] += $count;
                }
            }
        );
    }


    function getDataSortedByGender(Request $req) {
        $data = [];
        $title = 'Effectifs par genre';
        $columns = ['Fille', 'Garçon', 'Total'];
        $totaux = [
            'Fille' => 0,
            'Garçon' => 0,
            'Total' => 0
        ];

        return $this->loopThrough(
            $req,
            $title,
            $columns,
            $data,
            $totaux,
            function ($department, $filiere, $level, &$data, &$totaux, $Y) {
                $pathsIds = PathItem::where('filiere_id', $filiere->id)->where('level', $level)->where('year', $Y)->pluck('path_id')->toArray();
                $studentsIds = Path::whereIn('id', $pathsIds)->pluck('student_id')->toArray();
                $f = Student::whereIn('id', $studentsIds)->where('gender', 'F')->count();
                $g = Student::whereIn('id', $studentsIds)->where('gender', 'M')->count();
                $data[$department->name][$filiere->name][$level] = [
                    'Fille' => $f,
                    'Garçon' => $g,
                    'Total' => $f + $g
                ];

                $totaux['Fille'] += $f;
                $totaux['Garçon'] += $g;
                $totaux['Total'] += $f + $g;
            }
        );
    }

    private function loopThrough(Request $req, $title, $columns, &$data, &$totaux, \Closure $callback) {
        $departments = Department::with('filieres')->with('pathItems')->get();
        foreach($departments as $department) {
            $data[$department->name] = [];
            foreach ($department->filieres as $filiere) {
                $data[$department->name][$filiere->name] = [];
                for($i = 3; $i <= 5; $i++) {
                    $level = $i;
                    if ($department->name == 'TCO') {
                        $level = $i - 2;
                        if ($level == 3) {
                            break;
                        }
                    }

                    $callback($department, $filiere, $level, $data, $totaux, $req->year ?? now()->year);
                }
            }
        }
        return view('stats', compact('title', 'columns', 'data', 'totaux'));
    }
}
