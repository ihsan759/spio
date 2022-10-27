<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new LoginModel();
    }

    public function index()
    {
        if (session('nip')) {
            if (session('jobdesk') == "Admin") {
                return redirect()->to(site_url('dashmin'));
            } else {
                return redirect()->to(site_url('dashboard'));
            }
        }
        return view('Auth/login.php');
    }

    public function auth()
    {
        $data = $this->request->getPost();
        $query = $this->UserModel->getWhere(['username' => $data['username']]);
        if ($query->getRow()) {
            if (md5($data['password']) == $query->getRow()->password && $query->getRow()->deleted_at == null) {
                $params = [
                    'nip' => $query->getRow()->nip,
                    'jobdesk' => $query->getRow()->jobdesk,
                    'nama' => $query->getRow()->nama,
                    'fakultas' => $query->getRow()->fakultas
                ];
                session()->set($params);
                if ($query->getRow()->jobdesk == "Admin") {
                    return redirect()->to(site_url('Admin/Dashboard'));
                } else {
                    return redirect()->to(site_url('dashboard'));
                }
            } else {
                return redirect()->back()->with('error', 'Username atau Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau Password salah');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('/'));
    }
}
