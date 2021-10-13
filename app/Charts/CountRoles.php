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
        // Gets roles out of database and counts them up
        $users[] = DB::table('users')
        ->join('roles','roles.id','=','users.role_id')
        ->select('roles.name as rolename', DB::raw('count(*) as views'))
        ->groupBy('roles.name')
        ->get();

        $roles = [];
        $count = [];
        // In the foreach he puts everything in 2 seperate arrays
        foreach($users[0] as $kv) {
            array_push($count, $kv->views);
            array_push($roles, $kv->rolename);
        }

        // Returns the chart with given values
        return $this->chart->pieChart()
            ->setTitle('Hoeveel rollen')
            ->addData($count)
            ->setLabels($roles);
    }
}
