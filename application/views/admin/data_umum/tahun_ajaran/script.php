<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#tahun_ajaran_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('data_umum/tahun_ajaran/ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 2, 3], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $('#modal_tambah_tahun_ajaran').on('shown.bs.modal', function() {
        $('#nama_help').text('');
        $('#tahun_ajaran').val('');
        $('#status').prop('selectedIndex', 0);
        $('#tahun_ajaran').trigger('focus');
    })

    $(document).on("click", "#save", function() {
        $('#nama_help').text('');
        var tahun_ajaran = $('#tahun_ajaran').val();
        var status = $('#status').val();
        if (tahun_ajaran == '') {
            $('#semester').trigger('focus')
            $('#nama_help').text('Semester masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_umum/tahun_ajaran/add') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    tahun_ajaran: tahun_ajaran,
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
                        $('#modal_tambah_tahun_ajaran').modal('hide');
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
                        $('#nama_help').text(result.info);
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
                    $('#save').html('Save');
                }
            });
        }

    });

    $(document).on("click", "#button_edit_tahun_ajaran", function() {
        var id_tahun_ajaran = $(this).data('id');
        var tahun_ajaran = $(this).data('tahun_ajaran');
        var status = $(this).data('status');
        $("#edit_id_tahun_ajaran").val(id_tahun_ajaran);
        $("#edit_tahun_ajaran").val(tahun_ajaran);
        $("#edit_status").val(status);
    });

    $(document).on("click", "#save_edit", function() {
        $('#edit_nama_help').text('');
        var edit_id_tahun_ajaran = $('#edit_id_tahun_ajaran').val();
        var edit_tahun_ajaran = $('#edit_tahun_ajaran').val();
        var edit_status = $('#edit_status').val();
        if (edit_tahun_ajaran == '') {
            $('#edit_tahun_ajaran').trigger('focus')
            $('#edit_nama_help').text('Tahun Ajaran masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_umum/tahun_ajaran/update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_tahun_ajaran: edit_id_tahun_ajaran,
                    tahun_ajaran: edit_tahun_ajaran,
                    status: edit_status
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
                        $('#modal_edit_tahun_ajaran').modal('hide');
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
                        $('#modal_edit_tahun_ajaran').modal('hide');
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

    $(document).on("click", "#button_hapus_tahun_ajaran", function() {
        var id_tahun_ajaran = $(this).data('id');
        var tahun_ajaran = $(this).data('tahun_ajaran');
        $("#hapus_id_tahun_ajaran").val(id_tahun_ajaran);
        $("#hapus_tahun_ajaran").text(tahun_ajaran);
    });

    $(document).on("click", "#delete", function() {
        var id_tahun_ajaran = $('#hapus_id_tahun_ajaran').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('data_umum/tahun_ajaran/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_tahun_ajaran: id_tahun_ajaran
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
                    $('#modal_hapus_tahun_ajaran').modal('hide');
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