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
        // Todays year date
        $currentYear = date('Y');
        
        // Gets users out of database with the same month and counts them up
        $users[] = DB::table('users')
        ->select(DB::raw('MONTHNAME(DATE(created_at)) as date'), DB::raw('count(*) as views'))
        ->whereYear('created_at','=',$currentYear)
        ->groupBy('date')
        ->get();

        $count = [];
        $month = [];
        // In the foreach he puts everything in 2 seperate arrays
        foreach($users[0] as $kv) {
            array_push($count, $kv->views);
            array_push($month, $kv->date);
        }

        // Returns the chart with given values
        return $this->chart->barChart()
            ->setTitle('Registreerde gebruikers per maand van het jaar '.$currentYear)
            ->addData('Geregistreerde gebruikers', $count)
            ->setXAxis($month);
    }
}
