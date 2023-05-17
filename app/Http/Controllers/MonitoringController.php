<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{

    function index()
    {
        $cpuUsage = $this->getCpuUsage(); 

        dd($cpuUsage);
    }

    private function getCpuUsage()
    {
        $statFile = '/proc/stat';
        $cpuData = file($statFile);

        $cpuInfo = explode(' ', trim($cpuData[0]));
        $totalCpuTime = array_sum($cpuInfo);
        $idleCpuTime = $cpuInfo[3];

        $cpuUsage = 100 - round(($idleCpuTime / $totalCpuTime) * 100, 2);

        return $cpuUsage;
    }

}