# Marketplace API client changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 4.0.0 - 2021-11-26

### Added

- released version 4 out of beta phase

## 4.0.0-beta.4 - 2021-11-25

### Added

- `mdpClassic` and `mdpSpectrum` attributes to `BasicOrder` and `Order` entities
- `Order` client documentation

## 4.0.0-beta.3 - 2021-11-25

### Added

- `isPhe` attribute to Category client `TreeMenuItem` entity
- `weeeFee` attribute to `Product` entity and `ProductRequest` DTO

## 4.0.0-beta.2 - 2021-11-22

### Added

- rest of missing `Article` documentation
- requirements to Readme

### Changed

- fixed small issues with documentation
- used array concat instead of `array_merge`

### Fixed

- `Product` entity would not return all fields in `jsonEncode` result

## 4.0.0-beta.1 - 2021-08-25

### Added

- part of missing `Article` documentation

### Changed

- fixed small issues with documentation
- url of docker image inside `Makefile`

### Removed

- invalid `@throws` annotations

## 4.0.0-beta

### Added

- new major version, incompatible with `v3`
