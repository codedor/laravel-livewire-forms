# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [v3.0.0] - 2022-07-26

### Added

-   PHP 8 support
-   Laravel 9 support
-   Added tests via Pest

### Changed

-   Replace pragmarx/countries by petercoles/multilingual-country-list
-   Throw validation error when uploading file fails
-   Use correct variable for single file upload.
-   Update docs structure

### Removed

-   Dropped PHP 7.4 and L8 constraints, since media package is broken for those versions for sqlite, which we use in tests

## [2.2.0] - 2021-12-23

### Added

-   Browser event is dispatched if form is submitted
-   Compatibility for Livewire v2 (together with v1)

### Changed

-   Default classes are now configurable
-   Updated documentation

### Removed

-   Unnecessary `optional()` helpers are removed

## [2.1.0] - 2021-07-08

### Added

-   Added Form generation commands
-   Added possibility to pass custom rule namespace instead of object.

## [2.0.3] - 2021-03-16

### Added

-   GDPR component
-   Spacer field

## [2.0.2] - 2021-02-04

### Added

-   Flash data and functions

## [2.0.1] - 2021-01-25

### Added

-   beforeSave() in the submit logic

## [2.0.0] - 2020-10-14

-   Release the refactored version

## [1.0.0] - 2020-08-18

-   Initial release
