<div class="container-fluid no-padding FOOTER">
    <div class="container no-padding-xs">
        <div class="col-sm-4 no-padding-xs">
            <ul>
                <li class="HEADER">Using Marketplace</li>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a href="/files">
                        Files
                    </a>
                </li>
                @if(auth()->guest())
                <li>
                    <a href="/login">
                        Login
                    </a>
                </li>
                <li>
                    <a href="/register">
                        Register
                    </a>
                </li>
                @endif
                @if(auth()->user())
                    @if(auth()->user()->hasRole('admin'))
                        <li>
                            <a href="/admin">
                                Admin Dashboard
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
        <div class="col-sm-4 no-padding-xs">
            <ul>
                <li class="HEADER">Helpful Links</li>
                <li>
                    <a href="">GitHub</a>
                </li>
                <li>
                    <a href="/about">
                        About
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-4">

        </div>
    </div>
</div>
