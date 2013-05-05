<?php
namespace mheinzerling\commons;

class StringUtils
{
    public static function startsWith($haystack, $needle)
    {
        if (is_null($needle)) return false;
        $length = strlen($needle);
        if ($length == 0) return true;
        return substr($haystack, 0, $length) === $needle;
    }

    public static function contains($haystack, $needle, $ignoreCase = true)
    {
        if ($ignoreCase) return stristr($haystack, $needle) !== FALSE;
        return strstr($haystack, $needle) !== FALSE;
    }

    public static function firstCharToUpper($string)
    {
        return strtoupper($string[0]) . substr($string, 1);
    }

    public static function trimExplode($delimiter, $input)
    {
        $arr = explode($delimiter, $input);
        return array_map('trim', $arr);
    }
}