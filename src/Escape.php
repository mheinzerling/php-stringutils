<?php
declare(strict_types = 1);

namespace mheinzerling\commons;

class Escape
{
    public static function html(?string $input):?string
    {
        if ($input == null) return null;
        return htmlspecialchars($input);
    }
}