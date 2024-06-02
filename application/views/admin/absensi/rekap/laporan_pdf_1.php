<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        html {
            font-family: "Times New Roman", Times, serif;
        }

        * {
            margin: 2px;
            padding: 2px;
        }

        #table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 25px;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 4px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: center;
            background-color: #AFAFB6;
            color: white;
        }
    </style>
</head>

<body>
    <img src="<?= base_url() ?>assets/img/<?= $settings['logo'] ?>" style="margin-top:10px; margin-left: 30px;;" align="left" alt="" width=70 height="70">
    <div style="text-align:center; margin-top:30px; margin-left:-60px;">
        <h3> Laporan Absensi</h3>
    </div>
    <table id="table">
        <thead>
            <tr>
                 <th scope="col">#</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nama Orang Tua</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Tanggal</th>
                                    <!--    <th scope="col">Mata Pelajaran</th> -->
                                        <th scope="col">Kelas</th>
                                    <!--    <th scope="col">Pertemuan</th> -->
                                        <th scope="col">Jam</th>
                                        <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataku as $data) {
                if ($data->jenis_kelamin == "L") {
                    $jk = "Laki - laki";
                } else {
                    $jk = "Perempuan";
                }
                echo '<tr><td style="text-align:center;">' . $no . '</td><td style="text-align:right;">' . $data->nis_siswa . '</td><td>' . $data->name . '</td><td>' . $data->orangtua . '</td><td style="text-align:center;">' . $jk . '</td><td style="text-align:center;">' . $data->tanggal . '</td><td>' . $data->nama_mapel . '</td><td>' . $data->nama_kelas . '</td><td style="text-align:center;">' . $data->pertemuan_ke . '</td><td style="text-align:center;">' . $data->jam . '</td><td style="text-align:center;">' . $data->keterangan . '</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
    
    <br>
    Keterangan :<br><br>
    H : Hadir<br>
    I : Izin<br>
    A : Alpha<br>
    T : Tanpa Keterangan
    
</body>

</html>