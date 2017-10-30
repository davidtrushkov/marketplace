<script>
    let drop = new Dropzone('#file', {
        createImageThumbnails: false,
        addRemoveLinks: true,
        url: '{{ route('upload.store', $file) }}',
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        }
    });

    // Keep the uploaded files on the page on page refresh
    // (if for example errors occur, we want the files still to be there)
    @foreach($file->uploads as $upload)
        drop.emit('addedfile', {
            id: '{{ $upload->id }}',
            name: '{{ $upload->filename }}',
            size: '{{ $upload->size }}',
        });
    @endforeach

    // On successful upload, associate file ID with response ID from backend
    drop.on('success', function(file, response) {
        file.id = response.id;
    });

    // When a user deletes a file(s), call axios to delete the file(s)
    // and if there is an error that is caught when deleting the file(s), then
    // just call the "emit" method from dropzone.js to put the file(s) back
    drop.on('removedfile', function(file) {
        axios.delete('/{{ $file->identifier }}/upload/' + file.id).catch(function (error) {
            drop.emit('addedfile', {
                id: file.id,
                name: file.name,
                size: file.size
            });
        });
    });
</script>