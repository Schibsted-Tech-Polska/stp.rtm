# Stp.Rtm

Real time monitor dashboard using Jenkins API and New Relic API

![ScreenShot](screenshot.png "Dashboard")

## Dependencies
- php >="5.3.3"
- cURL
- Zend Framework "2.2.0"
- Doctrine-mongo-odm-module
- MongoDB PHP driver
- [Whoops](https://github.com/filp/whoops) error handler
- MongoDB server (required only by Message widget)

## Installation

The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies. If you want to install packages listed in
require-dev, skip "--no-dev" option.

    php composer.phar self-update
    php composer.phar install --no-dev

(The `self-update` directive is to ensure you have an up-to-date `composer.phar`
available.)


## Available types of widgets

- <strong>Number</strong> - Displays numeric value with percentage difference between current and previous value.
- <strong>Graph</strong> - Similar to Number widget but with additional graph displaying history of values.
- <strong>Message</strong> - Displays text messages that can be pushed to a database using REST API.
- <strong>Build</strong> - Displays current status of a build with additional info about build author and code coverage (if provided).
During a build process it shows progress bar. Widget relies on Jenkins REST API.
- <strong>Error</strong> - Similar to Number widget but with different behaviour when some errors appear.
- <strong>Alert</strong> - Shows urls that produced 500 status code (internal server error). Widget relies on Splunk REST API.

## Usage

### Defining configuration file



#License

Distributed under the MIT license
