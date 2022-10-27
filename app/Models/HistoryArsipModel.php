<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryArsipModel extends Model
{
    protected $table = 'history_arsip';
    protected $protectFields = false;

    public function input($id)
    {
        return $this->db->table('arsip')->where('id', $id)->delete();
    }

    public function gethistory()
    {
        return $this->select('id, judul, jenis,  history_arsip.created_at, tgl_kerjasama, tgl_kadaluarsa, catatan, file_arsip, datediff(tgl_kadaluarsa,tgl_kerjasama) AS selisih, nama')->join('user', 'user.nip = history_arsip.nip')->get()->getResultArray();
    }
}
