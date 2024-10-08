# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.4.0] - 2024-09-07

### Added

- Add a running column to the cronjob table.
- Don't execute a cronjob if it is already running
- Purge running cronjobs after minutes set by the cronmanager.purge_running system setting 

### Fixed

- Fix cronjobs_log table getting flooded with entries - thanks to Intersel

## [1.3.2] - 2024-08-12

### Changed

- Calculate the nextrun on base of the last run and not on the execution time of the cron connector
- Add an editable nextrun field in the cronjob create/update window

## [1.3.1] - 2024-02-14

### Fixed

- Fix requested processor not found

## [1.3.0] - 2022-09-09

### Added

- Settings grid for CronManager settings
- The cronjobs grid can be sorted by all columns

### Changed

- Move the log panel to a new tab
- Open a window to view the log entries of a single cronjob

### Fixed

- Improved fix for showing NaN dates in Safari
- Purge logs without error deletes all log entries

## [1.2.7] - 2022-08-15

### Fixed

- Fix showing NaN dates in Safari

## [1.2.6] - 2021-12-30

### Fixed

- Fix undefined array key warning [#49]

### Changed

- Code refactoring
- Full MODX 3 compatibility

## [1.2.5] - 2021-11-11

### Fixed

- Pass the modCronjob instance to the executed snippet by option to avoid pdoTools issues

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
