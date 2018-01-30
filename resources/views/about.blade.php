@extends('layouts.app')

@section('content')
    <div class="">
        <div class="container">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 no-padding-xs">
                <div class="auth-box-v2">
                    <p>
                        <b>Overview</b><br />
                        {{ config('app.name') }} is a website I (David Trushkov) built as a learning experience and is NOT intended to be used to take real payments.
                        Users can upload a file post with associated files for other users to download. I do my best to review the files that users upload before I make them live on the website.
                        Users are at their own risk of downloading files from here. Don't expect to upload your files and make money on this site. It is for educational purposes only.
                    </p>
                    <p>
                        <b>Payment</b><br />
                        In order for me to pay you out (test money, NOT real money), you need to make an account with <a href="https://stripe.com/" target="_blank">Stripe</a>
                        so you can receive the portion of your payment when someone buys your files.
                        <br /><br />
                        Before you can make a file, you will see a panel in your account area called "Connect your Stripe account".
                        Once you click that, you will be taken to a Stripe Connect form where you can make a Stripe account, login into Stripe, or just skip by clicking the
                        "Skip this account form" on the top of the page. You are not required to fill out that form and I wouldn't suggest you do that because it brings no purpose for this site.
                    </p>
                    <p>
                        <b>Links</b><br />
                        Here is the GitHub repository for this project: <a href="" target="_blank"></a>
                        <br />
                        Here is my website <a href="http://davidtrushkov.com/" target="_blank">http://davidtrushkov.com/</a>
                    </p>
                    <p>
                        I used icons from <a href="https://www.iconfinder.com/" target="_blank">icon finder</a>
                        <br />
                        Here is the some links to the icon sets I used:
                        <ul>
                            <li>
                                <a href="https://www.iconfinder.com/iconsets/social-productivity-1" target="_blank">Social & Productivity by Iconika</a>
                            </li>
                            <li>
                                <a href="https://www.iconfinder.com/iconsets/printing-industry-1" target="_blank">Printing Industry by iconpack</a>
                            </li>
                            <li>
                                <a href="https://wiki.creativecommons.org/wiki/License_Versions#Detailed_attribution_comparison_chart" target="_blank">Link to creative commons license</a>
                            </li>
                        </ul>
                    </p>
                    <p>
                        Some of this website is based off a tutorial a followed then modified the website even more. Here is the link to it:
                        <ul>
                            <li>
                                <a href="https://www.codecourse.com/lessons/build-a-file-marketplace" target="_blank">Codecourse: Build a File Marketplace with Laravel</a>
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection