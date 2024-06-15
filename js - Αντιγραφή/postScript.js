tinymce.init({
    selector: 'textarea',
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});