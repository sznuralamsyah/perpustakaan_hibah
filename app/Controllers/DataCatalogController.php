<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataCatalogModel;
use CodeIgniter\HTTP\ResponseInterface;

class DataCatalogController extends BaseController
{
    protected $dataCatalogModel;

    public function __construct()
    {
        $this->dataCatalogModel = new DataCatalogModel();
    }

    public function index()
    {
        $data['catalogs'] = $this->dataCatalogModel->findAll();
        return view('admin/data_catalog/index', $data);
    }

    // public function show($id)
    // {
    //     $data['catalog'] = $this->dataCatalogModel->find($id);
    //     if (empty($data['catalog'])) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Catalog not found');
    //     }
    //     return view('data_catalog/show', $data);
    // }

    public function store()
    {
        $name = $this->request->getPost('name');
        $qty = $this->request->getPost('qty');

        $bookPhoto = $this->request->getFile('book_photo');
        if ($bookPhoto && $bookPhoto->isValid() && !$bookPhoto->hasMoved()) {
            $newName = $bookPhoto->getRandomName();
            $bookPhoto->move('uploads/books', $newName);
        } else {
            $newName = null;
        }

        $this->dataCatalogModel->save([
            'name' => $name,
            'book_photo' => $newName, 
            'qty' => $qty
        ]);

        return redirect()->to('/admin/data_catalog')->with('success', 'Data has been added successfully');
    }

    public function update($id)
    {
        $dataCatalog = $this->dataCatalogModel->find($id);

        if (!$dataCatalog) {
            return redirect()->to('/admin/data_catalog')->with('error', 'Data not found');
        }

        $name = $this->request->getPost('name');
        $qty = $this->request->getPost('qty');

        $bookPhoto = $this->request->getFile('book_photo');
        if ($bookPhoto && $bookPhoto->isValid() && !$bookPhoto->hasMoved()) {
            if ($dataCatalog['book_photo']) {
                unlink('uploads/books/' . $dataCatalog['book_photo']);
            }

            $newName = $bookPhoto->getRandomName();
            $bookPhoto->move('uploads/books', $newName);
        } else {
            $newName = $dataCatalog['book_photo'];
        }

        $this->dataCatalogModel->update($id, [
            'name' => $name,
            'book_photo' => $newName, 
            'qty' => $qty
        ]);

        return redirect()->to('/admin/data_catalog')->with('success', 'Data has been updated successfully');
    }

    public function delete($id)
    {
        $dataCatalog = $this->dataCatalogModel->find($id);

        if (!$dataCatalog) {
            return redirect()->to('/admin/data_catalog')->with('error', 'Data not found');
        }

        $this->dataCatalogModel->delete($id);
        return redirect()->to('/admin/data_catalog')->with('success', 'Data has been deleted successfully');
    }
}
