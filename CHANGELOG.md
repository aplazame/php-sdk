# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) 
and this project adheres to [Semantic Versioning](http://semver.org/).

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

[0.2.0]: https://github.com/aplazame/php-sdk/compare/v0.1.0...v0.2.0
[0.1.0]: https://github.com/aplazame/php-sdk/commit/cd32febb1dfb0afd3a4916204a2efd07a60a4b5f
