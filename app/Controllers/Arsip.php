<?php

namespace App\Controllers;

use App\Models\ArsipModel;
use App\Models\HistoryArsipModel;

class Arsip extends BaseController
{
    protected $ArsipModel;
    protected $HistoryArsipModel;
    public function __construct()
    {
        $this->ArsipModel = new ArsipModel();
        $this->HistoryArsipModel = new HistoryArsipModel();
    }

    public function create()
    {
        if (session('jobdesk') != 'SPIO') {
            return redirect()->to(site_url('/home'));
        }
        $data = [
            'title' => 'Input Arsip',
            'validation' => \Config\Services::validation()
        ];
        return view('SPIO/Arsip/createarsip', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'tanggal_kerjasama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal kerjasama harus diisi.',
                ]
            ],
            'tanggal_kadaluarsa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal kadaluarsa harus diisi.',
                ]
            ],
            'jenis_arsip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis arsip harus diisi.',
                ]
            ],
            'file_arsip' => [
                'rules' => 'uploaded[file_arsip]|ext_in[file_arsip,pdf,docx]',
                'errors' => [
                    'uploaded' => 'File arsip harus diisi.',
                    'ext_in' => 'Extensi file tidak sesuai'
                ]
            ],
            'judul_arsip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul arsip harus diisi.',
                ]
            ]

        ])) {
            return redirect()->to('/Arsip/Create')->withInput();
        }
        $file = $this->request->getFile('file_arsip');
        $file->move('file/arsip');
        $filename = $file->getName();
        $this->ArsipModel->save([
            'tgl_kerjasama' => $this->request->getVar('tanggal_kerjasama'),
            'tgl_kadaluarsa' => $this->request->getVar('tanggal_kadaluarsa'),
            'nip' => $this->request->getVar('nip'),
            'judul' => $this->request->getVar('judul_arsip'),
            'jenis' => $this->request->getVar('jenis_arsip'),
            'file_arsip' => $filename,
            'catatan' => $this->request->getVar('catatan')
        ]);
        return redirect()->to('/Arsip/Index')->with('success', 'Anda menambahkan data');
    }

    public function index()
    {
        if (session('jobdesk') != 'SPIO') {
            return redirect()->to(site_url('/home'));
        }
        $arsip = $this->ArsipModel->getarsip();
        $data = [
            'title' => 'Lihat Arsip',
            'arsip' => $arsip
        ];
        return view('SPIO/Arsip/lihatarsip', $data);
    }

    public function trash()
    {
        if (session('jobdesk') != 'SPIO') {
            return redirect()->to(site_url('/home'));
        }
        $arsip = $this->ArsipModel->gettrash();
        $data = [
            'title' => 'Trash Arsip',
            'arsip' => $arsip
        ];
        return view('SPIO/Arsip/trasharsip', $data);
    }

    public function softdelete($id)
    {
        if (session('jobdesk') != 'SPIO') {
            return redirect()->to(site_url('/home'));
        }
        $this->ArsipModel->delete($id);

        return redirect()->to('/Arsip/Index')->with('success', 'Anda berhasil menghapus data');
    }

    public function back($id)
    {
        if (session('jobdesk') != 'SPIO') {
            return redirect()->to(site_url('/home'));
        }
        $this->ArsipModel->save([
            'id' => $id,
            'deleted_at' => null
        ]);

        return redirect()->to('/Arsip/Trash')->with('success', 'Anda berhasil membatalkan penghapusan data');
    }

    public function remove($id)
    {
        if (session('jobdesk') != 'SPIO') {
            return redirect()->to(site_url('/home'));
        }
        $this->HistoryArsipModel->input($id);
        return redirect()->to('/Arsip/Trash')->with('success', 'Anda berhasil menghapus data secara permanent');
    }
}
