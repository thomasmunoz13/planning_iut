<?php
/**
 * Created by PhpStorm.
 * User: thomasmunoz
 * Date: 10/03/15
 * Time: 15:07
 */

namespace app\helpers;


class Cleaner
{
    /**
     * Clean all elements of an array (the values must be numeric)
     * @param array $toClean
     * @return array
     */
    public static function clean($toClean)
    {
        if(!is_numeric($toClean[0]) || $toClean[0] > 2 || $toClean[0] < 1)
            $toClean[0] = 2;
        if(!is_numeric($toClean[1]) || $toClean[1] < 0 || $toClean[1] > 5 || ($toClean[0] == 2 && $toClean[1] > 4))
            $toClean[1] = 3;
        if(!is_numeric($toClean[2]) || $toClean[2] > 46 || $toClean[2] < 1)
            $toClean[2] = date('W') + 17;

        return $toClean;
    }

    public static function defaultValues()
    {
        return [2, 3, date('W') + 17];
    }
}