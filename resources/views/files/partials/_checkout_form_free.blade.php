<form action="{{ route('checkout.free', $file) }}" method="post">
    {{ csrf_field() }}

   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
       <input type="email" class="form-control" name="email" id="email" required placeholder="Enter your email" value="{{ old('email') }}" />
       @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
       @endif
   </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">Download for free</button>
    </div>

</form>