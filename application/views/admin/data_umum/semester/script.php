<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#semester_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('data_umum/semester/ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 2, 3], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $('#tambah_semester').on('shown.bs.modal', function() {
        $('#nama_help').text('');
        $('#semester').val('');
        $('#status').prop('selectedIndex', 0);
        $('#semester').trigger('focus');
    })

    $(document).on("click", "#save", function() {
        $('#nama_help').text('');
        var semester = $('#semester').val();
        var status = $('#status').val();
        if (semester == '') {
            $('#semester').trigger('focus')
            $('#nama_help').text('Semester masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_umum/semester/add') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    semester: semester,
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
                        $('#tambah_semester').modal('hide');
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
                        $('#tambah_semester').modal('hide');
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

    $(document).on("click", "#button_edit_semester", function() {
        var id_semester = $(this).data('id');
        var semester = $(this).data('semester');
        var status = $(this).data('status');
        $("#edit_id_semester").val(id_semester);
        $("#edit_semester").val(semester);
        $("#edit_status").val(status);
    });

    $(document).on("click", "#save_edit", function() {
        $('#edit_nama_help').text('');
        var edit_id_semester = $('#edit_id_semester').val();
        var edit_semester = $('#edit_semester').val();
        var edit_status = $('#edit_status').val();
        if (edit_semester == '') {
            $('#edit_semester').trigger('focus')
            $('#edit_nama_help').text('Semester masih Kosong !!');
        } else {
            // processing ajax request
            $.ajax({
                url: "<?= site_url('data_umum/semester/update') ?>",
                type: 'POST',
                dataType: "json",
                data: {
                    id_semester: edit_id_semester,
                    semester: edit_semester,
                    status_semester: edit_status
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
                        $('#modal_edit_semester').modal('hide');
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
                        $('#modal_edit_semester').modal('hide');
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

    $(document).on("click", "#button_hapus_semester", function() {
        var id_semester = $(this).data('id');
        var semester = $(this).data('nama');
        $("#hapus_id_semester").val(id_semester);
        $("#hapus_semester").text(semester);
    });

    $(document).on("click", "#delete", function() {
        var id_semester = $('#hapus_id_semester').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('data_umum/semester/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_semester: id_semester
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
                    $('#modal_hapus_semester').modal('hide');
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
                $('#delete').html('Hapus Kelas');
            }
        });

    });
</script>