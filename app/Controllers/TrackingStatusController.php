<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DonationModel;
use CodeIgniter\HTTP\ResponseInterface;

class TrackingStatusController extends BaseController
{
    public function index()
    {
        $donationModel = new DonationModel();

        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Anda harus login untuk melihat status donasi Anda.');
        }

        $userId = session()->get('user_id');

        $donations = $donationModel
            ->where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->findAll();

        return view('user/donations/tracking_status', ['donations' => $donations]);
    }
}
