<?php

namespace App\Charts;

use DB;

use App\Models\User;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class CountRoles
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        
        $users[] = DB::table('users')
        ->join('roles','roles.id','=','users.role_id')
        ->select('roles.name as rolename', DB::raw('count(*) as views'))
        ->groupBy('roles.name')
        ->get();

        $roles = [];
        $count = [];
        foreach($users[0] as $kv) {
            array_push($count, $kv->views);
            array_push($roles, $kv->rolename);
        }


        return $this->chart->pieChart()
            ->setTitle('Hoeveel rollen')
            ->addData($count)
            ->setLabels($roles);
    }
}
