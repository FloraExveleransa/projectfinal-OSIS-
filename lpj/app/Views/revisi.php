<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Revisi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            margin-top: 20px;
        }
        .file-link {
            display: block;
            margin-bottom: 10px;
        }
        .btn-update {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Halaman Revisi Laporan</h2>

        <!-- Notification -->
        <?php if (session()->getFlashdata('status')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('status') ?>
            </div>
        <?php endif; ?>

        <!-- Update Proposal -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Update Proposal</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('revisi/updateProposal') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kegiatan">Pilih Kegiatan</label>
                        <select class="form-control" id="kegiatan" name="id" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            <?php foreach ($files as $fileItem): ?>
                                <option value="<?= esc($fileItem['id_mskdata']) ?>">
                                    <?= esc($fileItem['kegiatan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="proposal">Update Proposal</label>
                        <input type="file" class="form-control-file" name="proposal">
                        <small class="form-text text-muted">Unggah file PDF untuk proposal yang telah direvisi. Maksimal ukuran file adalah 5MB.</small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-update">Ganti Proposal</button>
                </form>
            </div>
        </div>

        <!-- Update LPJ -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Update LPJ</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('revisi/updateLpj') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kegiatanLpj">Pilih Kegiatan</label>
                        <select class="form-control" id="kegiatanLpj" name="id" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            <?php foreach ($files as $fileItem): ?>
                                <option value="<?= esc($fileItem['id_kegiatan']) ?>">
                                    <?= esc($fileItem['nama_kegiatan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="laporan">Update LPJ</label>
                        <input type="file" class="form-control-file" name="laporan">
                        <small class="form-text text-muted">Unggah file PDF untuk LPJ yang telah direvisi. Maksimal ukuran file adalah 5MB.</small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-update">Ganti LPJ</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
