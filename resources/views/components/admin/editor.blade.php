@props([
    'name', 
    'value' => '', 
    'id' => 'editor_' . uniqid(),
    'placeholder' => 'Write content here...'
])

<textarea name="{{ $name }}" id="{{ $id }}" class="admin-editor-instance @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}">{!! old($name, $value) !!}</textarea>

@once
    @push('scripts')
    {{-- Self Hosted TinyMCE --}}
    <script src="{{ asset('admin/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            tinymce.init({
                selector: '.admin-editor-instance',
                height: 500,
                menubar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
                         'alignleft aligncenter alignright alignjustify | ' +
                         'bullist numlist outdent indent | link image media | ' +
                         'table hr blockquote | removeformat code fullscreen | help',
                content_style: 'body { font-family: Inter, sans-serif; font-size: 15px; line-height: 1.7; color: #334155; }',
                branding: false,
                promotion: false,
                license_key: 'gpl', // Acknowledges self-hosted free version to remove console warning
                
                // Integrate with our custom Media Library Modal
                file_picker_callback: function (callback, value, meta) {
                    if (meta.filetype === 'image') {
                        if (typeof openMediaModalForEditor === 'function') {
                            openMediaModalForEditor(callback);
                        } else {
                            alert('Media library is not loaded properly. Please make sure the media-modal is included in this page.');
                        }
                    }
                },
                
                setup: function(editor) {
                    // Sync TinyMCE content back to textarea before form submit
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });
        });
    </script>
    @endpush
@endonce
