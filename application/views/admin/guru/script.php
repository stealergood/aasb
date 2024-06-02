<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#guru_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('guru/ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3, 4, 5, 6], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $('#modal_tambah_guru').on('shown.bs.modal', function() {
        $('#nip_help').text('');
        $('#nama_help').text('');
        $('#email_help').text('');
        $('#alamat_help').text('');
        $('#jabatan_help').text('');
        $('#no_telepon_help').text('');
        $('#username_help').text('');
        $('#password_help').text('');

        $('#nip').val('');
        $('#nama').val('');
        $('#email').val('');
        $('#jenis_kelamin').prop('selectedIndex', 0);
        $('#alamat').val('');
        $('#jabatan').val('');
        $('#no_telepon').val('');
        $('#username').val('');
        $('#password').val('');
        $('#nip').trigger('focus');
    })

    $(document).on("click", "#save", function() {
        $('#nip_help').text('');
        $('#nama_help').text('');
        $('#email_help').text('');
        $('#alamat_help').text('');
        $('#jabatan_help').text('');
        $('#no_telepon_help').text('');
        $('#username_help').text('');
        $('#password_help').text('');

        var nip = $('#nip').val();
        var nama = $('#nama').val();
        var email = $('#email').val();
        var jenis_kelamin = $('#jenis_kelamin').val();
        var alamat = $('#alamat').val();
        var jabatan = $('#jabatan').val();
        var no_telepon = $('#no_telepon').val();
        var username = $('#username').val();
        var password = $('#password').val();

        if (nip == '') {
            $('#nip').trigger('focus')
            $('#nip_help').text('NIP masih Kosong !!');
        } else if (nama == '') {
            $('#nama').trigger('focus')
            $('#nama_help').text('Nama masih Kosong !!');
        } else if (email == '') {
            $('#email').trigger('focus')
            $('#email_help').text('Email masih Kosong !!');
        } else if (jabatan == '') {
            $('#jabatan').trigger('focus')
            $('#jabatan_help').text('Jabatan masih Kosong !!');
        } else if (alamat == '') {
            $('#alamat').trigger('focus')
            $('#alamat_help').text('Alamat masih Kosong !!');
        } else if (no_telepon == '') {
            $('#no_telepon').trigger('focus')
            $('#no_telepon_help').text('Telephon masih Kosong !!');
        } else if (username == '') {
            $('#username').trigger('focus')
            $('#username_help').text('Username masih Kosong !!');
        } else if (password == '') {
            $('#password').trigger('focus')
            $('#password_help').text('Password masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('guru/add') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    nip_guru: nip,
                    nama: nama,
                    email: email,
                    jenis_kelamin: jenis_kelamin,
                    jabatan: jabatan,
                    alamat: alamat,
                    no_telepon: no_telepon,
                    username: username,
                    password: password
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
                        $('#modal_tambah_guru').modal('hide');
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
                        $('#nip_help').text(result.info);
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
                        $('#modal_tambah_guru').modal('hide');
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

    $(document).on("click", "#button_edit_guru", function() {
        var id_guru = $(this).data('id');
        var nip_guru = $(this).data('nip_guru');
        var nama = $(this).data('nama');
        var email = $(this).data('email');
        var jenis_kelamin = $(this).data('jenis_kelamin');
        var jabatan = $(this).data('jabatan');
        var alamat = $(this).data('alamat');
        var no_telepon = $(this).data('no_telepon');
        var username = $(this).data('username');

        $("#edit_id_guru").val(id_guru);
        $("#edit_nip_guru").val(nip_guru);
        $("#edit_nama").val(nama);
        $("#edit_email").val(email);
        $("#edit_jenis_kelamin").val(jenis_kelamin);
        $("#edit_jabatan").val(jabatan);
        $("#edit_alamat").val(alamat);
        $("#edit_no_telepon").val(no_telepon);
        $("#edit_username").val(username);
        $("#edit_password").val('');
    });

    $(document).on("click", "#save_edit", function() {
        $('#edit_nip_help').text('');
        $('#edit_nama_help').text('');
        $('#edit_email_help').text('');
        $('#edit_alamat_help').text('');
        $('#edit_jabatan_help').text('');
        $('#edit_no_telepon_help').text('');
        $('#edit_username_help').text('');

        var id_guru = $('#edit_id_guru').val();
        var nip_guru = $('#edit_nip_guru').val();
        var nama = $('#edit_nama').val();
        var email = $('#edit_email').val();
        var jenis_kelamin = $('#edit_jenis_kelamin').val();
        var jabatan = $('#edit_jabatan').val();
        var alamat = $('#edit_alamat').val();
        var no_telepon = $('#edit_no_telepon').val();
        var username = $('#edit_username').val();
        var password = $('#edit_password').val();

        if (nip_guru == '') {
            $('#edit_nip_guru').trigger('focus')
            $('#edit_nip_help').text('NIP masih Kosong !!');
        } else if (nama == '') {
            $('#edit_nama').trigger('focus')
            $('#edit_nama_help').text('Nama masih Kosong !!');
        } else if (email == '') {
            $('#edit_email').trigger('focus')
            $('#edit_email_help').text('email masih Kosong !!');
        } else if (alamat == '') {
            $('#edit_alamat').trigger('focus')
            $('#edit_alamat_help').text('Alamat masih Kosong !!');
        } else if (jabatan == '') {
            $('#edit_jabatan').trigger('focus')
            $('#edit_jabatan_help').text('jabatan masih Kosong !!');
        } else if (no_telepon == '') {
            $('#edit_no_telepon').trigger('focus')
            $('#edit_no_telepon_help').text('No telepon masih Kosong !!');
        } else if (username == '') {
            $('#edit_username').trigger('focus')
            $('#edit_username_help').text('Username masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('guru/update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_guru: id_guru,
                    nip_guru: nip_guru,
                    nama: nama,
                    email: email,
                    jenis_kelamin: jenis_kelamin,
                    jabatan: jabatan,
                    alamat: alamat,
                    no_telepon: no_telepon,
                    username: username,
                    password: password
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
                        $('#modal_edit_guru').modal('hide');
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
                        $('#edit_nip_help').text(result.info);
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
                        $('#modal_edit_guru').modal('hide');
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

    $(document).on("click", "#button_hapus_guru", function() {
        var id_guru = $(this).data('id');
        var nama = $(this).data('nama');
        $("#hapus_id_guru").val(id_guru);
        $("#hapus_nama_guru").text(nama);
    });

    $(document).on("click", "#delete", function() {
        var id_guru = $('#hapus_id_guru').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('guru/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_guru: id_guru
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
                    $('#modal_hapus_guru').modal('hide');
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

    $(document).on("click", "#button_view_guru", function() {
        var id_guru = $(this).data('id');
        var nip_guru = $(this).data('nip_guru');
        var nama = $(this).data('nama');
        var email = $(this).data('email');
        var kelas = $(this).data('kelas');
        var jenis_kelamin = $(this).data('jenis_kelamin');
        var alamat = $(this).data('alamat');
        var jabatan = $(this).data('jabatan');
        var no_telepon = $(this).data('no_telepon');
        var username = $(this).data('username');
        $("#view_id_guru").val(id_guru);
        $("#view_nip_guru").val(nip_guru);
        $("#view_nama").val(nama);
        $("#view_email").val(email);
        $("#view_jenis_kelamin").val(jenis_kelamin);
        $("#view_alamat").val(alamat);
        $("#view_jabatan").val(jabatan);
        $("#view_no_telepon").val(no_telepon);
        $("#view_username").val(username);
    });
</script>