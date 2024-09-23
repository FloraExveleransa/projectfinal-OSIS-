<?php namespace App\Models;

use CodeIgniter\Model;

class M_lpj extends Model
{
    // Define table and primary key
    protected $table = 'lpj_kegiatan'; // Nama tabel
    protected $primaryKey = 'id_lpj_kegiatan'; // Primary key tabel, sesuaikan dengan yang ada di tabel Anda

    // Define allowed fields
    protected $allowedFields = [
        'kegiatan', 'tanggal_kegiatan', 'situs_kegiatan',
        'tempat_kegiatan', 'penyelenggara', 'keterangan',
        'jam_mulai', 'jam_selesai', 'dana_keluar',
        'submitted_by' // Tambahkan field yang diperlukan
    ];

    // Function to retrieve all data from a specified table
    public function tampil($tabel)
    {
        try {
            return $this->db->table($tabel)
                            ->get()
                            ->getResultArray(); // Changed to getResultArray for consistency
        } catch (\Exception $e) {
            log_message('error', 'Error fetching data from table: ' . $e->getMessage());
            return false;
        }
    }

    public function tampil3()
    {
        return $this->db->table($this->table)
            ->select('lpj_kegiatan.*, kegiatan.nama_kegiatan, users.nama_user as nama_penyelenggara')
            ->join('kegiatan', 'lpj_kegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left')
            ->join('users', 'lpj_kegiatan.submitted_by = users.id_user', 'left')
            ->get()
            ->getResultArray();
    }

    public function tampil1()
    {
        return $this->db->table($this->table)
            ->select('lpj_kegiatan.*, users.nama_user as nama_penyelenggara')
            ->join('users', 'lpj_kegiatan.submitted_by = users.id_user', 'left')
            ->get()
            ->getResultArray();
    }

    // Function to perform a join between two tables
    // public function join($tabel, $tabel2, $on)
    // {
    //     try {
    //         return $this->db->table($tabel)
    //                         ->join($tabel2, $on, 'left')
    //                         ->get()
    //                         ->getResultArray();
    //     } catch (\Exception $e) {
    //         log_message('error', 'Error performing join operation: ' . $e->getMessage());
    //         return false;
    //     }
    // }

    
public function join($tabel, $tabel2, $on)
{
    try {
        $query = $this->db->table($tabel)
                          ->join($tabel2, $on, 'left')
                          ->get();

        if (!$query) {
            log_message('error', 'Query failed for table: ' . $tabel);
            return false;
        }

        return $query->getResultArray();
    } catch (\Exception $e) {
        log_message('error', 'Error performing join operation: ' . $e->getMessage());
        return false;
    }
}

    // Function to get levels (example use-case)
    public function getLevels()
    {
        try {
            return $this->db->table('level')->select('id_level, nama_level')->get()->getResultArray();
        } catch (\Exception $e) {
            log_message('error', 'Error fetching levels: ' . $e->getMessage());
            return false;
        }
    }

    // Function to count all rows in a table
    public function countAll($table)
    {
        try {
            return $this->db->table($table)->countAllResults();
        } catch (\Exception $e) {
            log_message('error', 'Error counting rows in table: ' . $e->getMessage());
            return false;
        }
    }

    // Function to perform a join and apply a where condition
    public function joinWhere($tabel, $tabel2, $on, $where)
    {
        try {
            return $this->db->table($tabel)
                            ->join($tabel2, $on, 'left')
                            ->getWhere($where)
                            ->getRowArray();
        } catch (\Exception $e) {
            log_message('error', 'Error performing join with where condition: ' . $e->getMessage());
            return false;
        }
    }

    public function getWhere($tabel, $where)
    {
        $query = $this->db->table($tabel)
                          ->getWhere($where);

        if (!$query) {
            log_message('error', 'Query failed for table: ' . $tabel);
            return false;
        }

        return $query->getRow();
    }

    // Function to get multiple rows based on where condition
    public function getWheres($tabel, $where)
    {
        try {
            $query = $this->db->table($tabel)->getWhere($where);
            if ($query === false) {
                log_message('error', 'Query failed for table: ' . $tabel);
                return false;
            }
            return $query->getResultArray();
        } catch (\Exception $e) {
            log_message('error', 'Error fetching rows with where condition: ' . $e->getMessage());
            return false;
        }
    }

    // Function to insert data into a table
    public function tambah($tabel, $isi)
    {
        try {
            return $this->db->table($tabel)->insert($isi);
        } catch (\Exception $e) {
            log_message('error', 'Error inserting data into table: ' . $e->getMessage());
            return false;
        }
    }
 public function update_user($id, $data) 
{
    // Pastikan data tidak kosong sebelum melanjutkan
    if (empty($data)) {
        throw DataException::forEmptyDataset('update');
    }

    // Update data berdasarkan ID
    return $this->db->table('users')->update($data, ['id_user' => $id]);
}

    // Function to update data in a table
    public function edit($tabel, $isi, $where)
    {
        try {
            return $this->db->table($tabel)->update($isi, $where);
        } catch (\Exception $e) {
            log_message('error', 'Error updating data in table: ' . $e->getMessage());
            return false;
        }
    }

    public function getPost($fields)
    {
        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $this->request->getPost($field);
        }
        return $data;
    }

    public function hapus($table, $where) {
    return $this->db->table($table)->where($where)->delete();
}

    // Function to insert user data (specific to 'users' table)
    public function insert_user($data)
    {
        try {
            return $this->db->table('users')->insert($data);
        } catch (\Exception $e) {
            log_message('error', 'Error inserting user data: ' . $e->getMessage());
            return false;
        }
    }

    public function get_user_by_id($userId)
    {
        try {
            $query = $this->db->table('users')->where('id_user', $userId)->get();
            return $query->getRow();
        } catch (\Exception $e) {
            log_message('error', 'Error fetching user data by ID: ' . $e->getMessage());
            return false;
        }
    }

    // Function to get all users (specific to 'users' table)
    public function get_all_users()
    {
        try {
            return $this->db->table('users')->get()->getResultArray();
        } catch (\Exception $e) {
            log_message('error', 'Error fetching all users: ' . $e->getMessage());
            return false;
        }
    }

    public function getAllKegiatan()
    {
        return $this->findAll();
    }

    public function getKegiatanById($id)
    {
        return $this->where('id_kegiatan', $id)->first();
    }

    public function getKegiatanWithUser()
    {
        return $this->select('kegiatan.*, users.nama_user as created_by_name')
                    ->join('users', 'kegiatan.created_by = users.id_user', 'left')
                    ->findAll();
    }

    public function getAllData()
    {
        return $this->findAll();
    }

    public function getDataByBulan($bulan)
    {
        return $this->where('MONTH(tanggal_kegiatan)', $bulan)
                    ->findAll();
    }

    public function filterByMonth($bulan)
    {
        return $this->where('MONTH(tanggal_kegiatan)', $bulan)
                    ->findAll();
    }
 public function tampil5($table)
    {
        return $this->db->table($table)->get()->getResultArray();
    }
  public function getKegiatanDetails()
{
    return $this->db->table('lpj_kegiatan')
                    ->select('lpj_kegiatan.*, kegiatan.nama_kegiatan, users.nama_user as nama_penyelenggara')
                    ->join('kegiatan', 'lpj_kegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left')
                    ->join('users', 'lpj_kegiatan.submitted_by = users.id_user', 'left')
                    ->get()
                    ->getResultArray();
}

}
