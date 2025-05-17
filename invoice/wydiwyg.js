
        tinymce.init({
            selector: '#editor',
            plugins: 'link image media code lists textcolor colorpicker table insertdatetime paste',
            toolbar: 'undo redo | formatselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist | table image media link | code | customUploadButton | customVideoUploadButton',
            menubar: 'file edit view insert format tools table help',
            block_formats: 'Paragraph=p; Header 1=h1; Header 2=h2; Header 3=h3; Blockquote=blockquote',
            height: 600,

            paste_data_images: true,
            images_upload_url: 'upload.php',
            automatic_uploads: true,

            // Custom button for uploading images
            setup: function (editor) {
                // Image Upload Button
                editor.ui.registry.addButton('customUploadButton', {
                    text: 'Upload Image',
                    icon: 'image',
                    onAction: function () {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');
                        input.click();

                        input.onchange = function () {
                            var file = input.files[0];
                            if (file) {
                                var formData = new FormData();
                                formData.append('file', file);
                                fetch('upload.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.location) {
                                        editor.insertContent('<img src="' + data.location + '" />');
                                    } else {
                                        alert('Image upload failed: ' + data.error);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                            }
                        };
                    }
                });

                // Video Upload Button
                editor.ui.registry.addButton('customVideoUploadButton', {
                    text: 'Upload Video',
                    icon: 'media',
                    onAction: function () {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'video/*');
                        input.click();

                        input.onchange = function () {
                            var file = input.files[0];
                            if (file) {
                                var formData = new FormData();
                                formData.append('file', file);
                                fetch('upload_video.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.location) {
                                        editor.insertContent('<video controls><source src="' + data.location + '" type="video/mp4">Your browser does not support the video tag.</video>');
                                    } else {
                                        alert('Video upload failed: ' + data.error);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                            }
                        };
                    }
                });
            }
        });
    
    tinymce.init({
        selector: '#editor',
        plugins: 'link image media code lists textcolor colorpicker table insertdatetime paste',
        toolbar: 'undo redo | formatselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist | table image media link | code | customUploadButton | customVideoUploadButton',
        menubar: 'file edit view insert format tools table help',
        block_formats: 'Paragraph=p; Header 1=h1; Header 2=h2; Header 3=h3; Blockquote=blockquote',
        height: 600,

        paste_data_images: true,
        images_upload_url: 'upload.php',
        automatic_uploads: true,

        // Custom button for uploading images
        setup: function (editor) {
            // Image Upload Button
            editor.ui.registry.addButton('customUploadButton', {
                text: 'Upload Image',
                icon: 'image',
                onAction: function () {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.click();

                    input.onchange = function () {
                        var file = input.files[0];
                        if (file) {
                            var formData = new FormData();
                            formData.append('file', file);
                            fetch('upload.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.location) {
                                    editor.insertContent('<img src="' + data.location + '" />');
                                } else {
                                    alert('Image upload failed: ' + data.error);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                        }
                    };
                }
            });

            // Video Upload Button
            editor.ui.registry.addButton('customVideoUploadButton', {
                text: 'Upload Video',
                icon: 'media',
                onAction: function () {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'video/*');
                    input.click();

                    input.onchange = function () {
                        var file = input.files[0];
                        if (file) {
                            var formData = new FormData();
                            formData.append('file', file);
                            fetch('upload_video.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.location) {
                                    editor.insertContent('<video controls><source src="' + data.location + '" type="video/mp4">Your browser does not support the video tag.</video>');
                                } else {
                                    alert('Video upload failed: ' + data.error);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                        }
                    };
                }
            });
        }
    });