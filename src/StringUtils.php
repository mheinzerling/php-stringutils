<?php
namespace mheinzerling\commons;

class StringUtils
{
    public static function startsWith(string $haystack = null, string $needle = null): bool
    {
        if (is_null($needle)) return false;
        $length = strlen($needle);
        if ($length == 0) return true;
        return substr($haystack, 0, $length) === $needle;
    }

    public static function endsWith(string $haystack = null, string $needle = null): bool
    {
        if (is_null($needle)) return false;
        $length = strlen($needle);
        if ($length == 0) return true;
        return substr($haystack, -$length) == $needle;
    }

    /**
     * @param null|string $haystack
     * @param null|string $needle
     * @param bool $ignoreCase
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public static function contains(string $haystack = null, string $needle = null, bool $ignoreCase = true): bool
    {
        if ($ignoreCase) return stristr($haystack, $needle) !== FALSE;
        return strstr($haystack, $needle) !== FALSE;
    }

    /**
     * @param null|string $string
     * @return null|string
     */
    public static function firstCharToUpper(string $string = null) /*: ?string*/
    {
        return ucfirst($string);
    }

    public static function firstCharToLower(string $string = null) /*: ?string*/
    {
        return lcfirst($string);
    }


    /**
     * @param string|null $delimiter
     * @param string|null $input
     * @return string[]
     */
    public static function trimExplode(string $delimiter = null, string $input = null) : array
    {
        if (is_null($input)) return [];

        if (self::isBlank($delimiter)) {
            return [trim($input)];
        }
        $arr = explode($delimiter, $input);
        return array_map('trim', $arr);
    }

    public static function isBlank(string $str = null): bool
    {
        if (is_null($str)) return true;
        return trim($str) === '';
    }

    /**
     * @param string $haystack
     * @param string $regex with one group
     * @return null|string
     */
    public static function findAndRemove(string &$haystack = null, string $regex = null)//: ?string
    {
        if ($haystack == null || $regex == null) return null;
        if (preg_match($regex, $haystack, $match)) {
            $haystack = str_replace($match[0], "", $haystack);
            return $match[1];
        }
        return null;
    }
}