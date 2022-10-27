<?php

namespace App\Models;

use CodeIgniter\Model;

class DraftModel extends Model
{
    protected $table = 'draft';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['nip', 'judul', 'file_draft', 'status', 'catatan', 'id_pemeriksa', 'jenis', 'deleted_at'];

    public function getPemeriksa()
    {
        $builder = $this->db->table('user')->where('jobdesk', 'Pemeriksa');

        return $builder->get()->getResultArray();
    }

    public function getDekan()
    {
        $builder = $this->db->table('user')->groupStart()->where('jobdesk', 'Dekan')->where('fakultas', session('fakultas'))->groupEnd();

        return $builder->get()->getResultArray();
    }

    public function gettrash()
    {
        $builder = $this->join('user', 'user.nip = draft.nip')->groupStart()->where('draft.deleted_at!=', null)->where('draft.nip', session('nip'))->groupEnd();

        return $builder->get()->getResultArray();
    }

    public function getdraft()
    {
        $builder = $this->join('user', 'user.nip = draft.nip')->groupStart()->where('draft.deleted_at', null)->where('draft.nip', session('nip'))->groupEnd();

        return $builder->get()->getResultArray();
    }

    public function getdata()
    {
        $builder = $this->db->table('pemeriksa')->join('user', 'user.nip = pemeriksa.nip_pemeriksa');

        return $builder->get()->getResultArray();
    }

    public function input_pemeriksa($data)
    {
        return $this->db->table('pemeriksa')->insert($data);
    }

    public function getpending()
    {
        return $this->groupStart()->where('status', 'Pending')->where('nip', session('nip'))->groupEnd()->get()->getResultArray();
    }

    public function getreturn()
    {
        return $this->groupStart()->where('status', 'Return')->where('nip', session('nip'))->groupEnd()->get()->getResultArray();
    }
}
