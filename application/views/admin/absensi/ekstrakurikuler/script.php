<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#siswa_table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "lengthChange": false,
            "info": false,
            "iDisplayLength": 5,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('absensi/siswa_ajax_list') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3, 4], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

    });

    $(document).on("click", "#button_cari_nis", function() {
        table.ajax.reload();
    });

    $(document).on("click", "#button_pilih_siswa", function() {
        var id_siswa = $(this).data('id');
        var nis_siswa = $(this).data('nis_siswa');
        var nama = $(this).data('nama');
        var kelas = $(this).data('kelas');
        var jenis_kelamin = $(this).data('jenis_kelamin');
        $("#id_siswa").val(id_siswa);
        $("#nis_siswa").val(nis_siswa);
        $("#nama_siswa").val(nama);
        $("#kelas").val(kelas);
        $("#jenis_kelamin").val(jenis_kelamin);
        $('#modal_daftar_siswa').modal('hide');
        reset_help();
        $('#tanggal').trigger('focus')
    });

    $(document).on("click", "#tambah_file", function() {
        const fileupload = $('#file_izin').prop('files')[0];
        var nama_file = fileupload.name;

        var kode_izin = $("#kode_izin").val();

        if (kode_izin == "") {
            $('#kode_izin').trigger('focus')
            $("#kode_izin_help").text('Kode Izin Masih Kosong');
            return
        }

        $("#kode_izin_help").text('');

        if (!['image/jpeg', 'image/png', 'application/pdf'].includes(fileupload.type)) {
            swal({
                text: "Hanya Boleh Upload Gambar dan PDF",
                icon: 'error',
                timer: 1400,
                buttons: false,
            })
            return;
        }

        if (nama_file) {
            $('#modal_form_izin').modal('hide');
            document.getElementById("izin").disabled = false;
            document.getElementById("izin").checked = true;
            document.getElementById("form_izin").disabled = true;
            document.getElementById("hadir").disabled = true;
        }
    });

    $(document).on("click", "#batal", function() {
        reset_input();
    });


    function reset_input() {
        document.getElementById("hadir").checked = true;
        <?php
        $jenis_login = $this->session->userdata('jenis_login');
        $jenis = array("admin", "guru", "kepala_sekolah");

        if (in_array($jenis_login, $jenis)) {
        ?>
            $("#id_siswa").val('');
            $("#nis_siswa").val('');
            $("#nama_siswa").val('');
            $('#kelas').prop('selectedIndex', 0);
            $('#jenis_kelamin').prop('selectedIndex', 0);
        <?php
        }
        ?>
        $('#ekstrakurikuler').prop('selectedIndex', 0);
        $("#pertemuan").val('');
        $('#jenis_izin').prop('selectedIndex', 0);
    }

    function reset_help() {
        $("#nis_siswa_help").text('');
        $("#nama_siswa_help").text('');
        $("#tanggal_help").text('');
        $("#pertemuan_help").text('');
    }

    $(document).on("click", "#simpan", function() {
        reset_help();
        var id_siswa = $("#id_siswa").val();
        var nis_siswa = $("#nis_siswa").val();
        var nama_siswa = $("#nama_siswa").val();
        var kelas = $("#kelas").val();
        var janis_kelamin = $("#janis_kelamin").val();
        var ekstrakurikuler = $("#ekstrakurikuler").val();
        var tanggal = $("#tanggal").val();
        var pertemuan = $("#pertemuan").val();
        var presensi = $("input[type=radio][name=presensi]:checked").val();

        if (nis_siswa == '') {
            $('#nis_siswa').trigger('focus')
            $("#nis_siswa_help").text('NOmor Induk Siswa Masih Kosong');
            return
        }

        if (nama_siswa == '') {
            $('#nama_siswa').trigger('focus')
            $("#nama_siswa_help").text('Nama Siswa Masih Kosong');
            return
        }

        if (tanggal == '') {
            $('#tanggal').trigger('focus')
            $("#tanggal_help").text('Tanggal Masih Kosong');
            return
        }

        if (pertemuan == '') {
            $('#pertemuan').trigger('focus')
            $("#pertemuan_help").text('Pertemuan Masih Kosong');
            return
        }

        let formData = new FormData();
        formData.append('id_siswa', id_siswa);
        formData.append('kelas', kelas);
        formData.append('tanggal', tanggal);
        formData.append('pertemuan', pertemuan);
        formData.append('ekstrakurikuler', ekstrakurikuler);
        formData.append('keterangan', presensi);

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('absensi/ekstrakurikuler/add') ?>",
            data: formData,
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function() {
                /* Show image container */
                $("#simpan").prop("disabled", true);
                $('#simpan').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
            },
            success: function(result) {
                console.log(result);
                if (result.status == true) {
                    swal({
                        text: result.info,
                        icon: 'success',
                        timer: 800,
                        buttons: false,
                    }).then(() => {
                        // location.reload();
                        reset_input();
                    })
                } else if (result.status === 'error') {
                    swal({
                            text: result.info,
                            icon: 'warning',
                            timer: 1200,
                            buttons: false,
                        })
                        .then(() => {
                            reset_input();
                        })
                } else if (result.status === 'info') {
                    // console.log(result)
                } else {
                    console.log(result)
                    // swal("alert", "Data Not Save", "error");
                    // reset_input();
                }
            },
            complete: function(data) {
                // Hide image container
                $("#simpan").prop("disabled", false);
                $('#simpan').html('Simpan');
            },
            error: function() {
                console.log(error)
            }
        });
    });
</script>