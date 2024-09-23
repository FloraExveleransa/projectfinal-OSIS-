<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\M_lpj;
use CodeIgniter\I18n\Time;
class Home extends BaseController
{
	public function index()
	{
		return view('header');
		return view('footer');
	}
     public function login()
    {

        return view('login');
    }
    public function aksi_login()
    {
        $session = session();
        $model = new M_lpj();
        
        $nama_user = $this->request->getPost('nama_user');
        $password = $this->request->getPost('password');

               $where = [
            'nama_user'   => $nama_user,
            'password'  => $password
        ];
        $data = $model->getWhere('users', $where);
        
    if ($data > 0) {  // Menggunakan perbandingan biasa untuk teks biasa
        $ses_data = [
            'id_user'   => $data->id_user,
            'nama_user'  => $data->nama_user,
            
            'logged_in' => TRUE
        ];
        $session->set($ses_data);
        return redirect()->to('/home/dashboard');
    } else {
        $session->setFlashdata('msg', 'Password salah');
        return redirect()->to('home/login');
    }

    }
    public function update_status()
{
    $id_lpj = $this->input->post('id_lpj');
    $type = $this->input->post('type');
    $value = $this->input->post('value');

    // Update specific status in database based on type
    if ($type == 'kesiswaan') {
        $this->lpj_model->update_status($id_lpj, ['status_kesiswaan' => $value]);
    } elseif ($type == 'kepala_sekolah') {
        $this->lpj_model->update_status($id_lpj, ['status_kepala_sekolah' => $value]);
    } elseif ($type == 'yayasan') {
        $this->lpj_model->update_status($id_lpj, ['status_yayasan' => $value]);
    }

    // Check if all statuses are "Disetujui" or "Ditolak"
    $lpj = $this->lpj_model->get_lpj_by_id($id_lpj);

    if ($lpj['status_kesiswaan'] == 'Disetujui' && $lpj['status_kepala_sekolah'] == 'Disetujui' && $lpj['status_yayasan'] == 'Disetujui') {
        $this->lpj_model->update_status($id_lpj, ['status_lpj' => 'Disetujui']);
    } elseif ($lpj['status_kesiswaan'] == 'Ditolak' && $lpj['status_kepala_sekolah'] == 'Ditolak' && $lpj['status_yayasan'] == 'Ditolak') {
        $this->lpj_model->update_status($id_lpj, ['status_lpj' => 'Ditolak']);
    }

    echo 'success';
}

    
    public function mskdata() 
    {
        if (session()->get('level') > 0) { 
            $model = new M_lpj();
            $data['manda'] = $model->tampil('mskdata'); 

            echo view('header', $data);
            echo view('kegiatan', $data);
            
        } else {
            return redirect()->to('home/login');
        }
    }
	public function dashboard() 
{
    $model = new M_lpj();
    $data['manda'] = $model->tampil('lpj_kegiatan'); // Fetch data from model

    echo view('header');
    echo view('dashboard', $data); // Pass data to the view
    echo view('footer');
}
 public function kegiatan() 
{
    $model = new M_lpj();
    $data['kegiatan'] = $model->tampil('mskdata'); // Fetch data from model

    echo view('header');
    echo view('kegiatan', $data); // Pass data to the view
    
}
public function aksi_tkegiatan()
{
    // Cek jika user terautentikasi
    // if (session()->get('level') > 0) {
        $model = new M_lpj();
        
        // Ambil data dari formulir
        $kegiatan = $this->request->getPost('kegiatan');
        $tgl_kegiatan = $this->request->getPost('tgl_kegiatan');
        $situasi_kegiatan = $this->request->getPost('situasi_kegiatan');
        $tempat_kegiatan = $this->request->getPost('tempat_kegiatan');
        $penyelenggara = $this->request->getPost('penyelenggara');
        $keterangan = $this->request->getPost('keterangan');
        $jam_mulai = $this->request->getPost('jam_mulai');
        $jam_selesai = $this->request->getPost('jam_selesai');
        $dana_keluar = $this->request->getPost('dana_keluar');
        
        // Proses upload file
        $proposal = $this->request->getFile('proposal');
        $proposalPath = '';

        if ($proposal->isValid() && !$proposal->hasMoved()) {
            $proposalPath = 'img/' . $proposal->getRandomName(); // Ganti dengan path sesuai kebutuhan
            $proposal->move('C:\lpj\lpj\public\img', $proposalPath);
        }

        // Siapkan data untuk disimpan
        $isi = array(
            'kegiatan' => $kegiatan,
            'tgl_kegiatan' => $tgl_kegiatan,
            'situasi_kegiatan' => $situasi_kegiatan,
            'tempat_kegiatan' => $tempat_kegiatan,
            'penyelenggara' => $penyelenggara,
            'keterangan' => $keterangan,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'dana_keluar' => $dana_keluar,
            'proposal' => $proposalPath, // Path file proposal
        );

        // Simpan data ke dalam tabel
        $model->tambah('kegiatan', $isi);
        return redirect()->to('home/kegiatan'); // Ganti dengan URL yang sesuai
    // } else {
    //     return redirect()->to('home/login');
    // }
}

        

public function pengajuan() 
{
    $model = new M_lpj();
    $data['kegiatan'] = $model->tampil('lpj_kegiatan'); // Fetch data from model

    echo view('header');
    echo view('pengajuan', $data); // Pass data to the view
    echo view('footer');
}
public function revisi() 
{
    $model = new M_lpj();
    $data['files'] = $model->tampil('mskdata'); // Fetch data from model

$data['fileItem'] = $model->tampil('lpj_kegiatan'); // Fetch data from model
    echo view('header');
    echo view('revisi', $data); // Pass data to the view
  
}

public function updateProposal() 
{
    $id = $this->request->getPost('id');
    $file = $this->request->getFile('proposal');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move('C:\lpj\lpj\public\img', $newName);

        // Update database record for proposal
        $model = new M_lpj();
        $model->update($id, ['proposal' => $newName]);

        return redirect()->to(base_url('revisi'))->with('status', 'Proposal berhasil diperbarui!');
    }

