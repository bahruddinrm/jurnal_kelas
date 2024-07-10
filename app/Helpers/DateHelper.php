<?php

namespace App\Helpers;

class DateHelper
{
    public static function hariIndonesia($englishDay)
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => "Jum'at",
            'Saturday' => 'Sabtu',
        ];

        return $days[$englishDay];
    }
}
