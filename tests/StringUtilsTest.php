<?php

namespace mheinzerling\commons;


class StringUtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testStartsWith()
    {
        static::assertEquals(false, StringUtils::startsWith("abcdef", null), "no needle");
        static::assertEquals(false, StringUtils::startsWith(null, "a"), "no haystack");
        static::assertEquals(false, StringUtils::startsWith("", "a"), "to long - empty");
        static::assertEquals(false, StringUtils::startsWith("abcdef", "abcdefg"), "to long - regular");

        static::assertEquals(true, StringUtils::startsWith("", ""), "both empty");
        static::assertEquals(true, StringUtils::startsWith("abcdef", ""), "empty needle");
        static::assertEquals(true, StringUtils::startsWith("abcdef", "a"), "valid - char");
        static::assertEquals(true, StringUtils::startsWith("abcdef", "abc"), "valid - substr");
        static::assertEquals(true, StringUtils::startsWith("abcdef", "abcdef"), "valid - full");
    }

    public function testEndsWith()
    {
        static::assertEquals(false, StringUtils::endsWith("abcdef", null), "no needle");
        static::assertEquals(false, StringUtils::endsWith(null, "a"), "no haystack");
        static::assertEquals(false, StringUtils::endsWith("", "a"), "to long - empty");
        static::assertEquals(false, StringUtils::endsWith("abcdef", "abcdefg"), "to long - regular");

        static::assertEquals(true, StringUtils::endsWith("", ""), "both empty");
        static::assertEquals(true, StringUtils::endsWith("abcdef", ""), "empty needle");
        static::assertEquals(true, StringUtils::endsWith("abcdef", "f"), "valid - char");
        static::assertEquals(true, StringUtils::endsWith("abcdef", "def"), "valid - substr");
        static::assertEquals(true, StringUtils::endsWith("abcdef", "abcdef"), "valid - full");
    }

    public function testFirstCharToUpper()
    {
        static::assertEquals(null, StringUtils::firstCharToUpper(null), "null");
        static::assertEquals("", StringUtils::firstCharToUpper(""), "empty");
        static::assertEquals(" f", StringUtils::firstCharToUpper(" f"), "space");
        static::assertEquals("F", StringUtils::firstCharToUpper("f"), "single letter");
        static::assertEquals("Foo", StringUtils::firstCharToUpper("foo"), "normal usecase");
        static::assertEquals("Foo", StringUtils::firstCharToUpper("Foo"), "no effect");
        static::assertEquals("5foo", StringUtils::firstCharToUpper("5foo"), "numeric");
        //TODO UTF-8 and special character
    }

    public function testFirstCharToLower()
    {
        static::assertEquals(null, StringUtils::firstCharToLower(null), "null");
        static::assertEquals("", StringUtils::firstCharToLower(""), "empty");
        static::assertEquals(" F", StringUtils::firstCharToLower(" F"), "space");
        static::assertEquals(" F", StringUtils::firstCharToLower(" F"), "space");
        static::assertEquals("f", StringUtils::firstCharToLower("F"), "single letter");
        static::assertEquals("foo", StringUtils::firstCharToLower("Foo"), "normal usecase");
        static::assertEquals("foo", StringUtils::firstCharToLower("foo"), "no effect");
        static::assertEquals("5foo", StringUtils::firstCharToLower("5foo"), "numeric");
        //TODO UTF-8 and special character
    }

    public function testIsBlank()
    {
        static::assertEquals(true, StringUtils::isBlank(null), "null");
        static::assertEquals(true, StringUtils::isBlank(""), "empty");
        static::assertEquals(true, StringUtils::isBlank(" "), "space");
        static::assertEquals(true, StringUtils::isBlank(" \t \r\n \r"), "mixed");
        static::assertEquals(false, StringUtils::isBlank(" foo "), "non blank");
    }

    public function testTrimExplode()
    {
        $input = "   | foo| bar\n | \thoo ";
        static::assertEquals([], StringUtils::trimExplode(null, null), "nothing");
        static::assertEquals([], StringUtils::trimExplode("|", null), "nothing with delimiter");
        static::assertEquals([""], StringUtils::trimExplode("|", ""), "empty with delimiter");
        static::assertEquals(["| foo| bar\n | \thoo"], StringUtils::trimExplode(null, $input), "no delimiter");
        static::assertEquals(["| foo| bar\n | \thoo"], StringUtils::trimExplode("", $input), "empty delimiter");
        static::assertEquals(["", "foo", "bar", "hoo"], StringUtils::trimExplode("|", $input), "valid");

    }

    public function testContains()
    {
        //TODO special cases
        static::assertEquals(true, StringUtils::contains("foo", "O"));
        static::assertEquals(false, StringUtils::contains("foo", "x"));
        static::assertEquals(false, StringUtils::contains("foo", "O", false));
        static::assertEquals(true, StringUtils::contains("foo", "o", false));
    }

    public function testFindAndRemove()
    {
        $null = null;
        $input = "Some text with some informations";
        static::assertEquals(null, StringUtils::findAndRemove($null, "@pattern@"));
        static::assertEquals(null, StringUtils::findAndRemove($input, null));
        static::assertEquals("some", StringUtils::findAndRemove($input, "@with ([a-z]+) @"));
        static::assertEquals("Some text informations", $input);
        static::assertEquals(null, StringUtils::findAndRemove($input, "@pattern@"));
        static::assertEquals("Some text informations", $input);
    }
}

