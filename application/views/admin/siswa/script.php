<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#siswa_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('siswa/ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3, 4, 5], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $('#modal_tambah_siswa').on('shown.bs.modal', function() {
        $('#nis_help').text('');
        $('#nama_help').text('');
        $('#kelas_help').text('');
        $('#alamat_help').text('');
        $('#tahun_masuk_help').text('');
        $('#username_help').text('');
        $('#password_help').text('');
        $('#nis').val('');
        $('#nama').val('');
        $('#kelas').val('');
        $('#jenis_kelamin').prop('selectedIndex', 0);
        $('#alamat').val('');
        $('#tahun_masuk').val('');
        $('#username').val('');
        $('#password').val('');
        //$('#email_orangtua').val('');
        $('#nama_orangtua').val('');
        $('#nis').trigger('focus');
    })

    $(document).on("click", "#save", function() {
        $('#nis_help').text('');
        $('#nama_help').text('');
        $('#kelas_help').text('');
        $('#alamat_help').text('');
        $('#tahun_masuk_help').text('');
        $('#username_help').text('');
        $('#password_help').text('');

        var nis = $('#nis').val();
        var nama = $('#nama').val();
        var kelas = $('#kelas').val();
        var jenis_kelamin = $('#jenis_kelamin').val();
        var alamat = $('#alamat').val();
        var tahun_masuk = $('#tahun_masuk').val();
        var username = $('#username').val();
        var password = $('#password').val();
        //var email_orangtua = $('#email_orangtua').val();
        var id_orang_tua = $('#id_orang_tua').val();
        var id_guru = $('#id_guru').val();

        if (nis == '') {
            $('#nis').trigger('focus')
            $('#nis_help').text('NIS masih Kosong !!');
        } else if (nama == '') {
            $('#nama').trigger('focus')
            $('#nama_help').text('Nama masih Kosong !!');
        } else if (kelas == '') {
            $('#kelas').trigger('focus')
            $('#kelas_help').text('Kelas masih Kosong !!');
        } else if (id_orang_tua == '') {
            $('#id_orang_tua').trigger('focus')
            $('#id_orang_tua_help').text('Orang Tua masih Kosong !!');
        } else if (id_guru == '') {
            $('#id_guru').trigger('focus')
            $('#id_guru_help').text('Guru masih Kosong !!');
        } else if (alamat == '') {
            $('#alamat').trigger('focus')
            $('#alamat_help').text('Alamat masih Kosong !!');
        } else if (tahun_masuk == '') {
            $('#tahun_masuk').trigger('focus')
            $('#tahun_masuk_help').text('Tahun Masuk masih Kosong !!');
        } else if (username == '') {
            $('#username').trigger('focus')
            $('#username_help').text('Username masih Kosong !!');
        } else if (password == '') {
            $('#password').trigger('focus')
            $('#password_help').text('Password masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('siswa/add') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    nis_siswa: nis,
                    nama: nama,
                    kelas: kelas,
                    jenis_kelamin: jenis_kelamin,
                    alamat: alamat,
                    tahun_masuk: tahun_masuk,
                    username: username,
                    password: password,
                    //email_orangtua: email_orangtua
                    id_orang_tua: id_orang_tua,
                    id_guru: id_guru
                },
                beforeSend: function() {
                    /* Show image container */
                    $("#save").prop("disabled", true);
                    $('#save').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    );
                },
                success: function(result) {
                    // console.log(result);
                    if (result.status == true) {
                        $('#modal_tambah_siswa').modal('hide');
                        swal({
                                text: result.info,
                                icon: 'success',
                                timer: 800,
                                buttons: false,
                            })
                            .then(() => {
                                table.ajax.reload();
                            })
                    } else if (result.status == false) {
                        $('#nis_help').text(result.info);
                    } else if (result.status == 'username') {
                        $('#username_help').text(result.info);
                    } else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                        $('#modal_tambah_siswa').modal('hide');
                    }
                },
                complete: function(data) {
                    // Hide image container
                    $("#save").prop("disabled", false);
                    $('#save').html('Simpan');
                }
            });
        }

    });

    $(document).on("click", "#button_edit_siswa", function() {
        var id_siswa = $(this).data('id');
        var nis_siswa = $(this).data('nis_siswa');
        var nama = $(this).data('nama');
        var kelas = $(this).data('kelas');
        var jenis_kelamin = $(this).data('jenis_kelamin');
        var alamat = $(this).data('alamat');
        var tahun_masuk = $(this).data('tahun_masuk');
        var username = $(this).data('username');
        //var email_orangtua = $(this).data('email_orangtua');
        var id_orang_tua = $(this).data('id_orang_tua');
        var id_guru = $(this).data('id_guru');
        $("#edit_id_siswa").val(id_siswa);
        $("#edit_nis_siswa").val(nis_siswa);
        $("#edit_nama").val(nama);
        $("#edit_kelas").val(kelas);
        $("#edit_jenis_kelamin").val(jenis_kelamin);
        $("#edit_alamat").val(alamat);
        $("#edit_tahun_masuk").val(tahun_masuk);
        $("#edit_username").val(username);
        //$("#edit_email_orangtua").val(email_orangtua);
        $("#edit_orang_tua").val(id_orang_tua);
        $("#edit_guru").val(id_guru);
        $("#edit_password").val('');
    });

    $(document).on("click", "#save_edit", function() {
        $('#edit_nis_help').text('');
        $('#edit_nama_help').text('');
        $('#edit_kelas_help').text('');
        $('#edit_orang_tua_help').text('');
        $('#edit_alamat_help').text('');
        $('#edit_tahun_masuk_help').text('');
        $('#edit_username_help').text('');

        var id_siswa = $('#edit_id_siswa').val();
        var nis = $('#edit_nis_siswa').val();
        var nama = $('#edit_nama').val();
        var kelas = $('#edit_kelas').val();
        var jenis_kelamin = $('#edit_jenis_kelamin').val();
        var alamat = $('#edit_alamat').val();
        var tahun_masuk = $('#edit_tahun_masuk').val();
        var username = $('#edit_username').val();
        var password = $('#edit_password').val();
        //var email_orangtua = $('#edit_email_orangtua').val();
        var id_orang_tua = $('#edit_orang_tua').val();
        var id_guru = $('#edit_guru').val();

        if (nis == '') {
            $('#edit_nis_siswa').trigger('focus')
            $('#edit_nis_help').text('NIS masih Kosong !!');
        } else if (nama == '') {
            $('#edit_nama').trigger('focus')
            $('#edit_nama_help').text('Nama masih Kosong !!');
        } else if (kelas == '') {
            $('#edit_kelas').trigger('focus')
            $('#edit_kelas_help').text('Kelas masih Kosong !!');
        }  else if (id_orang_tua == '') {
            $('#edit_orang_tua').trigger('focus')
            $('#edit_orang_tua_help').text('Orangtua masih Kosong !!');
        }else if (alamat == '') {
            $('#edit_alamat').trigger('focus')
            $('#edit_alamat_help').text('Alamat masih Kosong !!');
        } else if (tahun_masuk == '') {
            $('#edit_tahun_masuk').trigger('focus')
            $('#edit_tahun_masuk_help').text('Tahun Masuk masih Kosong !!');
        } else if (username == '') {
            $('#edit_username').trigger('focus')
            $('#edit_username_help').text('Username masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('siswa/update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_siswa: id_siswa,
                    nis_siswa: nis,
                    nama: nama,
                    kelas: kelas,
                    jenis_kelamin: jenis_kelamin,
                    alamat: alamat,
                    tahun_masuk: tahun_masuk,
                    username: username,
                    password: password,
                   // email_orangtua: email_orangtua
                    id_orang_tua: id_orang_tua,
                    id_guru: id_guru
                },
                beforeSend: function() {
                    /* Show image container */
                    $("#save_edit").prop("disabled", true);
                    $('#save_edit').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    );
                },
                success: function(result) {
                    if (result.status == true) {
                        $('#modal_edit_siswa').modal('hide');
                        swal({
                                text: result.info,
                                icon: 'success',
                                timer: 800,
                                buttons: false,
                            })
                            .then(() => {
                                table.ajax.reload();
                            })
                    } else if (result.status == false) {
                        $('#edit_nama_help').text(result.info);
                    } else if (result.status == 'username') {
                        $('#edit_username_help').text(result.info);
                    } else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                        $('#modal_edit_siswa').modal('hide');
                    }
                },
                complete: function(data) {
                    // Hide image container
                    $("#save_edit").prop("disabled", false);
                    $('#save_edit').html('Save');
                }
            });
        }

    });

    $(document).on("click", "#button_hapus_siswa", function() {
        var id_siswa = $(this).data('id');
        var nama = $(this).data('nama');
        $("#hapus_id_siswa").val(id_siswa);
        $("#hapus_nama_siswa").text(nama);
    });

    $(document).on("click", "#delete", function() {
        var id_siswa = $('#hapus_id_siswa').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('siswa/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_siswa: id_siswa
            },
            beforeSend: function() {
                /* Show image container */
                $("#delete").prop("disabled", true);
                $('#delete').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
            },
            success: function(result) {
                if (result.status === true) {
                    $('#modal_hapus_siswa').modal('hide');
                    swal({
                            text: result.info,
                            icon: 'success',
                            timer: 800,
                            buttons: false,
                        })
                        .then(() => {
                            table.ajax.reload();
                        })
                } else if (result.status === false) {
                    swal({
                        text: result.info,
                        icon: 'warning',
                        timer: 1200,
                        buttons: false,
                    })
                }
            },
            complete: function(data) {
                // Hide image container
                $("#delete").prop("disabled", false);
                $('#delete').html('Hapus');
            }
        });

    });

    $(document).on("click", "#button_view_siswa", function() {
        var id_siswa = $(this).data('id');
        var nis_siswa = $(this).data('nis_siswa');
        var nama = $(this).data('nama');
        var kelas = $(this).data('kelas');
        var jenis_kelamin = $(this).data('jenis_kelamin');
        var alamat = $(this).data('alamat');
        var tahun_masuk = $(this).data('tahun_masuk');
        var username = $(this).data('username');
        //var email_orangtua = $(this).data('email_orangtua');
        var nama_orangtua = $(this).data('nama_orangtua');
        $("#view_id_siswa").val(id_siswa);
        $("#view_nis_siswa").val(nis_siswa);
        $("#view_nama").val(nama);
        $("#view_kelas").val(kelas);
        $("#view_jenis_kelamin").val(jenis_kelamin);
        $("#view_alamat").val(alamat);
        $("#view_tahun_masuk").val(tahun_masuk);
        $("#view_username").val(username);
        //$("#view_email_orangtua").val(email_orangtua);
        $("#view_nama_orangtua").val(nama_orangtua);
        $("#view_password").val('');
    });
</script>