<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DonationModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $donationModel = new DonationModel();

        $totalPenghibah = $userModel->select('users.*')
            ->join('roles', 'roles.id = users.role_id')
            ->where('roles.role_name', 'user')
            ->countAllResults();

        $totalJudul = $donationModel->distinct()->countAllResults('book_title');

        $totalBuku = $donationModel->selectSum('quantity')->first();

        $tahunSekarang = date('Y');

        $bukuPerBulan = $donationModel
            ->select('MONTH(created_at) as month, SUM(quantity) as total_buku')
            ->where('YEAR(created_at)', $tahunSekarang)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->findAll();

        // log_message('debug', 'Data Buku per Bulan: ' . print_r($bukuPerBulan, true));
        return view('admin/dashboard', [
            'totalPenghibah' => $totalPenghibah,
            'totalJudul' => $totalJudul,
            'totalBuku' => $totalBuku,
            'bukuPerBulan' => $bukuPerBulan
        ]);
    }
}
