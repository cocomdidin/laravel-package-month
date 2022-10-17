<?php

namespace Cocom\Month;

use Illuminate\Support\Arr;

class Month
{
    protected static $monthData = [
        'en' => [
            ['number' => 1, 'sortName' => 'Jan', 'name' => 'January'],
            ['number' => 2, 'sortName' => 'Feb', 'name' => 'February'],
            ['number' => 3, 'sortName' => 'Mar', 'name' => 'March'],
            ['number' => 4, 'sortName' => 'Apr', 'name' => 'April'],
            ['number' => 5, 'sortName' => 'Mey', 'name' => 'May'],
            ['number' => 6, 'sortName' => 'Jun', 'name' => 'June'],
            ['number' => 7, 'sortName' => 'Jul', 'name' => 'July'],
            ['number' => 8, 'sortName' => 'Ags', 'name' => 'August'],
            ['number' => 9, 'sortName' => 'Sep', 'name' => 'September'],
            ['number' => 10, 'sortName' => 'Oct', 'name' => 'October'],
            ['number' => 11, 'sortName' => 'Nov', 'name' => 'November'],
            ['number' => 12, 'sortName' => 'Dec', 'name' => 'December'],
        ],
        'id' => [
            ['number' => 1, 'sortName' => 'Jan', 'name' => 'Januari'],
            ['number' => 2, 'sortName' => 'Feb', 'name' => 'Februari'],
            ['number' => 3, 'sortName' => 'Mar', 'name' => 'Maret'],
            ['number' => 4, 'sortName' => 'Apr', 'name' => 'April'],
            ['number' => 5, 'sortName' => 'Mei', 'name' => 'Mei'],
            ['number' => 6, 'sortName' => 'Jun', 'name' => 'Juni'],
            ['number' => 7, 'sortName' => 'Jul', 'name' => 'Juli'],
            ['number' => 8, 'sortName' => 'Ags', 'name' => 'Agustus'],
            ['number' => 9, 'sortName' => 'Sep', 'name' => 'September'],
            ['number' => 10, 'sortName' => 'Okt', 'name' => 'Oktober'],
            ['number' => 11, 'sortName' => 'Nov', 'name' => 'November'],
            ['number' => 12, 'sortName' => 'Des', 'name' => 'Desember'],
        ]
    ];

    private static function monthLocale()
    {
        return isset(self::$monthData[app()->getLocale()]) ? self::$monthData[app()->getLocale()] : self::$monthData['en'];
    }

    /**
     * get
     *
     * @return void
     */
    public static function get()
    {
        return json_decode(json_encode(self::monthLocale()));
    }

    /**
     * getName
     *
     * @param  int $monthNumber
     * @return string
     */
    public static function getName(int $monthNumber) : string
    {
        $monthArr = self::monthLocale();

        $result = Arr::first($monthArr, function ($item) use ($monthNumber) {
            return ($item['number'] == $monthNumber);
        });

        return data_get($result, 'name');
    }

    /**
     * getSortName
     *
     * @param  int $monthNumber
     * @return string
     */
    public static function getSortName(int $monthNumber) : string
    {
        $monthArr = self::monthLocale();

        $result = Arr::first($monthArr, function ($item) use ($monthNumber) {
            return ($item['number'] == $monthNumber);
        });

        return data_get($result, 'sortName');
    }
}
