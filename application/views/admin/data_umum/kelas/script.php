<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#table_kelas').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('data_umum/kelas/ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3, 4], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $('#tambah_kelas').on('shown.bs.modal', function() {
        $('#ta_help').text('');
        $('#nama_help').text('');
        $('#ta_kelas').val('');
        $('#nama_kelas').val('');
        $('#status_kelas').prop('selectedIndex', 0);
        $('#name').trigger('focus');
    })

    $(document).on("click", "#save", function() {
        $('#ta_help').text('');
        $('#nama_help').text('');
        var ta_kelas = $('#ta_kelas').val();
        var nama_kelas = $('#nama_kelas').val();
        var status_kelas = $('#status_kelas').val();
        if (ta_kelas == '') {
            $('#ta_kelas').trigger('focus')
            $('#ta_help').text('Kode Kelas masih Kosong !!');
        } else if (nama_kelas == '') {
            $('#nama_kelas').trigger('focus')
            $('#nama_help').text('Nama Kelas masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_umum/kelas/add') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    ta_kelas: ta_kelas,
                    nama_kelas: nama_kelas,
                    status_kelas: status_kelas
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
                        $('#tambah_kelas').modal('hide');
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
                        $('#ta_help').text(result.info);
                    } else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                        $('#tambah_kelas').modal('hide');
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

    $(document).on("click", "#button_edit_kelas", function() {
        var id_kelas = $(this).data('id');
        var ta_kelas = $(this).data('ta');
        var nama_kelas = $(this).data('nama');
        var status = $(this).data('status');
        $("#edit_id_kelas").val(id_kelas);
        $("#edit_ta_kelas").val(ta_kelas);
        $("#edit_nama_kelas").val(nama_kelas);
        $("#edit_status").val(status);
    });

    $(document).on("click", "#save_edit", function() {
        $('#edit_ta_help').text('');
        $('#edit_nama_help').text('');
        var edit_id_kelas = $('#edit_id_kelas').val();
        var edit_ta_kelas = $('#edit_ta_kelas').val();
        var edit_nama_kelas = $('#edit_nama_kelas').val();
        var edit_status_kelas = $('#edit_status').val();
        if (edit_ta_kelas == '') {
            $('#edit_ta_kelas').trigger('focus')
            $('#edit_ta_help').text('Kode Kelas masih Kosong !!');
        } else if (edit_nama_kelas == '') {
            $('#edit_nama_kelas').trigger('focus')
            $('#edit_nama_help').text('Nama Kelas masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_umum/kelas/update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_kelas: edit_id_kelas,
                    ta_kelas: edit_ta_kelas,
                    nama_kelas: edit_nama_kelas,
                    status_kelas: edit_status_kelas
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
                        $('#edit_kelas').modal('hide');
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
                        $('#edit_ta_help').text(result.info);
                    } else if (result.status === 'more') {
                        swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                    } else {
                        swal("alert", "Data Not Save", "error");
                        $('#tambah_kelas').modal('hide');
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

    $(document).on("click", "#button_hapus_kelas", function() {
        var id_kelas = $(this).data('id');
        var nama_kelas = $(this).data('nama');
        $("#hapus_id_kelas").val(id_kelas);
        $("#hapus_nama_kelas").text(nama_kelas);
    });

    $(document).on("click", "#delete_kelas", function() {
        var id_kelas = $('#hapus_id_kelas').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('data_umum/kelas/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_kelas: id_kelas
            },
            beforeSend: function() {
                /* Show image container */
                $("#delete_kelas").prop("disabled", true);
                $('#delete_kelas').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
            },
            success: function(result) {
                if (result.status === true) {
                    $('#modal_hapus_kelas').modal('hide');
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
                $("#delete_kelas").prop("disabled", false);
                $('#delete_kelas').html('Hapus Kelas');
            }
        });

    });
</script>