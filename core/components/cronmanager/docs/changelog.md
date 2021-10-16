# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.4] - 2021-10-17

### Added

- Improvements to the execution order
- Pass the modCronjob instance to the executed snippet in the CronManagerJob snippet property

## [1.2.3] - 2021-09-16

### Added

- Run all cronjobs with one click on a button
- Run single cronjobs via the context menu or the action button
- Delete selected logs

### Fixed

- Purging the logs did not work [#45]
- The cronjob log search did not work [#45]
- Only the first CronManager job entry was executed

## [1.2.2] - 2021-07-02

### Changed

- Add CronManager = 1 as a default snippet property

### Removed

- Unused code

## [1.2.1] - 2019-09-23

### Changed

- Fix a default sort issue

### Added

- Output the run date in webcronjob mode
- Log request parameter issues in webcronjob mode

## [1.2.0] - 2019-09-10

### Changed

- Removed modAction Support
- Change flat file to class based processors
- Code refactoring
- Catch fatal snippet errors and log them in the CronManager log
- Run the cron connector from the web with a cronjob_id property

## [1.1.0] - 2012-04-29

### Changed

- Fixed some UI stuff
- Batch purge logs without error
- Filter logs containing errors

### Added

- Added an error field to logs

## [1.0.1] - 2012-02-06

### Changed

- Enable viewing longer logs messages in a window
- Prevent having negative values in numberFields
- Made the UI 2.2 compatible

### Added

- Grid dates now supports manager_*_format system settings
- Cron job next run editable via the grid
- Some addition to the logs grid

## [1.0.0] - 2011-06-06

### Added

- Initial commit
