<?php
namespace mheinzerling\commons;

class StringUtils
{
    /**
     * @param null|string $haystack
     * @param null|string $needle
     * @param bool $ignoreCase
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public static function startsWith(string $haystack = null, string $needle = null, bool $ignoreCase = true): bool
    {
        if (is_null($needle)) return false;
        $length = strlen($needle);
        if ($length == 0) return true;
        if ($ignoreCase) {
            $needle = strtolower($needle);
            $haystack = strtolower($haystack);
        }
        return substr($haystack, 0, $length) === $needle;
    }

    /**
     * @param null|string $haystack
     * @param null|string $needle
     * @param bool $ignoreCase
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public static function endsWith(string $haystack = null, string $needle = null, bool $ignoreCase = true): bool
    {
        if (is_null($needle)) return false;
        $length = strlen($needle);
        if ($length == 0) return true;
        if ($ignoreCase) {
            $needle = strtolower($needle);
            $haystack = strtolower($haystack);
        }
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


    const TRIM_DEFAULT = " \t\n\r\0\x0B";

    /**
     * @param string|null $delimiter
     * @param string|null $input
     * @param string $characterMask
     * @return array|string[]
     */
    public static function trimExplode(string $delimiter = null, string $input = null, string $characterMask = self::TRIM_DEFAULT) : array
    {
        if (is_null($input)) return [];

        if (self::isBlank($delimiter)) {
            return [trim($input, $characterMask)];
        }
        $arr = explode($delimiter, $input);
        return array_map(function ($item) use ($characterMask) {
            return trim($item, $characterMask);
        }, $arr);
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

    public static function implode(string $glue = null, array $pieces = null, callable $keyValueToString):string
    {
        if ($pieces == null || count($pieces) == 0) return "";
        if ($glue == null) $glue = "";
        $result = '';
        foreach ($pieces as $key => $value) {
            $result .= $keyValueToString($key, $value);
            $result .= $glue;
        }
        if (count($pieces) > 0 && strlen($glue) > 0) $result = substr($result, 0, -strlen($glue));
        return $result;
    }
}