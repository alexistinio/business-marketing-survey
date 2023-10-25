<?php

use Carbon\Carbon;

if (! function_exists('calculateAge')) {
    function calculateAge($date)
    {
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day = date('d', strtotime($date));

        return Carbon::createFromDate($year, $month, $day)->age;
    }
}

if (! function_exists('getDaysBetween')) {
    function getDaysBetween($from, $to)
    {
        $datediff = strtotime($to) - strtotime($from);

        return round($datediff / (60 * 60 * 24));
    }
}
