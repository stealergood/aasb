<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#absensi_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('absensi/ekstrakurikuler/laporan_ajax') ?>",
                "type": "POST",
                "data": function(d) {
                    d.ekstrakurikuler = $('#ekstrakurikuler').val();
                    d.kelas = $('#kelas').val();
                    d.keterangan = $('#keterangan').val();
                    d.tanggal_dari = $('#tanggal_dari').val();
                    d.tanggal_sampai = $('#tanggal_sampai').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 4, 5, 6], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $("#ekstrakurikuler").change(function() {
        table.ajax.reload();
    });

    $("#kelas").change(function() {
        table.ajax.reload();
    });

    $("#keterangan").change(function() {
        table.ajax.reload();
    });

    $("#tanggal_dari").change(function() {
        table.ajax.reload();
    });

    $("#tanggal_sampai").change(function() {
        table.ajax.reload();
    });

    $(document).on("click", "#button_hapus_form_ekstra", function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        $("#hapus_id_form_ekstra").val(id);
        $("#hapus_nama_form_ekstra").text(nama);
    });

    $(document).on("click", "#delete", function() {
        var id = $('#hapus_id_form_ekstra').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('absensi/ekstrakurikuler/delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id: id
            },
            beforeSend: function() {
                /* Show image container */
                $("#delete").prop("disabled", true);
                $('#delete').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
            },
            success: function(result) {
                console.log(result);
                if (result.status === true) {
                    $('#modal_hapus_form_ekstra').modal('hide');
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