# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]
### Added

### Changed

### Deprecated

### Removed

### Fixed

### Security

## [0.3.7] - 2025-09-15
### Added
- PHP 8.4 compatibility.

### Changed

### Deprecated

### Removed

### Fixed

## [0.3.6] - 2023-11-28
### Added
- PHP 8.1 compatibility.

### Changed

### Deprecated

### Removed

### Fixed

## [0.3.5] - 2023-10-11
### Added

### Changed
- API version at checkout header.

### Deprecated

### Removed

### Fixed

## [0.3.4] - 2021-06-22
### Added
- English API documentation links.

### Changed

### Deprecated

### Removed

### Fixed

## [0.3.3] - 2021-06-22
### Added

### Changed
- URL redirects.

### Deprecated

### Removed

### Fixed
- Documentation links.

## [0.3.2] - 2020-10-16
### Added

### Changed
- [Examples] Checkout creation real examples changed for non-real ones

### Deprecated

### Removed

### Fixed

## [0.3.1] - 2019-10-01
### Added

### Changed

### Deprecated

### Removed

### Fixed
- [Api] Request now allow to provide "objects" as payload

## [0.3.0] - 2019-08-29
### Added
- Added examples (/examples) for the server to server checkout integration

### Changed
- Use native PHP 5.5 JsonSerializable on Date and Decimal serializer

### Deprecated

### Removed
- Drop support for PHP version lower than 5.6
- Remove custom JsonSerializer in favor on builtin JsonSerializable interface

### Fixed

## [0.2.2] - 2017-11-22
### Added

### Changed

### Deprecated

### Removed

### Fixed
- [Serializer] Fix serialization of empty objects.

## [0.2.1] - 2016-11-23
### Added

### Changed

### Deprecated

### Removed

### Fixed
- [Api] path is appended twice to API base URI.

### Security

## [0.2.0] - 2016-11-23
### Added
- [Api] Add `getHttpStatusCode` to `ApiClientException` and `ApiServerException`. This method returns the response HTTP status code.
- [Serializer] New component focused only in assist the conversion of PHP types to JSON compatible types.

### Changed
- [BusinessModel] This component has been replaced by [Serializer]
- [Api] Change in `ApiClientException` and `ApiServerException` constructor signature.

### Deprecated

### Removed
- [BusinessModel] This component has been replaced by [Serializer]

### Fixed

### Security

## [0.1.0] - 2016-07-07
### Added
- API Client
- Business models

[Unreleased]: https://github.com/aplazame/php-sdk/compare/v0.3.7...HEAD
[0.3.7]: https://github.com/aplazame/php-sdk/compare/v0.3.6...v0.3.7
[0.3.6]: https://github.com/aplazame/php-sdk/compare/v0.3.5...v0.3.6
[0.3.5]: https://github.com/aplazame/php-sdk/compare/v0.3.4...v0.3.5
[0.3.4]: https://github.com/aplazame/php-sdk/compare/v0.3.3...v0.3.4
[0.3.3]: https://github.com/aplazame/php-sdk/compare/v0.3.2...v0.3.3
[0.3.2]: https://github.com/aplazame/php-sdk/compare/v0.3.1...v0.3.2
[0.3.1]: https://github.com/aplazame/php-sdk/compare/v0.3.0...v0.3.1
[0.3.0]: https://github.com/aplazame/php-sdk/compare/v0.2.2...v0.3.0
[0.2.2]: https://github.com/aplazame/php-sdk/compare/v0.2.1...v0.2.2
[0.2.1]: https://github.com/aplazame/php-sdk/compare/v0.2.0...v0.2.1
[0.2.0]: https://github.com/aplazame/php-sdk/compare/v0.1.0...v0.2.0
[0.1.0]: https://github.com/aplazame/php-sdk/commit/cd32febb1dfb0afd3a4916204a2efd07a60a4b5f
