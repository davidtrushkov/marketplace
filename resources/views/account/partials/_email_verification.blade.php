@if(auth()->user()->isVerified())
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Please verify your email address.</h4></div>

            <div class="panel-body">
                <form action="{{ route('send.verification.code') }}" method="post">
                    {{ csrf_field() }}
                    <p>Did not receive a email verification code? Send again.</p>
                    <button type="submit" class="btn btn-info">Send Verification Code</button>
                </form>
            </div>
        </div>
    </div>
@endif