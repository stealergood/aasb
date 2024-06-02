<script type="text/javascript">
    $(document).on("click", "#simpan_profil", function() {
        $('#nip_guru_help').text('');
        $('#nama_help').text('');
        $('#username_help').text('');
        $('#email_help').text('');
        $('#alamat_help').text('');
        $('#jabatan_help').text('');
        $('#no_telepon_help').text('');

        var nip_guru = $('#nip_guru').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var jabatan = $('#jabatan').val();
        var alamat = $('#alamat').val();
        var no_telepon = $('#no_telepon').val();
        var username = $('#username').val();

        if (nip_guru == '') {
            $('#nip_guru').trigger('focus')
            $('#nip_guru_help').text('NIP Guru masih Kosong !!');
        } else if (name == '') {
            $('#name').trigger('focus')
            $('#nama_help').text('Nama masih Kosong !!');
        } else if (email == '') {
            $('#email').trigger('focus')
            $('#email_help').text('Email masih Kosong !!');
        } else if (jabatan == '') {
            $('#jabatan').trigger('focus')
            $('#jabatan_help').text('jabatan masih Kosong !!');
        } else if (username == '') {
            $('#username').trigger('focus')
            $('#username_help').text('Username masih Kosong !!');
        } else if (alamat == '') {
            $('#alamat').trigger('focus')
            $('#alamat_help').text('Alamat masih Kosong !!');
        } else if (no_telepon == '') {
            $('#no_telepon').trigger('focus')
            $('#no_telepon_help').text('No Telepon masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('users_update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_guru: $('#id').val(),
                    nip_guru: nip_guru,
                    name: name,
                    email: email,
                    jenis_kelamin: $('#jenis_kelamin').val(),
                    jabatan: jabatan,
                    alamat: alamat,
                    no_telepon: no_telepon,
                    username: username
                },
                beforeSend: function() {
                    /* Show image container */
                    $("#simpan_profil").prop("disabled", true);
                    $('#simpan_profil').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    );
                },
                success: function(result) {
                    console.log(result);
                    if (result.status == true) {
                        swal({
                                text: result.info,
                                icon: 'success',
                                timer: 800,
                                buttons: false,
                            })
                            .then(() => {
                                location.reload();
                                // window.location.href = "<?= site_url('users-profile') ?>";
                            })
                    } else if (result.status == 'username') {
                        $('#username_help').text(result.info);
                    } else if (result.status == 'nip') {
                        $('#nip_guru_help').text(result.info);
                    } else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                    }
                },
                complete: function(data) {
                    // Hide image container
                    $("#simpan_profil").prop("disabled", false);
                    $('#simpan_profil').html('Simpan');
                }
            });
        }

    });

    $(document).on("click", "#simpan_password", function() {
        $('#password_lama_help').text('');
        $('#password_baru_help').text('');
        $('#password_ulang_help').text('');

        var id_guru = $('#id').val();
        var password_lama = $('#password_lama').val();
        var password_baru = $('#password_baru').val();
        var password_ulang = $('#password_ulang').val();

        if (password_lama == '') {
            $('#password_lama').trigger('focus')
            $('#password_lama_help').text('Password Lama masih Kosong !!');
        } else if (password_baru == '') {
            $('#password_baru').trigger('focus')
            $('#password_baru_help').text('Password Baru masih Kosong !!');
        } else if (password_ulang == '') {
            $('#password_ulang').trigger('focus')
            $('#password_ulang_help').text('Password Ulang masih Kosong !!');
        } else if (password_ulang == password_baru) {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('users_update_password') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_guru: $('#id').val(),
                    password_lama: password_lama,
                    password_baru: password_baru
                },
                beforeSend: function() {
                    /* Show image container */
                    $("#simpan_password").prop("disabled", true);
                    $('#simpan_password').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    );
                },
                success: function(result) {
                    console.log(result);
                    if (result.status == true) {
                        swal({
                                text: result.info,
                                icon: 'success',
                                timer: 800,
                                buttons: false,
                            })
                            .then(() => {
                                location.reload();
                                // window.location.href = "<?= site_url('admin/users-profile') ?>";
                            })
                    } else if (result.status == 'password_lama') {
                        $('#password_lama_help').text(result.info);
                    } else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                    }
                },
                complete: function(data) {
                    // Hide image container
                    $("#simpan_password").prop("disabled", false);
                    $('#simpan_password').html('Change Password');
                }
            });
        } else {
            $('#password_ulang').trigger('focus')
            $('#password_ulang_help').text(' Password Baru danPassword Ulang Tidak Sama !!');
        }

    });
</script>