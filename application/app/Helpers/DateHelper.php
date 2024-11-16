<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function extractAndConvertDate(string $filename)
    {
        preg_match_all('/\d{8}/', $filename, $matches);

        $dates = array_map(function ($date) {
            return Carbon::createFromFormat('Ymd', $date)->toDateString();
        }, $matches[0]);

        return $dates;
    }
}
