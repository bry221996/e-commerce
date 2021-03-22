<div id="dZUpload" class="dropzone dropzone-custom {{$class}}">
    <div class="dz-default dz-message">
        <span>Drop files here to upload</span>
    </div>
</div>

<div class="file-links"></div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.8.1/min/dropzone.min.css" integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw==" crossorigin="anonymous" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.8.1/min/dropzone.min.js" integrity="sha512-OTNPkaN+JCQg2dj6Ht+yuHRHDwsq1WYsU6H0jDYHou/2ZayS2KXCfL28s/p11L0+GSppfPOqwbda47Q97pDP9Q==" crossorigin="anonymous"></script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {

        var dropzone = new Dropzone("div#dZUpload", {
            url: "http://localhost/api/files",
            addRemoveLinks: true,
            acceptedFiles: "{{$accepts}}",
            success: function(file, response) {
                console.log($('.file-links'));
                $('.file-links').append(`<input type="hidden" name="{{$name}}[]" value="${response.data.link }">`)
            },
        });
    });
</script>
@endpush