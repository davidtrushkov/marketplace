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

+ Once you do that, link the dataabse credentials, and the mail credentials for email testing. I suggest using [mailtrap](https://mailtrap.io/)
+ If you want to test using Sentry, link that up to SENTRY_DSN in.env file.
+ Link up the RECAPTCHA_SECRET by going to [Google Recaptcha](https://www.google.com/recaptcha/intro/) and getting a key.

Then you have to link your Stripe key, secret key and connect key. 
* To get your STRIPE_KEY and STRIPE_SECRET, signup/login into [Stripe](https://stripe.com/), switch data to test data by clicking the "View Test Data" on the left side navigation on your Stripe dashboard, then go to API and you will see your keys. 

* To get your STRIPE_CONNECT_KEY, go to Connect then Settings on your dashboard. There you will see the STRIPE_CONNECT_KEY.
* One more thing you will need to do in Stripe is set up a Redirect URL for once a user connects their stripe account to this project. To do that, go to Connect, Settings and there you have an option to setup a redirect URL. The URL will be ``` <your-domain>/account/connect/complete ```
For example:
+ ``` localhost:8080/account/connect/complete ```
+ ``` marketplace.dev/account/connect/complete ```

If you want to test how the connect works, you will have to make a second account on Stripe, then once you make a new user, Connect that account with the second Stripe account you made.


## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
