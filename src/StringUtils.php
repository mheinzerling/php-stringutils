<?php
declare(strict_types = 1);

namespace mheinzerling\commons;

/*
* @SuppressWarnings(PHPMD.BooleanArgumentFlag)
*/
class StringUtils
{
    public static function startsWith(?string $haystack, ?string $needle, bool $ignoreCase = true): bool
    {
        if (is_null($needle)) return false;
        $length = strlen($needle);
        if ($length === 0) return true;
        if (is_null($haystack)) return false;
        if ($ignoreCase) {
            $needle = static::toLower($needle);
            $haystack = static::toLower($haystack);
        }
        return substr($haystack, 0, $length) === $needle;
    }

    public static function endsWith(?string $haystack, ?string $needle, bool $ignoreCase = true): bool
    {
        if (is_null($needle)) return false;
        $length = strlen($needle);
        if ($length === 0) return true;
        if (is_null($haystack)) return false;
        if ($ignoreCase) {
            $needle = static::toLower($needle);
            $haystack = static::toLower($haystack);
        }
        return substr($haystack, -$length) == $needle;
    }

    public static function contains(?string $haystack, ?string $needle, bool $ignoreCase = true): bool
    {
        if ($ignoreCase) return stristr($haystack, $needle) !== FALSE;
        return strstr($haystack, $needle) !== FALSE;
    }

    public static function firstCharToUpper(?string $string): ?string
    {
        if ($string === null) return null;
        return ucfirst($string);
    }

    public static function firstCharToLower(?string $string): ?string
    {
        if ($string === null) return null;
        return lcfirst($string);
    }

    public static function toLower(?string $string): ?string
    {
        if ($string === null) return null;
        return strtolower($string);
    }

    const TRIM_DEFAULT = " \t\n\r\0\x0B";

    /**
     * @param string|null $delimiter
     * @param string|null $input
     * @param string $characterMask
     * @return string[]
     */
    public static function trimExplode(?string $delimiter, ?string $input, string $characterMask = self::TRIM_DEFAULT): array
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

    public static function isBlank(?string $str): bool
    {
        if (is_null($str)) return true;
        return trim($str) === '';
    }

    public static function findAndRemove(?string &$haystack, ?string $regex): ?string
    {
        if ($haystack == null || $regex == null) return null;
        if (preg_match($regex, $haystack, $match)) {
            $haystack = str_replace($match[0], "", $haystack);
            return $match[1];
        }
        return null;
    }

    public static function implode(?string $glue, ?array $pieces, callable $keyValueToString): string
    {
        if ($pieces == null || count($pieces) === 0) return "";
        if ($glue == null) $glue = "";
        $result = '';
        foreach ($pieces as $key => $value) {
            $result .= $keyValueToString($key, $value);
            $result .= $glue;
        }
        if (count($pieces) > 0 && strlen($glue) > 0) $result = substr($result, 0, -strlen($glue));
        return $result;
    }

    /**
     * @param string $haystack
     * @param int $start 0-index position of opening bracket
     * @return int 0-index end position of closing bracket, -1 if not found
     * @throws \Exception
     */
    public static function findMatchingBracketPos(?string $haystack, int $start = 0): int
    {
        if (strlen($haystack) < $start + 2) return -1;
        $types = ['(' => ')', '<' => '>', '{' => '}', '[' => ']'];
        $open = $haystack[$start];
        if (isset($types[$open])) $close = $types[$open];
        else throw new \Exception("'" . $open . "' is not a valid bracket.");

        $openInnerBrackets = 0;
        for ($pos = $start + 1, $s = strlen($haystack); $pos < $s; $pos++) {
            if ($haystack[$pos] == $open) $openInnerBrackets++;
            if ($haystack[$pos] == $close) {
                $openInnerBrackets--;
                if ($openInnerBrackets < 0) return $pos;
            }
        }
        return -1;
    }
}