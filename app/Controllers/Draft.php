<?php

namespace App\Controllers;

use App\Models\DraftModel;
use App\Models\HistoryDraftModel;
use App\Models\HistoryPemeriksaModel;

class Draft extends BaseController
{
    protected $DraftModel;
    protected $HistoryDraftModel;
    protected $HistoryPemeriksaModel;
    public function __construct()
    {
        $this->HistoryPemeriksaModel = new HistoryPemeriksaModel();
        $this->HistoryDraftModel = new HistoryDraftModel();
        $this->DraftModel = new DraftModel();
    }
    public function create()
    {
        if (session('jobdesk') == 'SPIO') {
            $draft = $this->DraftModel->getPemeriksa();
            $data = [
                'title' => 'Input Draft',
                'draft' => $draft,
                'validation' => \Config\Services::validation()
            ];
            return view('SPIO/Draft/createdraft', $data);
        } elseif (session('jobdesk') == 'Administrasi') {
            $data = [
                'title' => 'Input Draft',
                'validation' => \Config\Services::validation()
            ];
            return view('Fakultas/Draft/createdraft', $data);
        }
    }

    public function save()
    {
        if (session('jobdesk' == 'SPIO')) {
            if (!$this->validate([
                'jenis_Draft' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Draft harus diisi.',
                    ]
                ],
                'file_Draft' => [
                    'rules' => 'uploaded[file_Draft]|ext_in[file_Draft,pdf,docx]',
                    'errors' => [
                        'uploaded' => 'File Draft harus diisi.',
                        'ext_in' => 'Hanya menerima file dengan extensi pdf,docx'
                    ]
                ],
                'judul_Draft' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Draft harus diisi.',
                    ]
                ],
                'pemeriksa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pemeriksa harus diisi.',
                    ]
                ]

            ])) {
                return redirect()->to('/Draft/Create')->withInput();
            }
            $file = $this->request->getFile('file_Draft');
            $file->move('file/draft');
            $kode = rand(10, 50) . date("Y-m-d h:i:sa");
            $filename = $file->getName();
            $pemeriksa = $this->request->getVar('pemeriksa');
            $this->DraftModel->save([
                'nip' => $this->request->getVar('nip'),
                'judul' => $this->request->getVar('judul_Draft'),
                'jenis' => $this->request->getVar('jenis_Draft'),
                'file_draft' => $filename,
                'catatan' => $this->request->getVar('catatan'),
                'status' => 'Pending',
                'id_pemeriksa' => $kode
            ]);

            foreach ($pemeriksa as $row) {
                $data = [
                    'id_pemeriksa' => $kode,
                    'nip_pemeriksa' => $row,
                    'status_pemeriksa' => 'Pending'
                ];

                $this->DraftModel->input_pemeriksa($data);
            }
            return redirect()->to('/Draft/Index')->with('success', 'Anda berhasil menambahkan data');
        }
    }

    public function store()
    {
        if (!$this->validate([
            'jenis_Draft' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Draft harus diisi.',
                ]
            ],
            'file_Draft' => [
                'rules' => 'uploaded[file_Draft]|ext_in[file_Draft,pdf,docx]',
                'errors' => [
                    'uploaded' => 'File Draft harus diisi.',
                    'ext_in' => 'Hanya menerima file dengan extensi pdf,docx'
                ]
            ],
            'judul_Draft' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul Draft harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/Draft/Create')->withInput();
        }
        $pemeriksa = $this->DraftModel->getDekan();
        $file = $this->request->getFile('file_Draft');
        $file->move('file/draft');
        $kode = rand(10, 50) . date("Y-m-d h:i:sa");
        $filename = $file->getName();
        $this->DraftModel->save([
            'nip' => $this->request->getVar('nip'),
            'judul' => $this->request->getVar('judul_Draft'),
            'jenis' => $this->request->getVar('jenis_Draft'),
            'file_draft' => $filename,
            'catatan' => $this->request->getVar('catatan'),
            'status' => 'Pending',
            'id_pemeriksa' => $kode
        ]);

        foreach ($pemeriksa as $nip) {
            $data = [
                'id_pemeriksa' => $kode,
                'nip_pemeriksa' => $nip['nip'],
                'status_pemeriksa' => 'Pending',
                'roles' => 'Dekan'
            ];
        }

        $this->DraftModel->input_pemeriksa($data);
        return redirect()->to('/Draft/Index')->with('success', 'Anda berhasil menambahkan data');
    }

    public function index()
    {
        if (session('jobdesk') == 'SPIO') {
            $draft = $this->DraftModel->getdraft();
            $pemeriksa = $this->DraftModel->getdata();
            $data = [
                'title' => 'Lihat Draft',
                'draft' => $draft,
                'validation' => \Config\Services::validation(),
                'pemeriksa' => $pemeriksa
            ];
            return view('SPIO/Draft/lihatdraft', $data);
        } elseif (session('jobdesk') == 'Administrasi') {
            $draft = $this->DraftModel->getdraft();
            $pemeriksa = $this->DraftModel->getdata();
            $data = [
                'title' => 'Lihat Draft',
                'draft' => $draft,
                'validation' => \Config\Services::validation(),
                'pemeriksa' => $pemeriksa
            ];
            return view('Fakultas/Draft/lihatdraft', $data);
        }
    }

    public function trash()
    {
        if (session('jobdesk') == 'SPIO') {
            $draft = $this->DraftModel->onlyDeleted()->where('draft.nip', session('nip'))->findAll();
            $pemeriksa = $this->DraftModel->getdata();
            $data = [
                'title' => 'Trash Draft',
                'draft' => $draft,
                'pemeriksa' => $pemeriksa
            ];
            return view('SPIO/Draft/trashdraft', $data);
        } elseif (session('jobdesk') == 'Administrasi') {
            $draft = $this->DraftModel->onlyDeleted()->where('draft.nip', session('nip'))->findAll();
            $pemeriksa = $this->DraftModel->getdata();
            $data = [
                'title' => 'Trash Draft',
                'draft' => $draft,
                'pemeriksa' => $pemeriksa
            ];
            return view('Fakultas/Draft/trashdraft', $data);
        }
    }

    public function softdelete($id)
    {
        $this->DraftModel->delete($id);

        return redirect()->to('/Draft/Index')->with('success', 'Anda berhasil menghapus data');
    }

    public function back($id)
    {
        if (session('jobdesk') == 'SPIO' || session('jobdesk') == 'Administrasi') {
            $this->DraftModel->save([
                'id' => $id,
                'deleted_at' => null
            ]);

            return redirect()->to('/Draft/Trash')->with('success', 'Anda berhasil membatalkan penghapusan data');
        }
    }

    public function remove($id)
    {
        if (session('jobdesk') == 'SPIO' || session('jobdesk') == 'Administrasi') {
            $drafts = $this->DraftModel->where('id', $id)->get()->getResultArray();
            foreach ($drafts as $draft) {
                $this->HistoryPemeriksaModel->remove($draft['id_pemeriksa']);
            }
            $this->HistoryDraftModel->remove($id);
            return redirect()->to('/Draft/Trash')->with('success', 'Anda berhasil menghapus data secara permanent');
        }
    }

    public function update()
    {
        if (!$this->validate([
            'file_Draft' => [
                'rules' => 'uploaded[file_Draft]|ext_in[file_Draft,pdf,docx]',
                'errors' => [
                    'uploaded' => 'File Draft harus diisi.',
                    'ext_in' => 'Hanya menerima file dengan extensi pdf,docx'
                ]
            ]

        ])) {
            return redirect()->to('/Draft/Index')->with('warning', 'Silahkan Inputkan file yang ingin diedit');
        }

        $data_lama = $this->DraftModel->where('id', $this->request->getVar('id'))->first();
        $file_lama = $data_lama['file_draft'];
        unlink("file/draft/$file_lama");
        $file = $this->request->getFile('file_Draft');
        $file->move('file/draft');
        $filename = $file->getName();
        $this->DraftModel->save([
            'file_draft' => $filename,
            'id' => $this->request->getVar('id')
        ]);

        return redirect()->to('/Draft/Index')->with('success', 'Anda berhasil mengupdate data');
    }
}
