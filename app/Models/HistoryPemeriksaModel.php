<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryPemeriksaModel extends Model
{
    protected $table = 'history_pemeriksa';
    protected $protectFields = false;
    protected $primaryKey = 'no';

    public function remove($id)
    {
        return $this->db->table('pemeriksa')->where('id_pemeriksa', $id)->delete();
    }

    public function getdata()
    {
        return $this->join('history_draft', 'history_draft.id_pemeriksa = history_pemeriksa.id_pemeriksa')
            ->join('user', 'user.nip = history_draft.nip')
            ->where('nip_pemeriksa', session('nip'))
            ->get()->getResultArray();
    }

    public function countapproved()
    {
        return $this->groupStart()->where('nip_pemeriksa', session('nip'))
            ->where('status_pemeriksa', "Approved")->groupEnd()
            ->get()->getResultArray();
    }

    public function countrejected()
    {
        return $this->groupStart()->where('nip_pemeriksa', session('nip'))
            ->where('status_pemeriksa', "Rejected")->groupEnd()
            ->get()->getResultArray();
    }
}
