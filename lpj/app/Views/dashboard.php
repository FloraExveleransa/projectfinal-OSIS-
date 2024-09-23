<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .main-panel {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h3 {
            margin-bottom: 30px;
            color: #333;
        }
        .btn-custom {
            display: inline-block;
            padding: 15px 30px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1.2em;
            margin: 10px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .no-data {
            text-align: center;
            color: #888;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="main-panel">
        <h3>Sistem Informasi Pelaporan Agenda Kegiatan OSIS </h3>
        <a href="<?= base_url('home/proposal') ?>" class="btn-custom">View Proposal</a>
        <a href="<?= base_url('home/lpj') ?>" class="btn-custom">View LPJ</a>
        <!-- Jika perlu, tambahkan elemen lain di sini -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
