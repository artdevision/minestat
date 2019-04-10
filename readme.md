<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Ethos statistics panel

An alternate free simple but useful panel for Ethos mining rigs. Application based on Laravel 5.8.10 framework.

You can install it on your own server and it will be useful tool to control your mining farm.

Having charts almost for all indicators. 

Includes all needed dependency with `docker-compose` you can setup docker-ce and docker-compose and run application.

Passed testing and optimising on farm over 100 rigs with hi frequency requests from rigs on VDS with 2CPU and 2GB.

### Features
- MongoDB data storage
- Bootstrap admin panel
- Charts
- Throttle control of requests per minute from rigs, to balance load of application server 
- Basic authentication for user
- Included `cron` task for reset outdated statistic.  
- Redis queue service for consistent update incoming requests from rigs.

### Coming soon

- Summary farm dashboard
- Notification on critical rigs states
- Users roles control
- Remote configuration

## EthOS setting up

Edit the web hook address manually. May be done vis SSH, direct from keyboard or Teamviewer

- run shell command `sudo nano /opt/ethos/lib/functions.php`
- find the line like this `$hook = "http://ethosdistro.com/get.php";`
- edit it to match `$hook = "http://{your_app_domain}/api/pushstat"` where `{your_app_domain}` is your server domain or IP;

## Integration and Customisation

I can provide services for the installation and customisation of the application to your needs for. Of course not free :) [artdevision@gmail.com](mailto:artdevision@gmail.com)

## Donations

I am developing a project in my spare time. If the project was useful to you, I will be grateful for the donations:
- BTC: 1NzE3SNCrHGaUjMQxWGJaCMw1MqUUaWHSQ

## License

[MIT license](https://opensource.org/licenses/MIT).