    return redirect()->to(base_url('revisi'))->with('status', 'Gagal memperbarui proposal!');
}

public function updateLpj() 
{
    $id = $this->request->getPost('id');
    $file = $this->request->getFile('laporan');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move('C:\lpj\lpj\public\img', $newName);

        // Update database record for LPJ
        $model = new M_lpj();
        $model->update($id, ['laporan' => $newName]);

        return redirect()->to(base_url('revisi'))->with('status', 'LPJ berhasil diperbarui!');
    }

    return redirect()->to(base_url('revisi'))->with('status', 'Gagal memperbarui LPJ!');
}

  


public function lpj() 
{
    $model = new M_lpj();
    $data['kegiatan'] = $model->getKegiatanDetails(); // Fetch data using the new method in the model

    echo view('header');
    echo view('lpj', $data); // Pass data to the view
    echo view('footer');
}
public function delete_lpj($id) {
    $model = new M_lpj;
    $where = array('id_lpj_kegiatan' => $id);
    $deleted = $model->hapus('lpj_kegiatan', $where);
    
    if ($deleted) {
        return redirect()->to('home/lpj');
    } else {
        echo "Failed to delete lpj_kegiatan."; // Debugging jika gagal
    }
}

public function proposal() 
{
    $model = new M_lpj();
    $data['kegiatan'] = $model->tampil('mskdata'); // Fetch data from model

    echo view('header');
    echo view('proposal', $data); // Pass data to the view

}
 public function review() 
{
    $model = new M_lpj();
    $data['manda'] = $model->tampil('lpj_kegiatan'); // Fetch data from model
 


    echo view('header');
    echo view('review', $data); // Pass data to the view
    echo view('footer');
}
 public function rev() 
{
    $model = new M_lpj();
    
    $data['manda'] = $model->tampil('mskdata'); // Fetch data from model


    echo view('header');
    echo view('rev', $data); // Pass data to the view
    echo view('footer');
}
public function user() 
{
    $model = new M_lpj(); // Model yang sesuai untuk mengambil data pengguna
    $data['manda'] = $model->tampil('users'); // Fetch data dari model

    echo view('header');
    echo view('user', $data); // Kirim data ke view
   
}
public function euser($id)
{
    $model = new M_lpj(); // Inisialisasi model
    $data['user'] = $model->find($id); // Ambil data pengguna berdasarkan ID

    if (empty($data['user'])) {
        // Jika pengguna tidak ditemukan, redirect atau tampilkan pesan error
        return redirect()->to('/user')->with('error', 'Pengguna tidak ditemukan.');
    }

    // Kembalikan data pengguna ke view untuk ditampilkan di modal
    echo json_encode($data['user']);
}

