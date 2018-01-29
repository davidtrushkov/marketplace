<div id="ACCOUNT-SIDE-NAV" class="hidden-xs">
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('admin.files.new.index') }}">Approve new files</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('admin.files.updated.index') }}">Approve updated files</a>
        </li>
    </ul>
</div>

<div id="ACCOUNT-SIDE-NAV" class="hidden-xs">
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('admin.users.all') }}">Users</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('admin.categories') }}">File Categories</a>
        </li>
    </ul>
</div>


<div class="visible-xs">
    <a class="btn btn-primary account-menu-button" role="button" data-toggle="collapse" href="#adminNav" aria-expanded="false" aria-controls="adminNav">
        Admin Menu
    </a>

    <div class="collapse" id="adminNav">
        <div id="ACCOUNT-SIDE-NAV">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route('admin.files.new.index') }}">Approve new files</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('admin.files.updated.index') }}">Approve updated files</a>
                </li>
            </ul>
        </div>

        <div id="ACCOUNT-SIDE-NAV">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route('admin.users.all') }}">Users</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('admin.categories') }}">File Categories</a>
                </li>
            </ul>
        </div>
    </div>
</div>