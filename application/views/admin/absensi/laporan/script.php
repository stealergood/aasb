<script type="text/javascript">
    var table_absensi;

    $(document).ready(function() {

        //datatables
        table_absensi = $('#absensi_table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('absensi/laporan_absensi_ajax_list') ?>",
                "type": "POST",
                "data": function(d) {
                    console.log('dasf',d)
                    d.nip_guru = $('#guru').val();
                    d.kelas = $('#kelas').val();
                    d.tanggal_dari = $('#tanggal_dari').val();
                    d.tanggal_sampai = $('#tanggal_sampai').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 4, 5, 6, 7, 8, 9], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $("#guru").change(function() {
        table_absensi.ajax.reload();
    });

    $("#kelas").change(function() {
        table_absensi.ajax.reload();
    });

    $("#tanggal_dari").change(function() {
        table_absensi.ajax.reload();
    });

    $("#tanggal_sampai").change(function() {
        table_absensi.ajax.reload();
    });

    $(document).on("click", "#button_hapus_izin_siswa", function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        $("#hapus_id_izin_siswa").val(id);
        $("#hapus_nama_izin_siswa").text(nama);
        $("#hapus_nama_izin_siswa").text(nama);
    });

    $(document).on("click", "#button_konfirmasi_izin_siswa", function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        $("#konfirmasi_id_izin_siswa").val(id);
        $("#konfirmasi_nama_izin_siswa").text(nama);
        $("#konfirmasi_nama_izin_siswa").text(nama);
    });

    $(document).on('click',"#konfirmasi",function(){
        var id = $('#konfirmasi_id_izin_siswa').val();
        $.ajax({
            url: "<?= site_url('absensi/izin_konfirmasi') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_izin: id
            },
            beforeSend: function() {
                /* Show image container */
                $("#konfirmasi").prop("disabled", true);
                $('#konfirmasi').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
            },
            success: function(result) {
                console.log(result);
                if (result.status === true) {
                    $('#modal_konfirmasi_izin_siswa').modal('hide');
                    swal({
                            text: result.info,
                            icon: 'success',
                            timer: 800,
                            buttons: false,
                        })
                        .then(() => {
                            table_absensi.ajax.reload();
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
                $("#konfirmasi").prop("disabled", false);
                $('#konfirmasi').html('Konfirmasi');
            }
        });
    })

    $(document).on("click", "#delete", function() {
        var id = $('#hapus_id_izin_siswa').val();
        // processing ajax request
        $.ajax({
            url: "<?= site_url('absensi/izin_delete') ?>",
            type: 'POST',
            dataType: "json",
            data: {
                id_izin: id
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
                    $('#modal_hapus_izin_siswa').modal('hide');
                    swal({
                            text: result.info,
                            icon: 'success',
                            timer: 800,
                            buttons: false,
                        })
                        .then(() => {
                            table_absensi.ajax.reload();
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