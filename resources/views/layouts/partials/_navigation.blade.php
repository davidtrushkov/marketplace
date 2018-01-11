<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('files.index') }}">Files</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}" class="btn btn-info">Sign In</a></li>
                        <li><a href="{{ route('register') }}" class="btn btn-primary">Start Selling</a></li>
                    @else
                        @if(session()->has('impersonate'))
                            <li>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('impersonating').submit();">
                                    Stop Impersonating
                                </a>
                            </li>
                            <form action="{{ route('admin.impersonate.delete') }}" method="post" id="impersonating" class="hidden">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                @if(auth()->user()->avatar)
                                    <img src="/images/avatars/{{ auth()->user()->avatar }}" alt="User avatar" class="user-avatar">
                                @endif
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @admin('admin')
                                <li>
                                    <a href="{{ route('admin.index') }}">
                                        <img src="/images/icons/gears.svg" width="25px"> Admin
                                    </a>
                                </li>
                                @endadmin
                                <li>
                                    <a href="/account">
                                        <img src="/images/icons/gears.svg" width="25px"> Your Account
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <img src="/images/icons/signout.svg" width="25px"> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>