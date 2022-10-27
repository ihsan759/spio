<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeriksaModel extends Model
{
    protected $table = 'pemeriksa';
    protected $allowedFields = ['status_pemeriksa', 'file', 'tgl_ubah_status', 'catatan_pemeriksa'];
    protected $primaryKey = 'no';

    public function getdata()
    {
        return $this->join('draft', 'draft.id_pemeriksa = pemeriksa.id_pemeriksa')
            ->join('user', 'user.nip = draft.nip')
            ->where('nip_pemeriksa', session('nip'))
            ->get()->getResultArray();
    }

    public function countdata($id, $status)
    {
        return $this->groupStart()->where('id_pemeriksa', $id)
            ->where('status_pemeriksa!=', $status)->groupEnd()
            ->get()->getResultArray();
    }

    public function countnew()
    {
        return $this->groupStart()->where('nip_pemeriksa', session('nip'))
            ->where('status_pemeriksa', "Pending")->groupEnd()
            ->get()->getResultArray();
    }

    public function countreturn()
    {
        return $this->groupStart()->where('nip_pemeriksa', session('nip'))
            ->where('status_pemeriksa', "Return")->groupEnd()
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
