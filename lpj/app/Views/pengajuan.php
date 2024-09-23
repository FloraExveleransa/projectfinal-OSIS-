<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukkan Data Kegiatan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .form-section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .notification {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            z-index: 1050;
        }
        .file-upload-info {
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Formulir Pengajuan Kegiatan</h2>
        <form id="dataForm" action="/simpandata" method="post" enctype="multipart/form-data">
            <div class="form-section">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Nama Kegiatan">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hasil_kegiatan">Hasil Kegiatan</label>
                        <input type="text" class="form-control" id="hasil_kegiatan" name="hasil_kegiatan" placeholder="Hasil Kegiatan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="laporan_keuangan">Laporan Keuangan</label>
                        <input type="file" class="form-control-file" id="laporan_keuangan" name="laporan_keuangan" accept=".pdf">
                        <small class="form-text file-upload-info">Unggah file PDF untuk laporan keuangan. Maksimal ukuran file adalah 5MB.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status_lpj">Status LPJ</label>
                        <select class="form-control" id="status_lpj" name="status_lpj">
                            <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="submitted_by">Diajukan Oleh</label>
                        <input type="text" class="form-control" id="submitted_by" name="submitted_by" placeholder="Nama Pengaju">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="submitted_at">Tanggal Pengajuan</label>
                        <input type="date" class="form-control" id="submitted_at" name="submitted_at">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="updated_at">Tanggal Pembaruan</label>
                        <input type="date" class="form-control" id="updated_at" name="updated_at">
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>

    <!-- Notification -->
    <div class="notification" id="notification">
        Data berhasil dikirim!
    </div>

    <script>
        document.getElementById('dataForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Display the notification
            const notification = document.getElementById('notification');
            notification.style.display = 'block';

            // Hide the notification after 3 seconds
            setTimeout(function() {
                notification.style.display = 'none';
            }, 3000);
        });
    </script>
</body>
</html>
