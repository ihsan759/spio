<?php

namespace App\Models;

use CodeIgniter\Model;

class SPIOPemeriksaModel extends Model
{
    protected $table = 'draft';
    protected $allowedFields = ['status'];
    protected $primaryKey = 'id';

    public function getdata()
    {
        return $this->join('pemeriksa', 'draft.id_pemeriksa = pemeriksa.id_pemeriksa')
            ->join('user', 'user.nip = draft.nip')
            ->groupStart()
            ->where('status_pemeriksa', 'Approved')
            ->where('roles', 'Dekan')
            ->groupEnd()
            ->get()->getResultArray();
    }
}
