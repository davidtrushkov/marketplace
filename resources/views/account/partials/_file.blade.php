<div class="col-sm-12 no-padding YOUR-FILE-BOX">
    <h4><a href="{{ route('files.show', $file) }}">{{ $file->title }}</a></h4>
    <h5>{{ str_limit($file->overview_short, 150) }}</h5>
    <hr>
    <span>
        {{ $file->isFree() ? 'Free' : '$' . $file->price }}
    </span>
    @if(!$file->approved)
        <span>
            Pending approval
        </span>
    @endif

    <span>
       {{ $file->live ? 'Live' : 'Not Live' }}
    </span>
    <span>
        <a href="{{ route('account.files.edit', $file) }}">Make changes</a>
    </span>
    <span class="pull-right">
        <a href="{{ route('account.files.create.notification', $file->identifier) }}">Send Notification Users</a>
    </span>
</div>
