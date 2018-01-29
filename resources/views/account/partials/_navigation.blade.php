<div id="ACCOUNT-SIDE-NAV" class="hidden-xs">
    <ul class="list-group">
        <li class="list-group-item {{ isActiveRoute('account') }}">
            <a href="{{ route('account') }}">Account</a>
        </li>
        <li class="list-group-item {{ isActiveRoute('account.files.index') }}">
            <a href="{{ route('account.files.index') }}">Your files</a>
        </li>
        <li class="list-group-item{{ Request::is('account/files/*/create') ? ' active' : '' }}">
            <a href="{{ route('account.files.create.start') }}">Sell a file</a>
        </li>
    </ul>

    <ul class="list-group">
        <li class="list-group-item {{ isActiveRoute('bought.files') }}">
            <a href="{{ route('bought.files') }}">Bought Files</a>
        </li>
        <li class="list-group-item {{ isActiveRoute('files.sold') }}">
            <a href="{{ route('files.sold') }}">Files Sold</a>
        </li>
        <li class="list-group-item {{ isActiveRoute('get.unread.notifications') }}">
            <a href="{{ route('get.unread.notifications') }}">
                Notifications
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="badge badge-light pull-right">{{ auth()->user()->unreadNotifications->count() }}</span>
                @endif
            </a>
        </li>
    </ul>

    <ul class="list-group">
        <li class="list-group-item {{ isActiveRoute('change.password') }}">
            <a href="{{ route('change.password') }}">
                Change password
            </a>
        </li>
    </ul>
</div>


<div class="visible-xs">
    <a class="btn btn-primary account-menu-button" role="button" data-toggle="collapse" href="#accountNav" aria-expanded="false" aria-controls="accountNav">
        Account Menu
    </a>

    <div class="collapse" id="accountNav">
        <div id="ACCOUNT-SIDE-NAV">
            <ul class="list-group">
                <li class="list-group-item {{ isActiveRoute('account') }}">
                    <a href="{{ route('account') }}">Account</a>
                </li>
                <li class="list-group-item {{ isActiveRoute('account.files.index') }}">
                    <a href="{{ route('account.files.index') }}">Your files</a>
                </li>
                <li class="list-group-item{{ Request::is('account/files/*/create') ? ' active' : '' }}">
                    <a href="{{ route('account.files.create.start') }}">Sell a file</a>
                </li>
            </ul>

            <ul class="list-group">
                <li class="list-group-item {{ isActiveRoute('bought.files') }}">
                    <a href="{{ route('bought.files') }}">Bought Files</a>
                </li>
                <li class="list-group-item {{ isActiveRoute('files.sold') }}">
                    <a href="{{ route('files.sold') }}">Files Sold</a>
                </li>
                <li class="list-group-item {{ isActiveRoute('get.unread.notifications') }}">
                    <a href="{{ route('get.unread.notifications') }}">
                        Notifications
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge badge-light pull-right">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                </li>
            </ul>

            <ul class="list-group">
                <li class="list-group-item {{ isActiveRoute('change.password') }}">
                    <a href="{{ route('change.password') }}">
                        Change password
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>