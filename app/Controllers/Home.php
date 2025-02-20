<?php

namespace App\Controllers;

use App\Models\DataCatalogModel;

class Home extends BaseController
{
    protected $dataCatalogModel;

    public function __construct()
    {
        $this->dataCatalogModel = new DataCatalogModel();
    }

    public function index(): string
    {
        $data['catalogs'] = $this->dataCatalogModel->findAll();
        return view('welcome_message', $data);
    }
}
