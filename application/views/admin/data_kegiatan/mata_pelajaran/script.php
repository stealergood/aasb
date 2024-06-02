<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#mata_pelajaran_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('data_kegiatan/mata_pelajaran/ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3, 4], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $('#modal_mata_pelajaran_baru').on('shown.bs.modal', function() {
        $('#kode_help').text('');
        $('#nama_help').text('');
        $('#kode_mapel').val('');
        $('#nama_mapel').val('');
        $('#status').prop('selectedIndex', 0);
        $('#kode_mapel').trigger('focus');
    })

    $(document).on("click", "#save", function() {
        $('#kode_help').text('');
        $('#nama_help').text('');
        var kode_mapel = $('#kode_mapel').val();
        var nama_mapel = $('#nama_mapel').val();
        var status = $('#status').val();
        if (kode_mapel == '') {
            $('#kode_mapel').trigger('focus')
            $('#nama_help').text('KOde Mata Pelajaran masih Kosong !!');
        } else if (nama_mapel == '') {
            $('#nama_mapel').trigger('focus')
            $('#nama_help').text('Nama Mata Pelajaran masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_kegiatan/mata_pelajaran/add') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    kode_mapel: kode_mapel,
                    nama_mapel: nama_mapel,
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
                        $('#modal_mata_pelajaran_baru').modal('hide');
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
                        $('#kode_help').text(result.info);
                    } else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                        $('#modal_tambah_tahun_ajaran').modal('hide');
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

    $(document).on("click", "#button_edit_mapel", function() {
        var id_mapel = $(this).data('id');
        var kode_mapel = $(this).data('kode');
        var nama_mapel = $(this).data('nama');
        var status = $(this).data('status');
        $("#edit_id_mapel").val(id_mapel);
        $("#edit_kode_mapel").val(kode_mapel);
        $("#edit_nama_mapel").val(nama_mapel);
        $("#edit_status").val(status);
    });

    $(document).on("click", "#save_edit", function() {
        $('#edit_kode_help').text('');
        $('#edit_nama_help').text('');
        var id_mapel = $('#edit_id_mapel').val();
        var kode_mapel = $('#edit_kode_mapel').val();
        var nama_mapel = $('#edit_nama_mapel').val();
        var status = $('#edit_status').val();
        if (kode_mapel == '') {
            $('#edit_kode_mapel').trigger('focus')
            $('#edit_nama_help').text('Kode Mata Pelajaran masih Kosong !!');
        } else if (nama_mapel == '') {
            $('#edit_nama_mapel').trigger('focus')
            $('#edit_nama_help').text('Mata Pelajaran masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_kegiatan/mata_pelajaran/update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_mapel: id_mapel,
                    kode_mapel: kode_mapel,
                    nama_mapel: nama_mapel,
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
                        $('#modal_edit_mapel').modal('hide');
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
                        $('#edit_kode_help').text(result.info);
                    } else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                        $('#modal_edit_mapel').modal('hide');
                    }
                },
                complete: function(data) {
                    // Hide image container
                    $("#save_edit").prop("disabled", false);
                    $('#save_edit').html('Save Changes');
                }
            });
        }

    });

    $(document).on("click", "#button_hapus_mapel", function() {
        var id_mapel = $(this).data('id');
        var nama_mapel = $(this).data('nama');
        $("#hapus_id_mapel").val(id_mapel);
        $("#hapus_mapel").text(nama_mapel);
    });

    $(document).on("click", "#delete", function() {
        var id_mapel = $('#hapus_id_mapel').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('data_kegiatan/mata_pelajaran/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_mapel: id_mapel
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
                    $('#modal_hapus_mapel').modal('hide');
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
</script>