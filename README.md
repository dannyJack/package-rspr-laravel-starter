# Laravel starter (package-rspr-laravel-starter)

- rspr/laravel-starter
- namespace: RSPR\LaravelStarter

> Version 10.0.11 (latest)

Laravel starter comes with helpful methods in making laravel projects

## Installation

download the package via composer

`composer require rspr/laravel-starter`

## Publishers

```
php artisan vendor:publish --tag=rspr-asset-js-toastr
php artisan vendor:publish --tag=rspr-config
php artisan vendor:publish --tag=rspr-controller
php artisan vendor:publish --tag=rspr-env-temp
php artisan vendor:publish --tag=rspr-images-common
php artisan vendor:publish --tag=rspr-lang
php artisan vendor:publish --tag=rspr-lang-en
php artisan vendor:publish --tag=rspr-lang-ja
php artisan vendor:publish --tag=rspr-manager
php artisan vendor:publish --tag=rspr-manager-complete
php artisan vendor:publish --tag=rspr-manager-tmp
php artisan vendor:publish --tag=rspr-model
php artisan vendor:publish --tag=rspr-model-tmp
php artisan vendor:publish --tag=rspr-phpcs
php artisan vendor:publish --tag=rspr-public-css
php artisan vendor:publish --tag=rspr-public-js
php artisan vendor:publish --tag=rspr-public-js-tmp
php artisan vendor:publish --tag=rspr-repository
php artisan vendor:publish --tag=rspr-repository-complete
php artisan vendor:publish --tag=rspr-repository-tmp
php artisan vendor:publish --tag=rspr-response-manager
php artisan vendor:publish --tag=rspr-response-repository
php artisan vendor:publish --tag=rspr-response-child
php artisan vendor:publish --tag=rspr-response-parent
php artisan vendor:publish --tag=rspr-response
php artisan vendor:publish --tag=rspr-response-code
php artisan vendor:publish --tag=rspr-response-code-tmp
php artisan vendor:publish --tag=rspr-resources-css
php artisan vendor:publish --tag=rspr-resources-js
php artisan vendor:publish --tag=rspr-resources-views
php artisan vendor:publish --tag=rspr-vite-config
```

for starter files

```
php artisan vendor:publish --tag=rspr-starter
```

for sample temporary files

```
php artisan vendor:publish --tag=rspr-tmp
```

## Global classes

- rspr - usefull in blade template. Contains helpfull method like "vers" and "isRoute"
- RSPRL0g - same as \Log::class but with a better logging message output.
- RSPRSlackLog - slack log messaging/notification with an implementation of RSPRL0g better logging message output.
- RSPRLog - combined RSPRL0g and RSPRSlackLog implementation which output logs in the logger file and send message through slack webhook.

## Pre-defined Alias classes

* L0g.php - Custom message logs, uses the original laravel logging class \Log::class, this helps the logging message to be more readable
* SlackLog.php - Slack log message which use webhooks from slack API, this helps the logging message to be more readable

## Details

File versioning method, helps import files with version suffix so updated file will be imported and not the cache files

```
rspr::vers('js/app.js')
```

output: http://127.0.0.1/js/app.js?v=123456

e.g

```
<link href="{{ rspr::vers('css/app.css') }}" rel="stylesheet" />
```

output:

```
<link href="http://127.0.0.1/css/app.css?v=123456" rel="stylesheet" />
```

Blade route checking.

```
rspr::isRoute('user.dashboard')
```

output: 'active'

e.g

```
<li class="nav-item">
	<a href="{{ route('user.dashboard') }}" class="nav-link{{ rspr::isRoute('user.dashboard') }}">
		<i class="nav-icon fas fa-tachometer-alt half"></i>
		<p>{{ __('words.Dashboard') }}</p>
	</a>
</li>
```

output:

```
<li class="nav-item">
	<a href="http://127.0.0.1/dashboard" class="nav-link active">
		<i class="nav-icon fas fa-tachometer-alt half"></i>
		<p>Dashboard</p>
	</a>
</li>
```

Message Log, uses the default \Log::class of the laravel but with more readability.

```
RSPRL0g::emergency('this is an emergency message', []);
RSPRL0g::alert('this is an alert message', []);
RSPRL0g::critical('this is an alert message', []);
RSPRL0g::error('this is an alert message', []);
RSPRL0g::warning('this is an alert message', []);
RSPRL0g::notice('this is an alert message', []);
RSPRL0g::info('this is an alert message', []);
RSPRL0g::debug('this is an alert message', []);
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

## License

this package is free, open source, and GPL friendly. You can use it for
commercial projects, open source projects, or really almost whatever you want.

- Code — MIT License
