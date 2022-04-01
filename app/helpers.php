<?php

use Carbon\Carbon;
use Carbon\CarbonInterface;

function setActiveOrInactive($request, $description)
{
    if (isset($request->status)){
        session()->forget($description);
        session([$description => $request->status]);
    } else {
        session()->forget($description);
        session([$description => null]);
    }
}

function formatDateToSql($date, $showHours=false){
    $date = Carbon::createFromIsoFormat('DD/MM/Y h:mm a', $date, 'UTC');

    if ($showHours) {
        return $date->isoFormat('YYYY-MM-DD HH:mm');
    } else {
        return $date->isoFormat('YYYY-MM-DD');
    }
}

function formatDateInFull($date){
    return str_replace('º ', ' de ', Carbon::createFromIsoFormat('YYYY-MM-DD HH:mm:ss', $date, 'UTC')->isoFormat('Do MMM. YYYY [as] hh:mm:ss'));
}

function diffDateInFull($date)
{
    return Carbon::parse($date)->diffForHumans(Carbon::now(), CarbonInterface::DIFF_RELATIVE_TO_NOW);
}

function userImagePath($image_name)
{
    return public_path('images/users/'.$image_name);
}

function employeeImagePath($image_name)
{
    return public_path('images/employees/'.$image_name);
}
