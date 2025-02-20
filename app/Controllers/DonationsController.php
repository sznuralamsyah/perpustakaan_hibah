<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DonationModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DonationsController extends BaseController
{
    protected $donationModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->donationModel = new DonationModel();
    }

    public function index()
    {
        $donationModel = new DonationModel();

        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Anda harus login untuk melihat donasi Anda.');
        }

        $userId = session()->get('user_id');

        // dd($userId); 

        $data['donations'] = $donationModel
            ->where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->findAll();

        return view('user/donations/index', $data);
    }


    public function store()
    {
        $rules = [
            'name'             => 'required|min_length[3]|max_length[255]',
            'institution'      => 'required|max_length[255]',
            'address'          => 'required',
            'book_title'       => 'required|max_length[255]',
            'publisher'        => 'required|max_length[255]',
            'author'           => 'required|max_length[255]',
            'publication_year' => 'required|numeric',
            'isbn'             => 'permit_empty|max_length[20]',
            'issn'             => 'permit_empty|max_length[20]',
            'quantity'         => 'required|numeric',
            'phone_number'     => 'required|regex_match[/^[0-9]+$/]',
            'status'           => 'required|in_list[pending,approved,rejected]',
            'book_photo'       => 'permit_empty|uploaded[book_photo]|max_size[book_photo,2048]|is_image[book_photo]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->back()->with('error', 'Anda harus login untuk menyumbang buku.');
        }

        $bookPhoto = $this->request->getFile('book_photo');
        if ($bookPhoto && $bookPhoto->isValid() && !$bookPhoto->hasMoved()) {
            $newName = $bookPhoto->getRandomName();
            $bookPhoto->move('uploads/books', $newName);
        } else {
            $newName = null;
        }

        $data = [
            'user_id'         => $userId,
            'name'            => $this->request->getPost('name'),
            'institution'     => $this->request->getPost('institution'),
            'address'         => $this->request->getPost('address'),
            'book_title'      => $this->request->getPost('book_title'),
            'publisher'       => $this->request->getPost('publisher'),
            'author'          => $this->request->getPost('author'),
            'publication_year' => $this->request->getPost('publication_year'),
            'isbn'            => $this->request->getPost('isbn'),
            'issn'            => $this->request->getPost('issn'),
            'quantity'        => $this->request->getPost('quantity'),
            'phone_number'    => $this->request->getPost('phone_number'),
            'status'          => $this->request->getPost('status'),
            'book_photo'      => $newName,
        ];

        $this->donationModel->insert($data);

        return redirect()->to('/user/donations')->with('success', 'Donasi berhasil ditambahkan');
    }


    public function update($id)
    {
        $donation = $this->donationModel->find($id);
        if (!$donation) {
            return redirect()->to('/donations')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'name'             => 'required|min_length[3]|max_length[255]',
            'institution'      => 'required|max_length[255]',
            'address'          => 'required',
            'book_title'       => 'required|max_length[255]',
            'publisher'        => 'required|max_length[255]',
            'author'           => 'required|max_length[255]',
            'publication_year' => 'required|numeric',
            'isbn'             => 'permit_empty|max_length[20]',
            'issn'             => 'permit_empty|max_length[20]',
            'quantity'         => 'required|numeric',
            'phone_number'     => 'required|regex_match[/^[0-9]+$/]',
            'status'           => 'required|in_list[pending,approved,rejected]',
            'book_photo'       => 'permit_empty|uploaded[book_photo]|max_size[book_photo,2048]|is_image[book_photo]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $bookPhoto = $this->request->getFile('book_photo');
        if ($bookPhoto && $bookPhoto->isValid() && !$bookPhoto->hasMoved()) {
            $newName = $bookPhoto->getRandomName();
            $bookPhoto->move('uploads/books', $newName);

            if ($donation['book_photo']) {
                if(!empty($donation['book_photo']) && file_exists('uploads/books' . $donation['book_photo']) ){
                    unlink('uploads/books/' . $donation['book_photo']);
                }else{

                }
            }
        } else {
            // $newName = $donation['book_photo'];
            $newName = !empty($donation['book_photo']) ? $donation['book_photo'] : null;
        }

        // oke bntar, sy cek dulu disini

        $data = [
            'name'             => $this->request->getPost('name'),
            'institution'      => $this->request->getPost('institution'),
            'address'          => $this->request->getPost('address'),
            'book_title'       => $this->request->getPost('book_title'),
            'publisher'        => $this->request->getPost('publisher'),
            'author'           => $this->request->getPost('author'),
            'publication_year' => $this->request->getPost('publication_year'),
            'isbn'             => $this->request->getPost('isbn'),
            'issn'             => $this->request->getPost('issn'),
            'quantity'         => $this->request->getPost('quantity'),
            'phone_number'     => $this->request->getPost('phone_number'),
            'status'           => $this->request->getPost('status'),
            'book_photo'       => $newName,
        ];

        $this->donationModel->update($id, $data);

        return redirect()->to('/user/donations')->with('success', 'Donasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $donation = $this->donationModel->find($id);
        if (!$donation) {
            return redirect()->to('/donations')->with('error', 'Data tidak ditemukan');
        }

        if (!empty($donation['book_photo']) && file_exists('uploads/books/' . $donation['book_photo'])) {
            unlink('uploads/books/' . $donation['book_photo']);
        }

        $this->donationModel->delete($id);

        return redirect()->to('/user/donations')->with('success', 'Donasi berhasil dihapus');
    }

    // public function importData()
    // {
    //     if (!$this->validate(['excel_file' => 'uploaded[excel_file]|ext_in[excel_file,xls,xlsx]'])) {
    //         return redirect()->back()->with('error', 'Tipe file tidak valid. Hanya file .xls dan .xlsx yang diperbolehkan.');
    //     }

    //     if (!$this->request->getFile('excel_file')->isValid()) {
    //         return redirect()->back()->with('error', 'Upload file tidak valid');
    //     }

    //     $file = $this->request->getFile('excel_file');

    //     $spreadsheet = IOFactory::load($file->getTempName());

    //     $sheet = $spreadsheet->getActiveSheet();

    //     $data = [];
    //     foreach ($sheet->getRowIterator() as $row) {
    //         $rowData = [];
    //         foreach ($row->getCellIterator() as $cell) {
    //             $rowData[] = $cell->getValue();
    //         }

    //         if ($row->getRowIndex() > 1) {
    //             $data[] = [
    //                 'name' => $rowData[0],
    //                 'institution' => $rowData[1],
    //                 'address' => $rowData[2],
    //                 'book_title' => $rowData[3],
    //                 'publisher' => $rowData[4],
    //                 'author' => $rowData[5],
    //                 'publication_year' => $rowData[6],
    //                 'isbn' => $rowData[7],
    //                 'issn' => $rowData[8],
    //                 'quantity' => $rowData[9],
    //                 'book_photo' => 'null',
    //                 'phone_number' => $rowData[11],
    //                 'status' => 'pending',
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ];
    //         }
    //     }

    //     log_message('debug', 'Data yang diimpor: ' . print_r($data, true));

    //     $donationModel = new DonationModel();
    //     $donationModel->insertBatch($data);

    //     return redirect()->to('/user/donations')->with('success', 'Data berhasil diimpor!');
    // }
    public function importData()
    {
        if (!$this->validate(['excel_file' => 'uploaded[excel_file]|ext_in[excel_file,xls,xlsx]'])) {
            return redirect()->back()->with('error', 'Tipe file tidak valid. Hanya file .xls dan .xlsx yang diperbolehkan.');
        }

        if (!$this->request->getFile('excel_file')->isValid()) {
            return redirect()->back()->with('error', 'Upload file tidak valid');
        }

        $file = $this->request->getFile('excel_file');

        $spreadsheet = IOFactory::load($file->getTempName());

        $sheet = $spreadsheet->getActiveSheet();

        $data = [];
        foreach ($sheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }

            if ($row->getRowIndex() > 1) {
                $userId = session()->get('user_id'); 

                if (!$userId) {
                    return redirect()->back()->with('error', 'Anda harus login untuk mengimpor data.');
                }

                $data[] = [
                    'user_id' => $userId,
                    'name' => $rowData[0],
                    'institution' => $rowData[1],
                    'address' => $rowData[2],
                    'book_title' => $rowData[3],
                    'publisher' => $rowData[4],
                    'author' => $rowData[5],
                    'publication_year' => $rowData[6],
                    'isbn' => $rowData[7],
                    'issn' => $rowData[8],
                    'quantity' => $rowData[9],
                    'book_photo' => 'null',
                    'phone_number' => $rowData[11],
                    'status' => 'pending',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        log_message('debug', 'Data yang diimpor: ' . print_r($data, true));

        $donationModel = new DonationModel();
        $donationModel->insertBatch($data);

        return redirect()->to('/user/donations')->with('success', 'Data berhasil diimpor!');
    }
    
    public function download($filename)
    {
        $filepath = FCPATH . 'templates/' . $filename;

        if (file_exists($filepath)) {
            return $this->response
                ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->setHeader('Content-Length', filesize($filepath))
                ->setBody(file_get_contents($filepath));
        } else {
            return redirect()->to('/')->with('error', 'File tidak ditemukan.');
        }
    }
}
