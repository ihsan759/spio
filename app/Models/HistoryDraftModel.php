<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryDraftModel extends Model
{
    protected $table = 'history_draft';
    protected $protectFields = false;

    public function remove($id)
    {
        return $this->db->table('draft')->where('id', $id)->delete();
    }

    public function getdata()
    {
        return $this->db->table('history_pemeriksa')->join('user', 'user.nip = history_pemeriksa.nip_pemeriksa')->get()->getResultArray();
    }

    public function getdataspio()
    {
        return $this->join('user', 'user.nip = history_draft.nip')
            ->where('jobdesk', 'Administrasi')
            ->get()->getResultArray();
    }

    public function getapproved()
    {
        return $this->groupStart()->where('status', 'Approved')->where('nip', session('nip'))->groupEnd()->get()->getResultArray();
    }

    public function getrejected()
    {
        return $this->groupStart()->where('status', 'Rejected')->where('nip', session('nip'))->groupEnd()->get()->getResultArray();
    }
}
