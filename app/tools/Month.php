<?php

class Month 
{
    /**
     * list all month
     */
    protected static $data = [
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
    ];

    /**
     * get month name from month number
     * @param int $month_num
     * @return string|null
     */
    public static function getName($month_num) 
    {
        return static::$data[$month_num] ?? null;
    }

    /**
     * get all month numbers
     * @return array
     */
    public static function allNum()
    {
        $result = array_keys(static::$data);
        return $result;
    }
}