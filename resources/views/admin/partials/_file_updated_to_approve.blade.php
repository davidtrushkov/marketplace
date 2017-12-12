<div class="col-sm-12 no-padding YOUR-FILE-BOX">
    <h4><a href="#">{{ $file->title }}</a></h4>
    <h5>{{ str_limit($file->overview_short, 150) }}</h5>
    <hr>
    <span>
         <a href="">Preview changes</a>
    </span>
    <span>
         <a href="#" onclick="event.preventDefault(); document.getElementById('approve-{{ $file->id }}').submit();">Approve</a>
    </span>

    <form action="{{ route('admin.files.updated.update', $file) }}" method="post" id="approve-{{ $file->id }}" class="hidden">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
    </form>

    <span>
        <a href="#" onclick="event.preventDefault(); document.getElementById('reject-{{ $file->id }}').submit();">Reject</a>
    </span>

    <form action="{{ route('admin.files.updated.destroy', $file) }}" method="post" id="reject-{{ $file->id }}" class="hidden">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

</div>
