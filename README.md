# Laravel starter (package-rspr-laravel-starter)

- rspr/laravel-starter
- namespace: RSPR\LaravelStarter

> Version 10.0.11 (latest)

Laravel starter comes with helpful methods in making laravel projects

## Installation

download the package via composer

`composer require rspr/laravel-starter`

## Files, Classes and Methods

### Files

* Library/L0g.php - Custom message logs, uses the original laravel logging class \Log::class, this helps the logging message to be more readable
* Library/SlackLog.php - Slack log message which use webhooks from slack API, this helps the logging message to be more readable

### Methods

File versioning method, helps import files with version suffix so updated file will be imported and not the cache files

```
rspr::vers('js/app.js')
```

Message Log, uses the default \Log::class of the laravel but with more readability.
- can pass a 2nd array parameter

```
RSPRL0g::emergency('this is an emergency message');
RSPRL0g::alert('this is an alert message');
RSPRL0g::critical('this is an alert message');
RSPRL0g::error('this is an alert message');
RSPRL0g::warning('this is an alert message');
RSPRL0g::notice('this is an alert message');
RSPRL0g::info('this is an alert message');
RSPRL0g::debug('this is an alert message');
```

Sample output:

```
[2022-04-10 03:01:21] local.ERROR: ***XController.php@xmethod:11***
Message: "test log"

| data: additional data

File trace:
	file:
		/var/www/dc/vendor/ryne/laravel-starter/src/L0g.php@39 Function: error()
		/var/www/dc/app/Http/Controllers/XController.php@11 Function: xmethod()
		/var/www/dc/vendor/laravel/framework/src/Illuminate/Routing/Controller.php@54 Function: callAction()
__________________________________________________________________________________________________  
```

Message Slack Log, uses the "channel=slack" for message (only works if "slack.enable=true" and if webhook is configured)

```
RSPRSlackLog::emergency('this is an emergency message');
RSPRSlackLog::alert('this is an alert message');
RSPRSlackLog::critical('this is an alert message');
RSPRSlackLog::error('this is an alert message');
RSPRSlackLog::warning('this is an alert message');
RSPRSlackLog::notice('this is an alert message');
RSPRSlackLog::info('this is an alert message');
RSPRSlackLog::debug('this is an alert message');
```

Uses both Laravel log and Slack log at the same time.

```
RSPRLog::emergency('this is an emergency message');
RSPRLog::alert('this is an alert message');
RSPRLog::critical('this is an alert message');
RSPRLog::error('this is an alert message');
RSPRLog::warning('this is an alert message');
RSPRLog::notice('this is an alert message');
RSPRLog::info('this is an alert message');
RSPRLog::debug('this is an alert message');
```

## Publishers

```
php artisan vendor:publish --tag=rspr-config
php artisan vendor:publish --tag=rspr-env-temp
php artisan vendor:publish --tag=rspr-images-common
php artisan vendor:publish --tag=rspr-lang
php artisan vendor:publish --tag=rspr-lang-en
php artisan vendor:publish --tag=rspr-lang-ja
php artisan vendor:publish --tag=rspr-manager
php artisan vendor:publish --tag=rspr-model
php artisan vendor:publish --tag=rspr-phpcs
php artisan vendor:publish --tag=rspr-public-css
php artisan vendor:publish --tag=rspr-public-js
php artisan vendor:publish --tag=rspr-repository
php artisan vendor:publish --tag=rspr-response
php artisan vendor:publish --tag=rspr-response-code
php artisan vendor:publish --tag=rspr-resources-css
php artisan vendor:publish --tag=rspr-resources-js
php artisan vendor:publish --tag=rspr-resources-views
php artisan vendor:publish --tag=rspr-vite-config
php artisan vendor:publish --tag=rspr-starter
```

## License

this package is free, open source, and GPL friendly. You can use it for
commercial projects, open source projects, or really almost whatever you want.

- Code — MIT License
