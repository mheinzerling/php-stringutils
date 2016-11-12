<?php

namespace mheinzerling\commons;

class EscapeTest extends \PHPUnit_Framework_TestCase
{
    public function testStartsWith()
    {
        static::assertEquals(null, Escape::html(null));
        static::assertEquals("", Escape::html(""));
        static::assertEquals(" ", Escape::html(" "));
        static::assertEquals("äöl&lt;&gt;&amp;nbsp;&lt;script&gt;", Escape::html("äöl<>&nbsp;<script>"));
    }
}

