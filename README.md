# DataValues Interfaces

DataValues Interfaces is a small PHP library that defines a set of interfaces for parsers,
formatters and validators that are build on top of the DataValues library.

Recent changes can be found in the [release notes](docs/RELEASE-NOTES.md).

[![Build Status](https://secure.travis-ci.org/JeroenDeDauw/DataValuesInterfaces.png?branch=master)](http://travis-ci.org/JeroenDeDauw/DataValuesInterfaces)

On [Packagist](https://packagist.org/packages/data-values/interfaces):
[![Latest Stable Version](https://poser.pugx.org/data-values/interfaces/version.png)](https://packagist.org/packages/data-values/interfaces)
[![Download count](https://poser.pugx.org/data-values/interfaces/d/total.png)](https://packagist.org/packages/data-values/interfaces)

## Requirements

* PHP 5.3 or later
* DataValues library - see composer.json to get the required version

## Installation

You can use [Composer](http://getcomposer.org/) to download and install
this package as well as its dependencies. Alternatively you can simply clone
the git repository and take care of loading yourself.

### Composer

To add this package as a local, per-project dependency to your project, simply add a
dependency on `data-values/interfaces` to your project's `composer.json` file.
Here is a minimal example of a `composer.json` file that just defines a dependency on
DataValues Interfaces 1.0:

    {
        "require": {
            "data-values/interfaces": "1.0.*"
        }
    }

### Manual

Get the DataValues Interfaces code, either via git, or some other means. Also get all dependencies.
You can find a list of the dependencies in the "require" section of the composer.json file.
Load all dependencies and the load the DataValues Interfaces library by including its entry point:
DataValuesInterfaces.php.

## Tests

This library comes with a set up PHPUnit tests that cover all non-trivial code. You can run these
tests using the PHPUnit configuration file found in the root directory. The tests can also be run
via TravisCI, as a TravisCI configuration file is also provided in the root directory.

## Authors

DataValues Interfaces has been written by [Jeroen De Dauw](https://www.mediawiki.org/wiki/User:Jeroen_De_Dauw),
as [Wikimedia Germany](https://wikimedia.de) employee for the [Wikidata project](https://wikidata.org/).

## Release notes

### 0.1 (2013-11-16)

Initial release with these features:

* ValueFormatters\ValueFormatter interface
* ValueParsers\ValueParser interface
* ValueValidators\ValueValidator interface

## Links

* [DataValues Interfaces on Packagist](https://packagist.org/packages/data-values/interfaces)