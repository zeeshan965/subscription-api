<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Subscription API

A simple subscription platform(only REST APIs with MySQL) in which users can subscribe to a website (there can be multiple websites in the system). Whenever a new post is published on a particular website, all it's subscribers shall receive an email with the post title and description in it. (no authentication of any kind is required)

## Points Covered:

- Use PHP 7.* or 8.*
- Write migrations for the required tables.
- Endpoint to create a "post" for a "particular website".
- Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
- Use of command to send email to the subscribers (command must check all websites and send all new posts to subscribers which haven't been sent yet).
- Use of queues to schedule sending in background.
- No duplicate stories should get sent to subscribers.

## Optional Points Covered:

- Seeded data of the websites.
- Open API documentation (or) Postman collection demonstrating available APIs & their usage.
- Use of events/listeners.

## Installation:

- Clone the repository
- copy .env.example and create .env
- composer install
- php artisan migrate
- php artisan db:seed
- php artisan serve
- import postman collection from root

## Notes

- For exception handling I did handle some basic error handling but due to time shortage I did not made any custom error handling.
- When new post is created event is being fired and we log the data to larvavel.log file.
- Technically speaking in my opinion queue dispatch jobs not console commands, In order to handle console commands one needs to use to schedule the jobs lets say daily using cron job. Basically we cannot use console command, event, and queue all together to send email notification to users about new post. We can simple use one e.g,
    - when new post is created we can dispatch emails to all the users.
    - Or we can schedule console command to dispatch emails on day end daily.
    - Or we can dispatch a job in queue once the new post is created.

- to fire the concosle commands and dispatch all email notifications php artisan app:send-new-post-notifications
- check laravel.log file to see email content
