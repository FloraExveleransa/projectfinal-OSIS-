<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pengguna</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #333;
      text-align: center;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #333;
    }
    .form-group input {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    .btn {
      background-color: #007bff;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Edit Data Pengguna</h1>
    <form action="/user/update" method="POST">
      <div class="form-group">
        <label for="nama_user">Nama User</label>
        <input type="text" id="nama_user" name="nama_user" value="<?= esc($user['nama_user']) ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= esc($user['email']) ?>" required>
      </div>
      <div class="form-group">
        <label for="no_telp">Nomor Telepon</label>
        <input type="text" id="no_telp" name="no_telp" value="<?= esc($user['no_telp']) ?>" required>
      </div>
      <div class="form-group">
        <label for="role">Jabatan</label>
        <input type="text" id="role" name="role" value="<?= esc($user['role']) ?>" required>
      </div>
      <button type="submit" class="btn">Simpan Perubahan</button>
    </form>
  </div>
</body>
</html>
