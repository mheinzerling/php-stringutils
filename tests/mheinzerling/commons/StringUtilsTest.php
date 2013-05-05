<?php

namespace mheinzerling\commons;


class StringUtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testStartsWith()
    {
        $this->assertEquals(false, StringUtils::startsWith("abcdef", null), "no needle");
        $this->assertEquals(false, StringUtils::startsWith(null, "a"), "no haystack");
        $this->assertEquals(false, StringUtils::startsWith("", "a"), "to long - empty");
        $this->assertEquals(false, StringUtils::startsWith("abcdef", "abcdefg"), "to long - regular");

        $this->assertEquals(true, StringUtils::startsWith("", ""), "both empty");
        $this->assertEquals(true, StringUtils::startsWith("abcdef", ""), "empty needle");
        $this->assertEquals(true, StringUtils::startsWith("abcdef", "a"), "valid - char");
        $this->assertEquals(true, StringUtils::startsWith("abcdef", "abc"), "valid - substr");
        $this->assertEquals(true, StringUtils::startsWith("abcdef", "abcdef"), "valid - full");
    }
    //TODO other test
}
