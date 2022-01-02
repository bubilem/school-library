<?php

namespace library\utils;

class Str
{
    /**
     * Translate string to Camel Case form
     * first-example -> firstExample     
     * this-second-example -> thisSecondExample
     * third_example -> thirdExample
     * fourth-example -> FourthExample
     *
     * @param string $value
     * @param string $separator
     * @param bool $lcfirst
     * @return string
     */
    public static function toCamelCase(string $value, string $separator = "-", bool $lcfirst = false): string
    {
        $str = str_replace($separator, '', ucwords($value, $separator));
        return $lcfirst ? lcfirst($str) : $str;
    }

    /**
     * Translate from Camel Case form to string
     * firstExample -> first-example
     * thisSecondExample -> this-second-example
     * 
     * @param string $value
     * @param string $separator
     * @return string
     */
    public static function fromCamelCase(string $value, string $separator = "-"): string
    {
        return strtolower(implode($separator, preg_split('/(?=[A-Z])/', lcfirst($value))));
    }

    /**
     * Convert to basic simple lowercase string
     * @param string $string
     * @return string 
     */
    public static function toSimple(string $string): string
    {
        return preg_replace('~^-+|-+$~', '', strtolower(preg_replace('~[^a-zA-Z0-9-]+~', '-', self::remAccents($string))));
    }

    /**
     * Remove accent from string
     *
     * @param string $str
     * @return string
     */
    public static function remAccents(string $str): string
    {
        $convArray = array(
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Ă' => 'A', 'Æ' => 'AE', 'Ç' =>
            'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
            'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' =>
            'O', 'Ő' => 'O', 'Ø' => 'O', 'Ș' => 'S', 'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U',
            'Ý' => 'Y', 'Þ' => 'TH', 'ß' => 'ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' =>
            'a', 'å' => 'a', 'ă' => 'a', 'æ' => 'ae', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
            'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' =>
            'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 'ø' => 'o', 'ș' => 's', 'ț' => 't', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 'ÿ' => 'y',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z', 'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T',
            'Ů' => 'U', 'Ž' => 'Z'
        );
        return strtr($str, $convArray);
    }

    public static function short($string, $maxlen, $postfix = '&#133;')
    {
        if (mb_strlen($string) > $maxlen) {
            return mb_substr($string, 0, $maxlen) . $postfix;
        } else {
            return $string;
        }
    }
}
