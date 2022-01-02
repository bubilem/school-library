<?php

namespace library\utils;

class Arr
{

    public static function toStr(array $arr, $sep = ', ', $prefix = "", $postfix = ""): string
    {
        $str = '';
        foreach ($arr as $val) {
            if (!empty($val)) {
                $str .= ($str ? $sep : '') . ($prefix . $val . $postfix);
            }
        }
        return $str;
    }
}
