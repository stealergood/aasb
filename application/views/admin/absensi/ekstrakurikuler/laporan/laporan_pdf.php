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
            text-align: left;
            background-color: #AFAFB6;
            color: white;
        }
    </style>
</head>

<body>
    <img src="<?= base_url() ?>assets/img/<?= $settings['logo'] ?>" style="margin-top:10px; margin-left: 30px;;" align="left" alt="" width=70 height="70">
    <div style="text-align:center; margin-top:30px; margin-left:-60px;">
        <h3> Laporan Presensi Ekstrakurikuler</h3>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Jenis_kelamin</th>
                <th>tanggal</th>
                <th>Ekstrakurikuler</th>
                <th>Keterangan</th>
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
                echo '<tr><td>' . $no . '</td><td>' . $data->nis_siswa . '</td><td>' . $data->name . '</td><td>' . $jk . '</td><td>' . $data->tanggal . '</td><td>' . $data->nama . '</td><td>' . $data->keterangan . '</td></tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>