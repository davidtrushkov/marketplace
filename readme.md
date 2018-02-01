<p align="center"><img src="https://i.imgur.com/ShShlzA.png"></p>

<h2 align="center">Marketplace</h2>

## About Marketplace

Marketplace is a file sharing website I made as an open source project where users can sign up, connect their accounts to Stripe and upload a file post along with its uploads to the site where guests and users can buy them (I use test data, and don't take real transactions for Stripe). This was made using Laravel 5.5 and used a mySQL database. The frontend was in Bootstrap 3.3.7.

## Setup

If you decide to clone this project, you will need to make an .env file:
```
cp .env.example .env
php artisan key:generate
```

Once you do that, link the dataabse credentials, and the mail credentials for email testing. I suggest using [mailtrap](https://mailtrap.io/)
If you want to test using Sentry, link that up to SENTRY_DSN in.env file.


## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
