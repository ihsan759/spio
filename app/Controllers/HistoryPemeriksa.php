<?php

namespace App\Controllers;

use App\Models\HistoryDraftModel;
use App\Models\HistoryPemeriksaModel;

class HistoryPemeriksa extends BaseController
{
    protected $HistoryPemeriksaModel;
    protected $HistoryDraftModel;

    public function __construct()
    {
        $this->HistoryDraftModel = new HistoryDraftModel();
        $this->HistoryPemeriksaModel = new HistoryPemeriksaModel();
    }

    public function index()
    {
        if (session('jobdesk') == 'Pemeriksa' || session('jobdesk') == 'Dekan') {
            $draft = $this->HistoryPemeriksaModel->getdata();
            $data = [
                'title' => 'History',
                'draft' => $draft
            ];
            return view('Pemeriksa/Draft/history.php', $data);
        } elseif (session('jobdesk') == 'SPIO') {
            $draft = $this->HistoryDraftModel->getdataspio();
            $data = [
                'title' => 'History',
                'draft' => $draft
            ];
            return view('SPIO/Pemeriksa/historydraft.php', $data);
        }
    }
}
