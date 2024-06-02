<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#aktifitas_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('aktifitas/ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3, 4, 5], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $('#modal_tambah_aktifitas').on('shown.bs.modal', function() {
        $('#id_guru_help').text('');
        $('#id_mapel_help').text('');
        $('#id_ekstrakurikuler_help').text('');
       
        $('#status').prop('selectedIndex', 0);
    })

    $(document).on("click", "#save", function() {
       $('#id_guru_help').text('');
        $('#id_mapel_help').text('');
        $('#id_ekstrakurikuler_help').text('');

        var id_guru = $('#id_guru').val();
        var id_mapel = $('#id_mapel').val();
        var id_ekstrakurikuler = $('#id_ekstrakurikuler').val();
        var status = $('#status').val();

        if (id_guru == '') {
            $('#id_guru').trigger('focus')
            $('#id_guru_help').text('Guru masih Kosong !!');
        } /*else if (id_mapel == '') {
            $('#id_mapel').trigger('focus')
            $('#id_mapel_help').text('Mapel masih Kosong !!');
        } else if (id_ekstrakurikuler == '') {
            $('#id_ekstrakurikuler').trigger('focus')
            $('#id_ekstrakurikuler_help').text('Ekskul masih Kosong !!');
        }*/ else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('aktifitas/add') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_guru: id_guru,
                    id_mapel: id_mapel,
                    id_ekstrakurikuler: id_ekstrakurikuler,
                    status: status
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
                        $('#modal_tambah_aktifitas').modal('hide');
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
                        $('#id_guru_help').text(result.info);
                    }  else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                        $('#modal_tambah_aktifitas').modal('hide');
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

    $(document).on("click", "#button_edit_aktifitas", function() {
        var id_aktifitas = $(this).data('id');
        var id_guru = $(this).data('id_guru');
        var id_mapel = $(this).data('id_mapel');
        var id_ekstrakurikuler = $(this).data('id_ekstrakurikuler');
        var status = $(this).data('status');
      
        $("#edit_id_aktifitas").val(id_aktifitas);
        $("#edit_guru").val(id_guru);
        $("#edit_mapel").val(id_mapel);
        $("#edit_ekstrakurikuler").val(id_ekstrakurikuler);
        $("#edit_status").val(status);
     
    });

    $(document).on("click", "#save_edit", function() {
      
        var id_aktifitas = $('#edit_id_aktifitas').val();
        var id_guru = $('#edit_guru').val();
        var id_mapel = $('#edit_mapel').val();
        var id_ekstrakurikuler = $('#edit_ekstrakurikuler').val();
        var status = $('#edit_status').val();

        if (id_guru == '') {
            $('#edit_guru').trigger('focus')
            $('#edit_guru_help').text('Guru masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('aktifitas/update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_aktifitas: id_aktifitas,
                    id_guru: id_guru,
                    id_mapel: id_mapel,
                    id_ekstrakurikuler: id_ekstrakurikuler,
                    status: status
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
                        $('#modal_edit_aktifitas').modal('hide');
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
                    } else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                        $('#modal_edit_aktifitas').modal('hide');
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

    $(document).on("click", "#button_hapus_aktifitas", function() {
        var id_aktifitas = $(this).data('id');
        var nama = $(this).data('nama');
        $("#hapus_id_aktifitas").val(id_aktifitas);
        $("#hapus_nama_aktifitas").text(nama);
    });

    $(document).on("click", "#delete", function() {
        var id_aktifitas = $('#hapus_id_aktifitas').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('aktifitas/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_aktifitas: id_aktifitas
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
                    $('#modal_hapus_aktifitas').modal('hide');
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

    $(document).on("click", "#button_view_aktifitas", function() {
        var id_aktifitas = $(this).data('id');
        var nis_aktifitas = $(this).data('nis_aktifitas');
        var nama = $(this).data('nama');
        var kelas = $(this).data('kelas');
        var jenis_kelamin = $(this).data('jenis_kelamin');
        var alamat = $(this).data('alamat');
        var tahun_masuk = $(this).data('tahun_masuk');
        var username = $(this).data('username');
        //var email_orangtua = $(this).data('email_orangtua');
        var nama_orangtua = $(this).data('nama_orangtua');
        $("#view_id_aktifitas").val(id_aktifitas);
        $("#view_nis_aktifitas").val(nis_aktifitas);
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