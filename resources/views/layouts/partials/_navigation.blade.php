<div class="container no-padding-xs" id="NAVIGATION-SECTION">
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
                    <span class="hidden-xs">
                        <img src="/images/icons/marketplace-logo.png" alt="{{ config('app.name') }}" />
                    </span>
                    <span class="visible-xs">
                        <img src="/images/icons/favicon-32x32.png" alt="{{ config('app.name') }}" />
                    </span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('files.index') }}">Files</a></li>
                    @if (Auth::guest())
                            <li class="hidden-xs"><a href="{{ route('login') }}" class="btn btn-info">Sign In</a></li>
                            <li class="hidden-xs"><a href="{{ route('register') }}" class="btn btn-primary">Start Selling</a></li>
                            <li class="visible-xs"><a href="{{ route('login') }}">Sign In</a></li>
                            <li class="visible-xs"><a href="{{ route('register') }}">Start Selling</a></li>
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
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge badge-light">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu notification-dropdown" role="menu">
                                @foreach(auth()->user()->unreadNotifications->take(10) as $notification)
                                    <li>
                                        <a href="{{ route('show.notification', $notification->id) }}" class="notification-a">
                                            {{ str_limit($notification->data['header'], 50) }}
                                            <div><small>{{ $notification->created_at->diffForHumans() }}</small></div>
                                        </a>
                                    </li>
                                    @if(auth()->user()->unreadNotifications->count() > 10)
                                        <li>
                                            <a href="#" class="notification-a">+ {{ auth()->user()->unreadNotifications->count() - 10 }} more...</a>
                                        </li>
                                    @endif
                                @endforeach
                                <li>
                                    <div class="col-sm-12 no-padding notification-footer">
                                        <div class="col-xs-7 col-sm-7 notification-pad">
                                            <a href="{{ route('notifications.mark.all.as.read') }}">Mark All as Read</a>
                                        </div>
                                        <div class="col-xs-5 col-sm-5 notification-pad">
                                           <span class="hidden-xs">
                                                <a href="{{ route('get.all.notifications') }}" class="pull-right">See All</a>
                                           </span>
                                            <span class="visible-xs">
                                                <a href="{{ route('get.all.notifications') }}">See All</a>
                                           </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>