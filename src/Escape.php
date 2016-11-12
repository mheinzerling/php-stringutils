<?php

namespace mheinzerling\commons;


class Escape
{
    /**
     * @param string|null $input
     * @return string|null
     */
    public static function html(string $input = null) //:?string
    {
        return htmlspecialchars($input);
    }
}