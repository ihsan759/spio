<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        if (session('jobdesk') == 'Admin') {
            $Akun = $this->UserModel->findAll();

            $data = [
                'akun' => $Akun,
                'title' => 'List Akun'
            ];
            return view('Admin/Akun/ListAkun', $data);
        }
    }
    public function create()
    {
        if (session('jobdesk') == 'Admin') {
            $data = [
                'title' => 'Buat Akun',
                'validation' => \Config\Services::validation()
            ];
            return view('Admin/Akun/BuatAkun', $data);
        }
    }

    public function store()
    {
        if (!$this->validate([
            'nip' => [
                'rules' => 'required|is_unique[user.nip]',
                'errors' => [
                    'required' => 'NIP harus diisi.',
                    'is_unique' => 'NIP sudah ada'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.',
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin harus diisi.',
                ]
            ],
            'jobdesk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jobdesk harus diisi.',
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'is_unique' => 'Username sudah ada'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.',
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[user.email]',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'is_unique' => 'Email sudah ada'
                ]
            ],

        ])) {
            return redirect()->to('/Admin/Create')->withInput();
        }
        if ($this->request->getVar('jobdesk') == 'Administrasi' || $this->request->getVar('jobdesk') == 'Dekan') {
            if (!$this->validate([
                'fakultas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Fakultas harus diisi.'
                    ]
                ]

            ])) {
                return redirect()->to('/Admin/Create')->withInput();
            }
            $password = md5($this->request->getPost('password'));
            $data = [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'jenis_kelamin' => $this->request->getPost('jk'),
                'jobdesk' => $this->request->getPost('jobdesk'),
                'fakultas' => $this->request->getPost('fakultas'),
                'username' => $this->request->getPost('username'),
                'password' => $password,
                'email' => $this->request->getPost('email')
            ];
        } else {
            $password = md5($this->request->getPost('password'));
            $data = [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'jenis_kelamin' => $this->request->getPost('jk'),
                'jobdesk' => $this->request->getPost('jobdesk'),
                'username' => $this->request->getPost('username'),
                'password' => $password,
                'email' => $this->request->getPost('email')
            ];
        }

        $this->UserModel->insert($data);

        return redirect()->to('Admin/Index')->with('success', 'Anda berhasil membuat akun');
    }
    public function edit($nip)
    {
        if (session('jobdesk') == 'Admin') {
            $akun = $this->UserModel->where('nip', $nip)->first();
            $data = [
                'akun' => $akun,
                'title' => 'Edit Akun',
                'validation' => \Config\Services::validation()
            ];
            return view('Admin/Akun/EditAkun.php', $data);
        }
    }

    public function delete($nip)
    {
        if (session('jobdesk') == 'Admin') {
            $this->UserModel->delete($nip);
            return redirect()->to('Admin/Trash')->with('success', 'Anda berhasil menghapus akun');
        }
    }

    public function trash()
    {
        if (session('jobdesk') == 'Admin') {
            $Akun = $this->UserModel->onlyDeleted()->findAll();

            $data = [
                'akun' => $Akun,
                'title' => 'List Akun'
            ];
            return view('Admin/Akun/TrashAkun', $data);
        }
    }

    public function back($nip)
    {
        if (session('jobdesk') == 'Admin') {
            $this->UserModel->save([
                'nip' => $nip,
                'deleted_at' => null
            ]);
            return redirect()->to('Admin/Index')->with('success', 'Anda berhasil mengembalikan akun');
        }
    }

    public function update()
    {
        $nip = $this->request->getPost('nip');
        if (!$this->validate([
            'nip' => [
                'rules' => 'required|is_unique[user.nip,nip,{nip}]',
                'errors' => [
                    'required' => 'NIP harus diisi.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.',
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin harus diisi.',
                ]
            ],
            'jobdesk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jobdesk harus diisi.',
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[user.username,nip,{nip}]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'is_unique' => 'Username sudah ada'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[user.email,nip,{nip}]',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'is_unique' => 'Email sudah ada'
                ]
            ],

        ])) {
            return redirect()->to('/Admin/Edit/' . $this->request->getPost('nip'))->withInput();
        }
        if ($this->request->getPost('password') != null) {
            $password = md5($this->request->getPost('password'));
            $data = [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'jenis_kelamin' => $this->request->getPost('jk'),
                'jobdesk' => $this->request->getPost('jobdesk'),
                'fakultas' => $this->request->getPost('fakultas'),
                'username' => $this->request->getPost('username'),
                'password' => $password,
                'email' => $this->request->getPost('email')
            ];
        } else {
            $data = [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'jenis_kelamin' => $this->request->getPost('jk'),
                'jobdesk' => $this->request->getPost('jobdesk'),
                'fakultas' => $this->request->getPost('fakultas'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email')
            ];
        }
        $this->UserModel->save($data);
        if ($this->request->getPost('fakultas') == null) {
            $this->UserModel->save([
                'nip' => $this->request->getPost('nip'),
                'fakultas' => null
            ]);
        }

        return redirect()->to('Admin/Index')->with('success', 'Anda berhasil mengupdate akun');
    }
}