public function aksi_edit_user() 
{
    // Ambil data dari request
    $id = $this->request->getPost('id'); 
    $data = [
        'nama_user' => $this->request->getPost('nama_user'),
        'email' => $this->request->getPost('email'),
        'no_telp' => $this->request->getPost('no_telp'),
        'role' => $this->request->getPost('role'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    // Debugging
    log_message('info', 'Data yang akan diupdate: ' . print_r($data, true));

    if (!empty($data['nama_user']) || !empty($data['email']) || !empty($data['no_telp']) || !empty($data['role'])) {
        $model = new M_lpj();
        $model->update_user($id, $data); 
        return redirect()->to('home/user'); 
    } else {
        session()->setFlashdata('error', 'Data tidak valid untuk diperbarui.');
        return redirect()->back();
    }
}
public function delete_users($id) {
    $model = new M_lpj;
    $where = array('id_user' => $id);
    $deleted = $model->hapus('users', $where);
    
    if ($deleted) {
        return redirect()->to('home/user');
    } else {
        echo "Failed to delete user."; // Debugging jika gagal
    }
}


public function proses_tambah_user() 
{
    // Cek apakah permintaan menggunakan metode POST
    if ($this->request->getMethod() === 'post') {
        // Ambil data dari input
        $nama_user = $this->request->getPost('nama_user');
        $email = $this->request->getPost('email');
        $no_telp = $this->request->getPost('no_telp');
        $role = $this->request->getPost('role');
        $password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT); // Enkripsi password

        // Validasi input (bisa disesuaikan dengan kebutuhan)
        if (!empty($nama_user) && !empty($email) && !empty($no_telp) && !empty($role) && !empty($password)) {
            $model = new M_lpj(); // Model yang sesuai untuk mengelola pengguna

            // Siapkan data untuk disimpan
            $data = [
                'nama_user' => $nama_user,
                'email' => $email,
                'no_telp' => $no_telp,
                'role' => $role,
                'password' => $password,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Proses penyimpanan ke dalam database
            if ($model->tambah('users', $data)) {
                return redirect()->to('/home')->with('status', 'User berhasil ditambahkan.');
            } else {
                return redirect()->to('/home')->with('status', 'Gagal menambahkan user.');
            }
        } else {
            return redirect()->to('/home')->with('status', 'Semua field harus diisi.');
        }
    }

    // Jika bukan metode POST, redirect ke halaman utama
    return redirect()->to('/home');
}
public function aksi_tambah_user()
{
    $validation = \Config\Services::validation();

    // Aturan validasi
    $validation->setRules([
        'nama_user' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email',
        'no_telp' => 'required|min_length[10]|max_length[15]',
        'role' => 'required',
        'password' => 'required|min_length[6]'
    ]);

    // Cek validasi
    if (!$this->validate($validation->getRules())) {
        return redirect()->to('home/user')->withInput()->with('errors', $validation->getErrors());
    }

    // Ambil data dari form
    $data = [
        'nama_user' => $this->request->getPost('nama_user'),
        'email' => $this->request->getPost('email'),
        'no_telp' => $this->request->getPost('no_telp'),
        'role' => $this->request->getPost('role'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    // Load model
    $model = new M_lpj;

    // Tambah data ke database
    $model->db->table('users')->tambah($data);

    // Redirect setelah berhasil
    return redirect()->to('home/user')->with('success', 'Pengguna berhasil ditambahkan.');
}

 public function edit()
    {
          // Ambil data user dari session
    $model = new M_lpj();
    $data['user'] = $model->get_user_by_id(session()->get('id_user'));

    // Tampilkan view
    echo view('header', $data); // Menutup dengan titik koma

    return view('edit', $data); // Return tampilan edit

    }
   public function activity(){
    $model = new M_lpj();
    $where = array('id_mskdata' => 2);
    $data['login'] = $model->getwhere('mskdata',$where);
    $data['login'] = $model->join('activity','users','activity.id_user = users.id_users');
  
    echo view('header',$data);
    echo view('activity', $data);
}
 public function logout()
    {
        $model = new M_lpj();
        $where = ['id_user' => session()->get('id_user')];

    $isi = [
        'logout_time' => date('Y-m-d H:i:s')
    ];
        // $model->edit('hs_login', $isi, $where);
        // session()->destroy();
        return redirect()->to('home/login');
    }


public function update()
{
    $model = new M_lpj();

    // Ambil data dari form
    $data = [
        'nama_user' => $this->request->getPost('nama_user'),
        'email' => $this->request->getPost('email'),
        'no_telp' => $this->request->getPost('no_telp'),
        'role' => $this->request->getPost('role'),
    ];

    // Update data user
    $id = session()->get('id_user'); // Bisa juga $this->request->getPost('id_user')
    $model->update_user($id, $data);

    // Redirect kembali ke halaman pengguna atau halaman sukses
    return redirect()->to('/user/list')->with('status', 'Data pengguna berhasil diperbarui!');
}

}
