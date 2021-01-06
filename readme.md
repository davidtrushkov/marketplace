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

+ Once you do that, link the database credentials, and the mail credentials for email testing. I suggest using [mailtrap](https://mailtrap.io/)
+ If you want to test using Sentry, link that up to SENTRY_DSN in.env file.
+ Link up the RECAPTCHA_SECRET by going to [Google Recaptcha](https://www.google.com/recaptcha/intro/) and getting a key.

Then you have to link your Stripe key, secret key and connect key. 
* To get your STRIPE_KEY and STRIPE_SECRET, signup/login into [Stripe](https://stripe.com/), switch data to test data by clicking the "View Test Data" on the left side navigation on your Stripe dashboard, then go to API and you will see your keys. 

I use Stripe Connect, which splits payments between parties. 
* To get your STRIPE_CONNECT_KEY, go to Connect then Settings on your dashboard. There you will see the STRIPE_CONNECT_KEY.
* One more thing you will need to do in Stripe is set up a Redirect URL for once a user connects their stripe account to this project. To do that, go to Connect, Settings and there you have an option to setup a redirect URL. The URL will be ``` <your-domain>/account/connect/complete ```
For example:
+ ``` localhost:8080/account/connect/complete ```
+ ``` marketplace.dev/account/connect/complete ```

If you want to test how the connect works, you will have to make a second account on Stripe, then once you make a new user, Connect that account with the second Stripe account you made. Additionally, you can upload a logo on Stripe for when users connect to this website under the Branding section.

To control how much you take as the site owner, go to ``` config/marketplace.php ``` then you can edit what commission you get. Default set to 20 (%20)

## Security Vulnerabilities and Other Problems

If you discover a security vulnerability or any other bugs within this app, please make a Issue on here. This website is not meant to be in production.

## License

MIT License

Copyright (c) [year] [fullname]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
