<?php

namespace App\Controllers;

use App\Models\DraftModel;
use App\Models\HistoryDraftModel;
use App\Models\HistoryPemeriksaModel;
use App\Models\PemeriksaModel;

class HistoryDraft extends BaseController
{
    protected $HistoryDraftModel;
    protected $DraftModel;
    protected $HistoryPemeriksaModel;
    protected $PemeriksaModel;
    public function __construct()
    {
        $this->HistoryPemeriksaModel = new HistoryPemeriksaModel();
        $this->HistoryDraftModel = new HistoryDraftModel();
        $this->DraftModel = new DraftModel();
        $this->PemeriksaModel = new PemeriksaModel();
    }

    public function Input($id)
    {
        if (session('jobdesk') == 'SPIO' || session('jobdesk') == 'Administrasi') {
            $draft = $this->DraftModel->find($id);
            $this->HistoryDraftModel->save([
                'judul' => $draft['judul'],
                'jenis' => $draft['jenis'],
                'created_at' => date("Y-m-d h:i:s"),
                'status' => $draft['status'],
                'file_draft' => $draft['file_draft'],
                'id_pemeriksa' => $draft['id_pemeriksa'],
                'nip' => $draft['nip']
            ]);
            $pemeriksa = $this->PemeriksaModel->where('id_pemeriksa', $draft['id_pemeriksa'])->findAll();
            foreach ($pemeriksa as $pemeriksa) {
                $this->HistoryPemeriksaModel->save([
                    'id_pemeriksa' => $pemeriksa['id_pemeriksa'],
                    'status_pemeriksa' => $pemeriksa['status_pemeriksa'],
                    'nip_pemeriksa' => $pemeriksa['nip_pemeriksa'],
                    'file' => $pemeriksa['file'],
                    'tgl_ubah_status' => $pemeriksa['tgl_ubah_status']
                ]);
            }
            $this->HistoryPemeriksaModel->remove($draft['id_pemeriksa']);
            $this->HistoryDraftModel->remove($id);
            return redirect()->to('/Draft/History')->with('success', 'Berhasil memasukkan data kedalam history');
        }
    }

    public function index()
    {
        if (session('jobdesk') == 'SPIO') {
            $draft = $this->HistoryDraftModel->where('nip', session('nip'))->findAll();
            $pemeriksa = $this->HistoryDraftModel->getdata();
            $data = [
                'title' => 'History Draft',
                'draft' => $draft,
                'pemeriksa' => $pemeriksa
            ];
            return view('SPIO/Draft/historydraft', $data);
        } elseif (session('jobdesk') == 'Administrasi') {
            $draft = $this->HistoryDraftModel->where('nip', session('nip'))->get()->getResultArray();
            $pemeriksa = $this->HistoryDraftModel->getdata();
            $data = [
                'title' => 'History Draft',
                'draft' => $draft,
                'pemeriksa' => $pemeriksa
            ];
            return view('Fakultas/Draft/historydraft', $data);
        }
    }
}
