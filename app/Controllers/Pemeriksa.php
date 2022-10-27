<?php

namespace App\Controllers;

use App\Models\DraftModel;
use App\Models\HistoryDraftModel;
use App\Models\HistoryPemeriksaModel;
use App\Models\PemeriksaModel;
use App\Models\SPIOPemeriksaModel;

class Pemeriksa extends BaseController
{
    protected $PemeriksaModel;
    protected $SPIOPemeriksaModel;
    protected $DraftModel;
    protected $HistoryPemeriksaModel;
    protected $HistoryDraftModel;

    public function __construct()
    {
        $this->DraftModel = new DraftModel();
        $this->PemeriksaModel = new PemeriksaModel();

        // SPIO Pemeriksa
        $this->HistoryPemeriksaModel = new HistoryPemeriksaModel();
        $this->SPIOPemeriksaModel = new SPIOPemeriksaModel();
        $this->HistoryDraftModel = new HistoryDraftModel();
    }

    public function index()
    {
        if (session('jobdesk') == 'Pemeriksa' || session('jobdesk') == 'Dekan') {
            $draft = $this->PemeriksaModel->getdata();
            $data = [
                'title' => 'Lihat Draft',
                'draft' => $draft
            ];
            return view('Pemeriksa/Draft/index.php', $data);
        } elseif (session('jobdesk') == 'SPIO') {
            $draft = $this->SPIOPemeriksaModel->getdata();
            $data = [
                'title' => 'Lihat Draft',
                'draft' => $draft
            ];
            return view('SPIO/Pemeriksa/lihatdraft.php', $data);
        }
    }

    public function update()
    {
        if (!$this->validate([
            'file' => [
                'rules' => 'uploaded[file]|ext_in[file,pdf,docx]',
                'errors' => [
                    'uploaded' => 'File Draft harus diisi.',
                    'ext_in' => 'Hanya menerima file dengan extensi pdf,docx'
                ]
            ],
            'status_pemeriksa' => [
                'rules' => 'required'
            ]

        ])) {
            return redirect()->to('/Pemeriksa/Index')->with('warning', 'Silahkan ubah status kembali dan pastikan anda mengisinya sesuai keterangan yang tertera');
        }
        $id = $this->request->getVar('id');
        $id_pemeriksa = $this->request->getVar('id_pemeriksa');
        $tanggal = date("Y-m-d");
        $status = $this->request->getVar('status_pemeriksa');
        if (session('jobdesk') != 'SPIO') {
            $file = $this->request->getFile('file');
            $file->move('file/draft/Pemeriksa');
            $filename = $file->getName();
            $this->PemeriksaModel->save([
                'no' => $this->request->getVar('no'),
                'file' => $filename,
                'status_pemeriksa' => $status,
                'tgl_ubah_status' => $tanggal,
                'catatan_pemeriksa' => $this->request->getVar('catatanpemeriksa')
            ]);
            if (session('jobdesk') != 'Dekan') {
                $count = count($this->PemeriksaModel->countdata($id_pemeriksa, $status));
                if ($count == 0) {
                    $this->DraftModel->save([
                        'id' => $id,
                        'status' => $status
                    ]);
                }
            } else {
                if ($status == 'Rejected') {
                    $this->DraftModel->save([
                        'id' => $id,
                        'status' => $status
                    ]);
                }
            }
            return redirect()->to('/Pemeriksa/Index')->with('success', 'Anda berhasil Mengubah Status');
        } else {
            $file = $this->request->getFile('file');
            $file->move('file/draft');
            $filename = $file->getName();
            $this->DraftModel->save([
                'id' => $id,
                'status' => $status,
                'file_draft' => $filename
            ]);
            if ($status == 'Approved' || $status == 'Rejected') {
                $drafts = $this->DraftModel->where('id', $id)->findAll();
                $id_pemeriksa;
                foreach ($drafts as $draft) {
                    $this->HistoryDraftModel->save([
                        'judul' => $draft['judul'],
                        'jenis' => $draft['jenis'],
                        'created_at' => date("Y-m-d h:i:s"),
                        'status' => $draft['status'],
                        'file_draft' => $draft['file_draft'],
                        'id_pemeriksa' => $draft['id_pemeriksa'],
                        'nip' => $draft['nip']
                    ]);
                    $id_pemeriksa = $draft['id_pemeriksa'];
                }
                $pemeriksa = $this->PemeriksaModel->where('id_pemeriksa', $id_pemeriksa)->findAll();
                foreach ($pemeriksa as $pemeriksa) {
                    $this->HistoryPemeriksaModel->save([
                        'id_pemeriksa' => $pemeriksa['id_pemeriksa'],
                        'status_pemeriksa' => $pemeriksa['status_pemeriksa'],
                        'nip_pemeriksa' => $pemeriksa['nip_pemeriksa'],
                        'file' => $pemeriksa['file'],
                        'tgl_ubah_status' => $pemeriksa['tgl_ubah_status']
                    ]);
                }
                $this->HistoryPemeriksaModel->remove($id_pemeriksa);
                $this->HistoryDraftModel->remove($id);
            }
            return redirect()->to('/Pemeriksa/Index')->with('success', 'Anda berhasil Mengubah Status');
        }
    }
}
