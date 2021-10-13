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
        //haalt rollen uit de database en telt ze op bij elkaar zodat je kan zien hoeveel er zijn
        $users[] = DB::table('users')
        ->join('roles','roles.id','=','users.role_id')
        ->select('roles.name as rolename', DB::raw('count(*) as views'))
        ->groupBy('roles.name')
        ->get();

        $roles = [];
        $count = [];
        //in de foreach zet hij alles van de array users[] in 2 aparte arrays
        foreach($users[0] as $kv) {
            array_push($count, $kv->views);
            array_push($roles, $kv->rolename);
        }

        //hier returned hij alles naar de controller met alle data van de grafiek
        return $this->chart->pieChart()
            ->setTitle('Hoeveel rollen')
            ->addData($count)
            ->setLabels($roles);
    }
}
