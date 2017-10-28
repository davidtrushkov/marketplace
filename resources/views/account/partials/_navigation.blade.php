<div id="ACCOUNT-SIDE-NAV">
    <ul class="list-group">
        <li class="list-group-item {{ isActiveRoute('account.files.index') }}">
            <a href="{{ route('account.files.index') }}">Your files</a>
        </li>
        <li class="list-group-item{{ Request::is('account/files/*') ? ' active' : '' }}">
            <a href="{{ route('account.files.create.start') }}">Sell a file</a>
        </li>
    </ul>

    <ul class="list-group">
        <li class="list-group-item">
            General
        </li>
        <li class="list-group-item">
            Change password
        </li>
    </ul>
</div>