<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan (Proposal)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .table {
            margin-top: 20px;
            width: 100%;
            overflow-x: auto;
            display: block;
        }
        .card {
            margin-top: 20px;
        }
        .search-section {
            margin-bottom: 20px;
        }
        .search-input {
            border-radius: 0;
            border: 1px solid #ced4da;
        }
        .search-button {
            border-radius: 0;
            border: 1px solid #ced4da;
            border-left: none;
            background-color: #007bff;
            color: white;
        }
        .input-group {
            max-width: 400px;
            margin: 0;
        }
        .btn-custom {
            display: inline-block;
            padding: 9px 16px;
            font-size: 1em;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .status-select {
            width: 100%;
            border-radius: 4px;
            border: 1px solid #ced4da;
            overflow: hidden;
            text-overflow: clip;
            white-space: nowrap;
        }
        .status-select option {
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .btn-back {
            background-color: #6c757d;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4 text-center">Detail Pelaksanaan Kegiatan (Proposal)</h2>

        <!-- Notification -->
        <?php if (session()->getFlashdata('status')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('status') ?>
            </div>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="d-flex">
            <a href="<?= base_url('home/dashboard') ?>" class="btn btn-back">Back</a>
            <div class="search-section">
                <form action="<?= base_url('detail/search') ?>" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control search-input" name="query" placeholder="Cari nama kegiatan...">
                        <div class="input-group-append">
                            <button class="btn search-button" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Kegiatan</h5>
            </div>
            <div class="card-body table-responsive">
                <?php if (!empty($kegiatan) && is_array($kegiatan)): ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Situasi Kegiatan</th>
                                <th>Tempat Kegiatan</th>
                                <th>Penyelenggara</th>
                                <th>Keterangan</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Dana yang Keluar</th>
                                <th>Proposal</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status Kesiswaan</th>
                                <th>Status Kepala Sekolah</th>
                                <th>Status Yayasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kegiatan as $activity): ?>
                                <tr>
                                    <td><?= esc($activity['kegiatan']) ?></td>
                                    <td><?= esc($activity['tanggal_kegiatan']) ?></td>
                                    <td><?= esc($activity['situs_kegiatan']) ?></td>
                                    <td><?= esc($activity['tempat_kegiatan']) ?></td>
                                    <td><?= esc($activity['penyelenggara']) ?></td>
                                    <td><?= esc($activity['keterangan']) ?></td>
                                    <td><?= esc($activity['jam_mulai']) ?></td>
                                    <td><?= esc($activity['jam_selesai']) ?></td>
                                    <td><?= esc($activity['dana_keluar']) ?></td>
                                    <td><a href="<?= base_url('img/' . esc($activity['proposal'])) ?>" class="btn-custom" target="_blank">Klik Di Sini</a></td>
                                    <td><?= esc($activity['created_at']) ?></td>
                                    <td>
                                        <select class="status-select" data-id="<?= esc($activity['id_lpj']) ?>" data-field="status_kesiswaan">
                                            <option value="Menunggu Persetujuan" <?= esc($activity['status_kesiswaan']) == 'Menunggu Persetujuan' ? 'selected' : '' ?>>Menunggu Persetujuan</option>
                                            <option value="Disetujui" <?= esc($activity['status_kesiswaan']) == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                                            <option value="Ditolak" <?= esc($activity['status_kesiswaan']) == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="status-select" data-id="<?= esc($activity['id_lpj']) ?>" data-field="status_kepala_sekolah">
                                            <option value="Menunggu Persetujuan" <?= esc($activity['status_kepala_sekolah']) == 'Menunggu Persetujuan' ? 'selected' : '' ?>>Menunggu Persetujuan</option>
                                            <option value="Disetujui" <?= esc($activity['status_kepala_sekolah']) == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                                            <option value="Ditolak" <?= esc($activity['status_kepala_sekolah']) == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="status-select" data-id="<?= esc($activity['id_lpj']) ?>" data-field="status_yayasan">
                                            <option value="Menunggu Persetujuan" <?= esc($activity['status_yayasan']) == 'Menunggu Persetujuan' ? 'selected' : '' ?>>Menunggu Persetujuan</option>
                                            <option value="Disetujui" <?= esc($activity['status_yayasan']) == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                                            <option value="Ditolak" <?= esc($activity['status_yayasan']) == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">Tidak ada data kegiatan tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.status-select').change(function() {
                var id = $(this).data('id');
                var field = $(this).data('field');
                var value = $(this).val();

                $.ajax({
                    url: '<?= base_url('detail/update_status') ?>',
                    method: 'POST',
                    data: {
                        id: id,
                        field: field,
                        value: value
                    },
                    success: function(response) {
                        // Optional: handle response if needed
                        console.log('Status updated successfully');
                    },
                    error: function() {
                        alert('Gagal memperbarui status');
                    }
                });
            });
      
    </script>
</body>
</html>
