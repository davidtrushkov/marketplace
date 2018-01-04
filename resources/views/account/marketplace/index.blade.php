@extends('account.layouts.default')

@section('account.content')
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Please connect your Stripe account to start creating and selling files.</h4></div>
            <div class="panel-body">
                <p>
                    In order for us to pay you out, you need to make an account with Stripe so you can receive the portion of your payment when someone buys your files.
                    You can also sign into your existing account if you have one.
                </p>
                <a href="https://connect.stripe.com/oauth/authorize?response_type=code&state={{ session('stripe_token') }}&scope=read_write&client_id={{ config('services.stripe_connect.key') }}" class="btn btn-info">Connect your Stripe account</a>
            </div>
        </div>
    </div>
@endsection