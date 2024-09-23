<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pengguna</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .header h1 {
      margin: 0;
      color: #333;
      font-size: 2em;
    }
    .btn-tambah {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1em;
      transition: background-color 0.3s;
    }
    .btn-tambah:hover {
      background-color: #0056b3;
    }
    .card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }
    .btn-edit {
      background-color: #ffc107;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 0.9em;
      margin-top: 10px;
    }
    .btn-delete {
      background-color: #dc3545; /* Warna merah */
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 0.9em;
      margin-top: 10px;
      margin-left: 10px; /* Spasi antara tombol edit dan delete */
    }
    .btn-delete:hover {
      background-color: #c82333; /* Warna merah lebih gelap saat hover */
    }
    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
      background-color: #fff;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 40%;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .form-group input {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }
    .btn-submit {
      background-color: #28a745;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1em;
      transition: background-color 0.3s;
    }
    .btn-submit:hover {
      background-color: #218838;
    }
    .no-data {
      text-align: center;
      color: #888;
      font-style: italic;
      margin-top: 20px;
    }
    .footer {
      text-align: center;
      color: #666;
      font-size: 0.8em;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Daftar Pengguna</h1>
      <button class="btn-tambah" id="openModal"><i class="fas fa-user-plus"></i> Tambah Pengguna</button>
    </div>
    
    <!-- Daftar Pengguna -->
    <?php if (!empty($manda)): ?>
      <?php foreach ($manda as $user): ?>
        <div class="card">
          <div class="card-content">
            <div><span>Username:</span> <?= htmlspecialchars($user['nama_user']) ?></div>
            <div><span>Email:</span> <?= htmlspecialchars($user['email']) ?></div>
            <div><span>No Telepon:</span> <?= htmlspecialchars($user['no_telp']) ?></div>
            <div><span>Role:</span> <?= htmlspecialchars($user['role']) ?></div>
            <div><span>Dibuat Pada:</span> <?= htmlspecialchars($user['created_at']) ?></div>
            <div><span>Diperbarui Pada:</span> <?= htmlspecialchars($user['updated_at']) ?></div>
            <button class="btn-edit" onclick="openEditModal(<?= htmlspecialchars(json_encode($user)) ?>)">Edit</button>
            <a href="<?= base_url('home/delete_users/'.htmlspecialchars($user['id_user'])) ?>"><button class="btn-delete">Hapus</button></a>
            
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="no-data">Tidak ada data pengguna tersedia</div>
    <?php endif; ?>
    
    <div class="footer">
      &copy; <?= date('Y') ?> Your Company. All rights reserved.
    </div>
  </div>
  
  <!-- Modal Form Tambah Pengguna -->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close" id="closeModal">&times;</span>
      <h2>Tambah Pengguna Baru</h2>
      <form action="aksi_tambah_user" method="POST">
        <div class="form-group">
          <label for="nama_user">Username</label>
          <input type="text" id="nama_user" name="nama_user" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="no_telp">No Telepon</label>
          <input type="text" id="no_telp" name="no_telp" required>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <input type="text" id="role" name="role" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
         <a href="<?= base_url('home/proses_tambah_user/'.htmlspecialchars($user['id_user'])) ?>"><button class="btn-submit">simpan</button></a>
      </form>
    </div>
  </div>

  <!-- Modal Form Edit Pengguna -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <span class="close" id="closeEditModal">&times;</span>
      <h2>Edit Pengguna</h2>
      <form action="aksi_edit_user" method="POST" id="editForm">
        <input type="hidden" id="edit_id" name="id">
        <div class="form-group">
          <label for="edit_nama_user">Username</label>
          <input type="text" id="edit_nama_user" name="nama_user" required>
        </div>
        <div class="form-group">
          <label for="edit_email">Email</label>
          <input type="email" id="edit_email" name="email" required>
        </div>
        <div class="form-group">
          <label for="edit_no_telp">No Telepon</label>
          <input type="text" id="edit_no_telp" name="no_telp" required>
        </div>
        <div class="form-group">
          <label for="edit_role">Role</label>
          <input type="text" id="edit_role" name="role" required>
        </div>
        <button type="submit" class="btn-submit">Simpan Perubahan</button>
      </form>
    </div>
  </div>

  <script>
    // JavaScript untuk modal
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("openModal");
    var span = document.getElementById("closeModal");
    var editModal = document.getElementById("editModal");
    var closeEditModal = document.getElementById("closeEditModal");

    btn.onclick = function() {
      modal.style.display = "block";
    }

    span.onclick = function() {
      modal.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
      if (event.target == editModal) {
        editModal.style.display = "none";
      }
    }

    function openEditModal(user) {
      document.getElementById('edit_id').value = user.id_user; // Ganti 'id_user' dengan nama kolom ID di database
      document.getElementById('edit_nama_user').value = user.nama_user;
      document.getElementById('edit_email').value = user.email;
      document.getElementById('edit_no_telp').value = user.no_telp;
      document.getElementById('edit_role').value = user.role;
      editModal.style.display = "block";
    }

    closeEditModal.onclick = function() {
      editModal.style.display = "none";
    }
var baseUrl = '<?= base_url(); ?>'; // Di dalam script PHP

    function confirmDelete(userId) {
  if (confirm("Apakah Anda yakin ingin menghapus pengguna ini?")) {
    window.location.href = `${baseUrl}home/delete_users/${userId}`;

  }
}

  </script>
</body>
</html>
