<?php
namespace mheinzerling\commons;

class StringUtils
{
    public static function startsWith($haystack, $needle)
    {
        return substr($haystack, 0, strlen($needle)) === $needle;
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