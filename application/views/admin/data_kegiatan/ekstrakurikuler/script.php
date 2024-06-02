<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#ekstrakurikuler_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('data_kegiatan/ekstrakurikuler/ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3, 4], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $('#modal_ekstrakurikuler_baru').on('shown.bs.modal', function() {
        $('#kode_help').text('');
        $('#nama_help').text('');
        $('#kode_ekstrakurikuler').val('');
        $('#nama_ekstrakurikuler').val('');
        $('#status').prop('selectedIndex', 0);
        $('#kode_ekstrakurikuler').trigger('focus');
    })

    $(document).on("click", "#save", function() {
        $('#kode_help').text('');
        $('#nama_help').text('');
        var kode_ekstrakurikuler = $('#kode_ekstrakurikuler').val();
        var nama_ekstrakurikuler = $('#nama_ekstrakurikuler').val();
        var status = $('#status').val();
        if (kode_ekstrakurikuler == '') {
            $('#kode_ekstrakurikuler').trigger('focus')
            $('#nama_help').text('KOde Ekstrakurikuler masih Kosong !!');
        } else if (nama_ekstrakurikuler == '') {
            $('#nama_ekstrakurikuler').trigger('focus')
            $('#nama_help').text('Nama Ekstrakurikuler masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_kegiatan/ekstrakurikuler/add') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    kode_ekstrakurikuler: kode_ekstrakurikuler,
                    nama_ekstrakurikuler: nama_ekstrakurikuler,
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
                        $('#modal_ekstrakurikuler_baru').modal('hide');
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
                        $('#modal_tambah_ekstrakurikuler').modal('hide');
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

    $(document).on("click", "#button_edit_ekstrakurikuler", function() {
        var id_ekstrakurikuler = $(this).data('id');
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var status = $(this).data('status');
        $("#edit_id_ekstrakurikuler").val(id_ekstrakurikuler);
        $("#edit_kode").val(kode);
        $("#edit_nama").val(nama);
        $("#edit_status").val(status);
    });

    $(document).on("click", "#save_edit", function() {
        $('#edit_kode_help').text('');
        $('#edit_nama_help').text('');
        var id_ekstrakurikuler = $('#edit_id_ekstrakurikuler').val();
        var kode = $('#edit_kode').val();
        var nama = $('#edit_nama').val();
        var status = $('#edit_status').val();
        if (kode == '') {
            $('#edit_kode').trigger('focus')
            $('#edit_nama_help').text('Kode Ekstrakurikuler masih Kosong !!');
        } else if (nama == '') {
            $('#edit_nama').trigger('focus')
            $('#edit_nama_help').text('Ekstrakurikuler masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_kegiatan/ekstrakurikuler/update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_ekstrakurikuler: id_ekstrakurikuler,
                    kode: kode,
                    nama: nama,
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
                        $('#modal_edit_ekstrakurikuler').modal('hide');
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
                        $('#modal_edit_ekstrakurikuler').modal('hide');
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

    $(document).on("click", "#button_hapus_ekstrakurikuler", function() {
        var id_ekstrakurikuler = $(this).data('id');
        var nama = $(this).data('nama');
        $("#hapus_id_ekstrakurikuler").val(id_ekstrakurikuler);
        $("#hapus_ekstrakurikuler").text(nama);
    });

    $(document).on("click", "#delete", function() {
        var id_ekstrakurikuler = $('#hapus_id_ekstrakurikuler').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('data_kegiatan/ekstrakurikuler/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_ekstrakurikuler: id_ekstrakurikuler
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
                    $('#modal_hapus_ekstrakurikuler').modal('hide');
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