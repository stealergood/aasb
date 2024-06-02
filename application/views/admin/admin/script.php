<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#admin_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $('#modal_tambah_admin').on('shown.bs.modal', function() {
        $('#nama_help').text('');
        $('#username_help').text('');
        $('#password_help').text('');

        $('#nama').val('');
        $('#username').val('');
        $('#password').val('');
        $('#nama').trigger('focus');
    })

    $(document).on("click", "#save", function() {
        $('#nama_help').text('');
        $('#username_help').text('');
        $('#password_help').text('');

        var nama = $('#nama').val();
        var username = $('#username').val();
        var password = $('#password').val();

        if (nama == '') {
            $('#nama').trigger('focus')
            $('#nama_help').text('Nama masih Kosong !!');
        } else if (username == '') {
            $('#username').trigger('focus')
            $('#username_help').text('Username masih Kosong !!');
        } else if (password == '') {
            $('#password').trigger('focus')
            $('#password_help').text('Password masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('admin/add') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    nama: nama,
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
                        $('#modal_tambah_admin').modal('hide');
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
                        $('#modal_tambah_admin').modal('hide');
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

    $(document).on("click", "#button_edit_admin", function() {
        var id_admin = $(this).data('id');
        var nama = $(this).data('nama');
        var username = $(this).data('username');

        $("#edit_id_admin").val(id_admin);
        $("#edit_nama").val(nama);
        $("#edit_username").val(username);
        $("#edit_password").val('');
    });

    $(document).on("click", "#save_edit", function() {
        $('#edit_nama_help').text('');
        $('#edit_username_help').text('');

        var id_admin = $('#edit_id_admin').val();
        var nama = $('#edit_nama').val();
        var username = $('#edit_username').val();
        var password = $('#edit_password').val();

        if (nama == '') {
            $('#edit_nama').trigger('focus')
            $('#edit_nama_help').text('Nama masih Kosong !!');
        } else if (username == '') {
            $('#edit_username').trigger('focus')
            $('#edit_username_help').text('Username masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('admin/update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_admin: id_admin,
                    nama: nama,
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
                        $('#modal_edit_admin').modal('hide');
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
                        $('#modal_edit_admin').modal('hide');
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

    $(document).on("click", "#button_hapus_admin", function() {
        var id_admin = $(this).data('id');
        var nama = $(this).data('nama');
        $("#hapus_id_admin").val(id_admin);
        $("#hapus_nama_admin").text(nama);
    });

    $(document).on("click", "#delete", function() {
        var id_admin = $('#hapus_id_admin').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('admin/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_admin: id_admin
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
                    $('#modal_hapus_admin').modal('hide');
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

    $(document).on("click", "#button_view_admin", function() {
        var id_admin = $(this).data('id');
        var nama = $(this).data('nama');
        var email = $(this).data('email');
        var kelas = $(this).data('kelas');
        var alamat = $(this).data('alamat');
        var no_telepon = $(this).data('no_telepon');
        var username = $(this).data('username');
        $("#view_id_admin").val(id_admin);
        $("#view_nama").val(nama);
        $("#view_email").val(email);
        $("#view_alamat").val(alamat);
        $("#view_no_telepon").val(no_telepon);
        $("#view_username").val(username);
    });
</script>