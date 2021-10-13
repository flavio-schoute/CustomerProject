<?php

namespace App\Charts;

use DB;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class RegisteredUsers
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {   
        //datum van vandaag
        $currentYear = date('Y');
        
        //haalt users op die allemaal op dezelfde maand vallen en die telt hij dan bij elkaar op
        $users[] = DB::table('users')
        ->select(DB::raw('MONTHNAME(DATE(created_at)) as date'), DB::raw('count(*) as views'))
        ->whereYear('created_at','=',$currentYear)
        ->groupBy('date')
        ->get();

        $count = [];
        $month = [];
        //in de foreach zet hij alles van de array users[] in 2 aparte arrays
        foreach($users[0] as $kv) {
            array_push($count, $kv->views);
            array_push($month, $kv->date);
        }

        //hier returned hij alles naar de controller met alle data van de grafiek
        return $this->chart->barChart()
            ->setTitle('Registreerde gebruikers per maand van het jaar '.$currentYear)
            ->addData('Geregistreerde gebruikers', $count)
            ->setXAxis($month);
    }
}
