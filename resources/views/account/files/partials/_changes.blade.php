<div class="alert-header">
    <h5>We are currently reviewing the following changes:</h5>
</div>
<div class="alert-info">
    @if(($uploads = $file->uploads()->unapproved()->get())->count())
        <div>Uploads</div>
       @foreach($uploads as $upload)
           <p>{{ $upload->filename }}</p>
       @endforeach
    @endif

    @if($approvals->title !== $file->title)
        <div>Title</div>
        <p>{{ $approvals->title }}</p>
    @endif

    @if($approvals->overview_short !== $file->overview_short)
        <div>Short Overview</div>
        <p>{{ $approvals->overview_short }}</p>
    @endif

    @if($approvals->overview !== $file->overview)
        <div>Overview</div>
        <p>{{ $approvals->overview }}</p>
    @endif
</div>