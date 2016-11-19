[![Build Status](https://travis-ci.org/mheinzerling/php-stringutils.svg?branch=master)](https://travis-ci.org/mheinzerling/php-stringutils) [![Code Climate](https://codeclimate.com/github/mheinzerling/php-stringutils/badges/gpa.svg)](https://codeclimate.com/github/mheinzerling/php-stringutils) [![Test Coverage](https://codeclimate.com/github/mheinzerling/php-stringutils/badges/coverage.svg)](https://codeclimate.com/github/mheinzerling/php-stringutils/coverage) [![Issue Count](https://codeclimate.com/github/mheinzerling/php-stringutils/badges/issue_count.svg)](https://codeclimate.com/github/mheinzerling/php-stringutils) 

#mheinzerling/stringutils

This is a small library similar to Apache Commons StringUtils for Java. 

##Composer
    "require": {
        "mheinzerling/stringutils": "^2.1.1"
    },
    
##Methods
    StringUtils::startsWith
    StringUtils::endsWith
    StringUtils::contains
    StringUtils::firstCharToUpper
    StringUtils::firstCharToLower
    StringUtils::trimExplode
    StringUtils::isBlank
    StringUtils::findAndRemove
    StringUtils::implode
    StringUtils::findMatchingBracketPos
    Escape::html
    
##Changelog

### 2.2.0
* add StringUtils::findAndRemove
* add StringUtils::implode
* make StringUtils::startsWith/endsWith ignore case
* add StringUtils::trimExplode characters
* add StringUtils::findMatchingBracketPos

### 2.1.0
* add Escape utility class

### 2.0.0
* update to PHP 7

### 1.0.0
* initial version 