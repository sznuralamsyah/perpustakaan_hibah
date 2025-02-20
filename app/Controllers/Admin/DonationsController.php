<?php

namespace App\Controllers\Admin;

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

        $data['donations'] = $donationModel->orderBy('updated_at', 'desc')->findAll();
        return view('admin/donations/index', $data);
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
            'status'           => 'required|in_list[pending,accepted,rejected]',
            'book_photo'       => 'permit_empty|uploaded[book_photo]|max_size[book_photo,2048]|is_image[book_photo]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $bookPhoto = $this->request->getFile('book_photo');
        if ($bookPhoto && $bookPhoto->isValid() && !$bookPhoto->hasMoved()) {
            $newName = $bookPhoto->getRandomName();
            $bookPhoto->move('uploads/books', $newName);
        } else {
            $newName = null;
        }

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

        $this->donationModel->insert($data);

        return redirect()->to('/admin/donations')->with('success', 'Donasi berhasil ditambahkan');
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
            'status'           => 'required|in_list[pending,accepted,rejected]',
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
                unlink('uploads/books/' . $donation['book_photo']);
            }
        } else {
            $newName = $donation['book_photo'];
        }

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

        return redirect()->to('/admin/donations')->with('success', 'Donasi berhasil diperbarui');
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

        return redirect()->to('/admin/donations')->with('success', 'Donasi berhasil dihapus');
    }
}
