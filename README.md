# DataValues Interfaces

The design of this library is poor and its reason for existing is questionable. Most of the
time you are likely better served by creating dedicated interfaces within your project.

DataValues Interfaces is a small PHP library that defines a set of interfaces for parsers,
formatters and validators. It is part of the [DataValues set of libraries](https://github.com/DataValues).

[![Code Coverage](https://scrutinizer-ci.com/g/DataValues/Interfaces/badges/coverage.png?s=6432d29bf3fed068995e66093ad52e053099a916)](https://scrutinizer-ci.com/g/DataValues/Interfaces/)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/DataValues/Interfaces/badges/quality-score.png?s=da1bb6ea09762d9e3a143e473cdefa712db46804)](https://scrutinizer-ci.com/g/DataValues/Interfaces/)

On [Packagist](https://packagist.org/packages/data-values/interfaces):
[![Latest Stable Version](https://poser.pugx.org/data-values/interfaces/version.png)](https://packagist.org/packages/data-values/interfaces)
[![Download count](https://poser.pugx.org/data-values/interfaces/d/total.png)](https://packagist.org/packages/data-values/interfaces)


## Installation

To use this library in your project, simply add a dependency on `data-values/interfaces`
to your project's `composer.json` file. Here is a minimal example of a `composer.json`
file that just defines a dependency on Interfaces 1.x:

```json
{
    "require": {
        "data-values/interfaces": "^1.0"
    }
}
```

## Tests

This library comes with a set up PHPUnit tests that cover all non-trivial code. You can run these
tests using the PHPUnit configuration file found in the root directory. The tests can also be run
via Github Actions.

## Release notes

### 1.0.0 (2021-01-20)

* Updated minimum required PHP version from 5.5.9 to 7.2
* Removed `ValueFormatterBase`
* Removed `ValueFormatterTestBase`
* Removed `ValueValidator::setOptions`
* Removed `ValueValidatorObject`
* Removed `DATAVALUES_INTERFACES_VERSION` constant
* `ValueValidators\Result` is now final
* The properties of `ValueValidators\Error` are now private instead of protected

### 0.2.5 (2017-08-09)

* Removed MediaWiki extension credits registration

### 0.2.4 (2017-08-02)

* Fixed `ValueFormatterTestBase` not being installable via Composer.

### 0.2.3 (2017-08-02)

* Updated minimal required PHP version from 5.3 to 5.5.9.
* Minor fixes to code documentation.
* Added PHPCS support.

### 0.2.2 (2016-07-15)

* Fixed `ValueFormatterTestBase` not doing strict string comparisons.

### 0.2.1 (2016-01-13)

* Fixed an issue when using this component with HHVM 1.11.0 (see #21).

### 0.2.0 (2015-08-11)

* Dropped deprecated `ErrorObject`, use `Error` instead
* Dropped deprecated `ResultObject`, use `Result` instead
* Dropped deprecated constant `DataValuesInterfaces_VERSION`, use `DATAVALUES_INTERFACES_VERSION` instead
* Dropped `ValueFormatterTestBase::getFormatterClass`
* Made `ValueFormatterTestBase::getInstance` abstract
* The options in `ValueFormatterTestBase::getInstance` are now optional

### 0.1.5 (2015-02-14)

* The options in the `ValueFormatterBase` constructor are now optional
* The MediaWiki extension registration now includes the license

### 0.1.4 (2014-04-14)

* Added rawValue and expectedFormat arguments to `ValueParsers\ParseException`

### 0.1.3 (2014-03-31)

* Added `ValueFormatters\FormattingException`

### 0.1.2 (2013-11-22)

* Improved autoloading code
* Fixed link in MediaWiki credits
* Renamed entry point from DataValuesInterfaces.php to Interfaces.php

### 0.1.0 (2013-11-16)

Initial release with these features:

* `ValueFormatters\ValueFormatter` interface
* `ValueParsers\ValueParser` interface
* `ValueValidators\ValueValidator` interface

## Links

* [DataValues Interfaces on Packagist](https://packagist.org/packages/data-values/interfaces)
