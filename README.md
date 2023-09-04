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

## Vue Integration using Vite

first runn the following command to install the vue packages 

```
npm i vue@next
npm i @vitejs/plugin-vue
```

then publish from vendor the pre-configured js files for vue

```
php artisan vendor:publish --tag=rspr-vue
```

also to be sure that your reference temporary files exists lets also publish all the tmp files

```
php artisan vendor:publish --tag=rspr-tmp
```

now lets start integrating vue in your code
first check your layouts the parent blades should have the following codes

```
    @if(View::hasSection('has-vue'))
        <script src="{{ rspr::vers('js/vue-component.js') }}"></script>
    @endif
```

it will look something like this

```
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(View::hasSection('title'))@yield('title'){{ ' - ' }}@endif{{ config('app.name', '') }}</title>
    @if(View::hasSection('has-vue'))
        <script src="{{ rspr::vers('js/vue-component.js') }}"></script>
    @endif
    @vite(['resources/css/compile.css', 'resources/js/compile.js'])
    @stack('cssAsset')
    <link href="{{ rspr::vers('css/app.css') }}" rel="stylesheet" />
    @stack('css')
</head>
```

the important thing in there is that your have the script for "vue-component.js"
now lets go to your "compile.js" file and add the following code or uncomment the code

```
import './compile-vue.js'; 
```

it should look like this

```
import axios from 'axios';
import $ from 'jquery';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte';
import jqueryOverlayScrollbars from 'admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js';
import toastr from 'admin-lte/plugins/toastr/toastr.min.js';
import './compile-vue.js';
```

now copy the "HelloWorld.vue.tmp" and name it "Helloworld.vue" without the .tmp extension
then in your "vite.config.js" uncomment or add the vue integration code

```
import vue from '@vitejs/plugin-vue';

var viteConfig = {
    plugins: [
        vue(), 
```

and it should look something like this

```
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import dotenv from 'dotenv';
import vue from '@vitejs/plugin-vue';
import fs from 'fs';

dotenv.config();

var viteConfig = {
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/compile.css', 'resources/js/compile.js'],
            refresh: true
        })
    ],
```

now in your "vue-component.js" change the "dashboard.index" to the corresponding route name of your page which you are integrating the vue js
as for me I will change it to "project.index"
so from this

```
'use strict';

window.vueComponentPageKeyValuPair = {
    'dashboard.index': [
        'hello-world'
    ]
};
```

to this

```
'use strict';

window.vueComponentPageKeyValuPair = {
    'project.index': [
        'hello-world'
    ]
};
```

now in your page add the following code

```
@section('has-vue', '')
<hello-world></hello-world>
```

then all you need to do is build your scripts

```
npm run build
```

then you should be able to see your vue component in your page

## React Integration using Vite

required packages

```
react
react-dom
@vitejs/plugin-react
```

## License

this package is free, open source, and GPL friendly. You can use it for
commercial projects, open source projects, or really almost whatever you want.

- Code — MIT License
