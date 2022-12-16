<?php

namespace Cocom\Month;

use Illuminate\Support\Arr;

class Month
{
    protected static $months = [];

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

    private static function setQuarter($months) {
        Arr::set($months, '0.quarter', 1);
        Arr::set($months, '1.quarter', 1);
        Arr::set($months, '2.quarter', 1);
        Arr::set($months, '3.quarter', 2);
        Arr::set($months, '4.quarter', 2);
        Arr::set($months, '5.quarter', 2);
        Arr::set($months, '6.quarter', 3);
        Arr::set($months, '7.quarter', 3);
        Arr::set($months, '8.quarter', 3);
        Arr::set($months, '9.quarter', 4);
        Arr::set($months, '10.quarter', 4);
        Arr::set($months, '11.quarter', 4);

        return $months;
    }

    private static function monthInit()
    {
        if (!self::$months) {
            self::$months = self::setQuarter(
                isset(self::$monthData[app()->getLocale()])
                ? self::$monthData[app()->getLocale()]
                : self::$monthData['en']
            );
        }
    }

    /**
     * get
     *
     * @return object
     */
    public static function get()
    {
        self::monthInit();
        return json_decode(json_encode(array_values(self::$months)));
    }

    /**
     * getName
     *
     * @param  int $monthNumber
     * @return string
     */
    public static function getName(int $monthNumber) : string
    {
        self::monthInit();

        $result = Arr::first(self::$months, function ($item) use ($monthNumber) {
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
        self::monthInit();

        $result = Arr::first(self::$months, function ($item) use ($monthNumber) {
            return ($item['number'] == $monthNumber);
        });

        return data_get($result, 'sortName');
    }

    /**
     * get by quarter number
     *
     * @param  int $start start of quarter 1 - 4
     * @param  int $end (optional) end of quarter 1 - 4
     * @return object
     */
    public static function quarter(int $start, int $end = null)
    {
        self::monthInit();

        self::$months = Arr::where(self::$months, function($month) use ($start, $end) {
            return $end
            ? $month['quarter'] >= $start && $month['quarter'] <= $end
            : $month['quarter'] == $start;
        });

        return new self();
    }
}
