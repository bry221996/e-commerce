<div id="image-preview" class="image-preview {{ $class ?? ''}}" style="border-color: #6777ef;">
    <label for="image-upload" id="image-label">Choose File</label>
    <input type="file" name="{{$name}}" id="image-upload" />
</div>

@push('scripts')
<script src="https://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js"></script>
<script>
    $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        label_field: "#image-label", // Default: .image-label
        label_default: "Choose File", // Default: Choose File
        label_selected: "Change File", // Default: Change File
        no_label: false,
        success_callback: null
    });
</script>
@endpush