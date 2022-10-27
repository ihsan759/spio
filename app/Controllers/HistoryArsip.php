<?php

namespace App\Controllers;

use App\Models\ArsipModel;
use App\Models\HistoryArsipModel;

class HistoryArsip extends BaseController
{
    protected $HistoryArsipModel;
    protected $ArsipModel;
    public function __construct()
    {
        $this->HistoryArsipModel = new HistoryArsipModel();
        $this->ArsipModel = new ArsipModel();
    }

    public function Input($id)
    {
        if (session('jobdesk') != 'SPIO') {
            return redirect()->to(site_url('/home'));
        }
        $arsip = $this->ArsipModel->find($id);
        $this->HistoryArsipModel->save([
            'judul' => $arsip['judul'],
            'jenis' => $arsip['jenis'],
            'file_arsip' => $arsip['file_arsip'],
            'tgl_kerjasama' => $arsip['tgl_kerjasama'],
            'tgl_kadaluarsa' => $arsip['tgl_kadaluarsa'],
            'catatan' => $arsip['catatan'],
            'created_at' => date("Y-m-d h:i:s"),
            'nip' => $arsip['nip']
        ]);
        $this->HistoryArsipModel->input($id);
        return redirect()->to('/Arsip/History')->with('success', 'Berhasil memasukkan data kedalam history');
    }

    public function index()
    {
        if (session('jobdesk') != 'SPIO') {
            return redirect()->to(site_url('/home'));
        }
        $arsip = $this->HistoryArsipModel->gethistory();
        $data = [
            'title' => 'History Arsip',
            'arsip' => $arsip
        ];
        return view('SPIO/Arsip/historyarsip', $data);
    }
}
