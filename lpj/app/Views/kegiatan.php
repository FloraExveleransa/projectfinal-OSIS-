<!DOCTYPE html>
<html lang="en">
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
        <h2 class="text-center mb-4">Formulir Pengajuan Proposal</h2>
        <form id="dataForm" action="/simpandata" method="post" enctype="multipart/form-data">
            <div class="form-section">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kegiatan">Kegiatan</label>
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Nama Kegiatan">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tgl_kegiatan">Tanggal Kegiatan</label>
                        <input type="date" class="form-control" id="tgl_kegiatan" name="tgl_kegiatan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="situasi_kegiatan">Situasi Kegiatan</label>
                        <input type="text" class="form-control" id="situasi_kegiatan" name="situasi_kegiatan" placeholder="Situasi">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tempat_kegiatan">Tempat Kegiatan</label>
                        <input type="text" class="form-control" id="tempat_kegiatan" name="tempat_kegiatan" placeholder="Tempat">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="penyelenggara">Penyelenggara</label>
                        <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" placeholder="Penyelenggara">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dana_keluar">Estimasi dana</label>
                        <input type="number" class="form-control" id="dana_keluar" name="dana_keluar" placeholder="Dana Keluar (Rp)">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="proposal">Proposal</label>
                        <input type="file" class="form-control-file" id="proposal" name="proposal" accept=".pdf">
                        <small class="form-text file-upload-info">Unggah file PDF untuk proposal. Maksimal ukuran file adalah 5MB.</small>
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
