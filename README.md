Custom log viewer for laravel-admin. 
============================
Useful when log file is not at the default storage path

## Screenshot

![wx20170809-165644](https://user-images.githubusercontent.com/1479100/29113581-fe48fd86-7d23-11e7-9ee7-9680957171ee.png)

## Installation

```
$ composer require fadlisaad/laravel-log-viewer -vvv

$ php artisan admin:import log-viewer

```
Add new config `custom_log_path` with path to your custom log path.

Open `http://localhost/admin/logs`.

License
------------
Licensed under [The MIT License (MIT)](LICENSE).
