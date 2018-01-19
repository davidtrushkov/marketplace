@if(
    ($uploads = $file->uploads()->unapproved()->get())->count() ||
    $approvals->title !== $file->title ||
    $approvals->overview_short !== $file->overview_short ||
    $approvals->overview !== $file->overview ||
    $approvals->youtube_url !== $file->youtube_url ||
    $approvals->vimeo_url !== $file->vimeo_url
    )
    <div class="alert-info">
        <h5>We are currently reviewing the following changes:</h5>
    </div>
    <div class="alert-active">
        @if(($uploads = $file->uploads()->unapproved()->get())->count())
            <div class="list-group">
                <a href="#" class="list-group-item disabled">Uploads</a>
                @foreach($uploads as $upload)
                    <a href="#" class="list-group-item">
                        <span class="badge">{{ $upload->preview === 1 ? 'Gallery Image' : '' }}</span>
                        {{ $upload->filename }}
                    </a>
                @endforeach
            </div>
        @endif

        @if($approvals->title !== $file->title)
            <div class="list-group">
                <a href="#" class="list-group-item disabled">Title</a>
                <a href="#" class="list-group-item">{{ $approvals->title }}</a>
            </div>
        @endif

        @if($approvals->overview_short !== $file->overview_short)
            <div class="list-group">
                <a href="#" class="list-group-item disabled">Short Overview</a>
                <a href="#" class="list-group-item">{{ $approvals->overview_short }}</a>
            </div>
        @endif

        @if($approvals->overview !== $file->overview)
            <div class="list-group">
                <a href="#" class="list-group-item disabled">Overview</a>
                <a href="#" class="list-group-item">{!! $approvals->overview !!}</a>
            </div>
        @endif

        @if($approvals->youtube_url !== $file->youtube_url)
            <div class="list-group">
                <a href="#" class="list-group-item disabled">Youtube URL</a>
                <a href="#" class="list-group-item">{{ $approvals->youtube_url }}</a>
            </div>
        @endif

        @if($approvals->vimeo_url !== $file->vimeo_url)
            <div class="list-group">
                <a href="#" class="list-group-item disabled">Vimeo URL</a>
                <a href="#" class="list-group-item">{{ $approvals->vimeo_url }}</a>
            </div>
        @endif
    </div>
@endif