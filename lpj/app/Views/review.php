<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar File PDF</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px; /* Ukuran kontainer */
      margin: 20px auto;
      padding: 20px;
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    .header h1 {
      margin: 0;
      color: #333;
      font-size: 2em; /* Ukuran font judul */
    }
    .main-panel {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
      padding: 15px;
    }
    .table-responsive {
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      text-align: left;
      font-size: 0.9em; /* Ukuran font yang lebih kecil */
    }
    th {
      background-color: #f8f8f8;
      border-bottom: 1px solid #ddd;
      color: #555;
    }
    td {
      border-bottom: 1px solid #ddd;
    }
    tr:hover td {
      background-color: #f1f1f1;
    }
    .no-data {
      text-align: center;
      color: #888;
      font-style: italic;
    }
    .pdf-link {
      display: inline-block;
      padding: 6px 12px; /* Ukuran tombol lebih kecil */
      color: #fff;
      background-color: #007bff;
      text-decoration: none;
      border-radius: 4px;
    }
    .pdf-link:hover {
      background-color: #0056b3;
    }
    .footer {
      margin-top: 20px;
      text-align: center;
      color: #666;
      font-size: 0.8em; /* Ukuran font footer lebih kecil */
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Daftar File Pengajuan LPJ</h1>
    </div>
    <div class="main-panel">
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>File PDF</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($manda)): ?>
              <?php $no = 1; ?>
              <?php foreach ($manda as $lpj): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td>
                    <a href="<?= htmlspecialchars('/img/' . $lpj['laporan_keuangan']) ?>" class="pdf-link" target="_blank">
                      <?= htmlspecialchars($lpj['laporan_keuangan']) ?>
                    </a>
                    </td>
                </tr>
                 
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="2" class="no-data">Tidak ada file PDF tersedia</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="footer">
      &copy; <?= date('Y') ?> Your Company. All rights reserved.
    </div>
  </div>
</body>
</html>
