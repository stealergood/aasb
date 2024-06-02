<script>
    $(document).on("click", "#save_setting", function() {
        $.ajax({
            type: 'POST',
            url: '<?= site_url('admin/setting/save_setting') ?>',
            data: {
                'app_name': $('#app_name').val(),
                'slogan': $('#slogan').val(),
                'description': $('#description').val(),
                'meta_description': $('#meta_description').val(),
                'meta_keyword': $('#meta_keyword').val(),
                'address': $('#Address').val(),
                'phone': $('#Phone').val(),
                'email': $('#Email').val(),
                'website': $('#website').val(),
            },
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    swal({
                        text: result.info,
                        icon: 'success',
                        timer: 800,
                        buttons: false,
                    }).then(() => {
                        location.reload();
                    })
                } else {
                    swal({
                        text: 'Update Setting Web Gagal',
                        icon: 'error',
                        timer: 800,
                        buttons: false,
                    })
                }
            }
        })
    });

    $(document).ready(function() {
        const logo_image = document.getElementsByName('logo_image')[0];
        logo_image.addEventListener('change', () => {
            upload_image(logo_image.files[0]);
        });

        const upload_image = (file) => {
            // check file type
            if (!['image/jpeg'].includes(file.type)) {
                swal({
                    text: 'Only .jpg image are allowed',
                    icon: 'error',
                    timer: 800,
                    buttons: false,
                })
                document.getElementsByName('logo_image')[0].value = '';
                return;
            }

            // check file size (< 2MB)
            if (file.size > 2 * 1024 * 1024) {
                swal({
                    text: 'Logo Maksimal 2MB...',
                    icon: 'error',
                    timer: 800,
                    buttons: false,
                })
                document.getElementsByName('logo_image')[0].value = '';
                return;
            }

            const form_data = new FormData();
            form_data.append('logo_image', file);
            fetch("<?= base_url() ?>admin/setting/save_logo_image", {
                method: "POST",
                body: form_data
            }).then(function(response) {
                return response.json();
            }).then(function(responseData) {
                document.getElementById('uploaded_image').innerHTML =
                    '<img src="' + responseData.image_source + '" class="col-md-12 col-lg-6 col-xl-4 mb-2"/>';
                document.getElementsByName('logo_image')[0].value = '';
                swal({
                    text: responseData.info,
                    icon: 'success',
                    timer: 800,
                    buttons: false,
                })
            });


        }
    });

    $(document).ready(function() {
        const favicon_image = document.getElementsByName('favicon_image')[0];
        favicon_image.addEventListener('change', () => {
            upload_image(favicon_image.files[0]);
        });

        const upload_image = (file) => {
            // check file type
            if (!['image/jpeg', 'image/png'].includes(file.type)) {
                swal({
                    text: 'Only .jpg and .png image are allowed',
                    icon: 'error',
                    timer: 800,
                    buttons: false,
                })
                document.getElementsByName('favicon_image')[0].value = '';
                return;
            }

            // check file size (< 2MB)
            if (file.size > 2 * 1024 * 1024) {
                swal({
                    text: 'Logo Maksimal 2MB...',
                    icon: 'error',
                    timer: 800,
                    buttons: false,
                })
                document.getElementsByName('favicon_image')[0].value = '';
                return;
            }

            const form_data = new FormData();
            form_data.append('favicon_image', file);
            fetch("<?= base_url() ?>admin/setting/save_logo_image", {
                method: "POST",
                body: form_data
            }).then(function(response) {
                return response.json();
            }).then(function(responseData) {
                document.getElementById('uploaded_favicon').innerHTML =
                    '<img src="' + responseData.image_source + '" class="col-md-12 col-lg-2 col-xl-2 mb-2"/>';
                document.getElementsByName('favicon_image')[0].value = '';
                swal({
                    text: responseData.info,
                    icon: 'success',
                    timer: 800,
                    buttons: false,
                })
            });


        }
    });
</script>