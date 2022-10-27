<?php

namespace App\Controllers;

use App\Models\AdministrasiModel;
use App\Models\DraftModel;
use App\Models\HistoryArsipModel;
use App\Models\HistoryDraftModel;
use App\Models\HistoryPemeriksaModel;
use App\Models\PemeriksaModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    // SPIO
    protected $DraftModel;
    protected $HistoryDraftModel;
    protected $HistoryArsiptModel;

    // Pemeriksa
    protected $PemeriksaModel;
    protected $HistoryPemeriksaModel;

    // Admin
    protected $UserModel;
    public function __construct()
    {
        // SPIO
        $this->DraftModel = new DraftModel();
        $this->HistoryDraftModel = new HistoryDraftModel();
        $this->HistoryArsiptModel = new HistoryArsipModel();

        // Pemeriksa
        $this->PemeriksaModel = new PemeriksaModel();
        $this->HistoryPemeriksaModel = new HistoryPemeriksaModel();

        // Admin
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        if (session('jobdesk') == 'SPIO') {
            $draft = count($this->DraftModel->withDeleted()->where('nip', session('nip'))->findAll());
            $historydraft = count($this->HistoryDraftModel->where('nip', session('nip'))->findAll());
            $historyarsip = count($this->HistoryArsiptModel->findAll());
            $historydraftfakultas = count($this->HistoryDraftModel->getdataspio());
            $data = [
                'title' => 'Dashboard',
                'draft' => $draft,
                'historydraft' => $historydraft,
                'historyarsip' => $historyarsip,
                'historydraftfakultas' => $historydraftfakultas
            ];
            return view('SPIO/dashboard', $data);
        } elseif (session('jobdesk') == 'Pemeriksa' || session('jobdesk') == 'Dekan') {
            $draftnew = count($this->PemeriksaModel->countnew());
            $draftreturn = count($this->PemeriksaModel->countreturn());
            $draftapproved = count($this->PemeriksaModel->countapproved()) + count($this->HistoryPemeriksaModel->countapproved());
            $draftrejected = count($this->PemeriksaModel->countrejected()) + count($this->HistoryPemeriksaModel->countrejected());
            $data = [
                'title' => 'Dashboard',
                'new' => $draftnew,
                'return' => $draftreturn,
                'approved' => $draftapproved,
                'rejected' => $draftrejected
            ];
            return view('Pemeriksa/dashboard', $data);
        } elseif (session('jobdesk') == 'Administrasi') {
            $draftpending = count($this->DraftModel->getpending());
            $draftreturn = count($this->DraftModel->getreturn());
            $draftapproved = count($this->HistoryDraftModel->getapproved());
            $draftrejected = count($this->HistoryDraftModel->getrejected());
            $data = [
                'title' => 'Dashboard',
                'pending' => $draftpending,
                'return' => $draftreturn,
                'approved' => $draftapproved,
                'rejected' => $draftrejected
            ];
            return view('Fakultas/dashboard', $data);
        } elseif (session('jobdesk') == 'Admin') {
            $pemeriksa = count($this->UserModel->where('jobdesk', 'Pemeriksa')->findAll());
            $dekan = count($this->UserModel->where('jobdesk', 'Dekan')->findAll());
            $administrasi = count($this->UserModel->where('jobdesk', 'Administrasi')->findAll());
            $SPIO = count($this->UserModel->where('jobdesk', 'SPIO')->findAll());
            $data = [
                'title' => 'Dashboard Admin',
                'pemeriksa' => $pemeriksa,
                'dekan' => $dekan,
                'administrasi' => $administrasi,
                'SPIO' => $SPIO
            ];
            return view('Admin/dashboard', $data);
        }
    }
}
