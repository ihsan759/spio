<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipModel extends Model
{
    protected $table = 'arsip';
    protected $allowedFields = ['nip', 'tgl_kerjasama', 'tgl_kadaluarsa', 'jenis', 'judul', 'file_arsip', 'catatan', 'deleted_at'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    public function getarsip()
    {
        return $this->select('id, judul, jenis, arsip.created_at, tgl_kerjasama, tgl_kadaluarsa, catatan, file_arsip,  datediff(tgl_kadaluarsa,tgl_kerjasama) AS selisih, nama')->join('user', 'user.nip = arsip.nip')->groupStart()->where('arsip.deleted_at', null)->where('arsip.nip', session('nip'))->groupEnd()->get()->getResultArray();
    }

    public function gettrash()
    {
        return $this->select('id, judul, jenis, arsip.created_at, tgl_kerjasama, tgl_kadaluarsa, catatan, file_arsip, arsip.deleted_at,  datediff(tgl_kadaluarsa,tgl_kerjasama) AS selisih, nama')->join('user', 'user.nip = arsip.nip')->groupStart()->where('arsip.deleted_at !=', null)->where('arsip.nip', session('nip'))->groupEnd()->get()->getResultArray();
    }
}
