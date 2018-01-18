
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/0.11.1/trix.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.6/js/lightgallery-all.min.js"></script>

<script type="text/javascript">
    $('#lightgallery').lightGallery({
        download: false,
        share: false,
        selector: '.item'
    });

    $('#video-gallery').lightGallery({
        download: false,
        share: false,
        youtubePlayerParams: {
            modestbranding: 1,
            showinfo: 0,
            rel: 0,
            controls: 1
        },
        vimeoPlayerParams: {
            byline : 0,
            portrait : 0,
        },
    });
</script>