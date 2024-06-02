<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pemberitahuan Kehadiran Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333333;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }
        
        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        p {
            margin-bottom: 10px;
        }
        
        .info {
            background-color: #e9e9e9;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pemberitahuan Kehadiran Siswa</h1>
        
        <p>Yth. <?php echo $nama_ortu; ?>,</p>
        
        <p>Berikut adalah informasi kehadiran anak Anda:</p>
        
        <div class="info">
            <p><strong>Nama Siswa:</strong> <?php echo $nama_siswa; ?></p>
            <p><strong>Status Kehadiran:</strong> <?php echo $status_kehadiran; ?></p>
            <p><strong>Pesan:</strong><?php echo $message; ?></p>
        </div>
        
        <p>Terima kasih atas perhatian Anda.</p>
        
        <p>Hormat kami,</p>
        <p>Sekolah Dasar Negeri 1 Yogyakarta</p>
    </div>
</body>
</html>
