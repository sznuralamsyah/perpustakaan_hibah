<?php

namespace App\Models;

use CodeIgniter\Model;

class DonationModel extends Model
{
    protected $table            = 'donations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'name',
        'institution',
        'address',
        'book_title',
        'publisher',
        'author',
        'publication_year',
        'isbn',
        'issn',
        'quantity',
        'book_photo',
        'phone_number',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|max_length[255]',
        'book_title' => 'required|max_length[255]',
        'quantity'   => 'required|integer',
        'status'     => 'required|in_list[pending,accepted,rejected]',
    ];
    protected $validationMessages = [
        'name' => [
            'required'   => 'Nama donatur wajib diisi.',
            'max_length' => 'Nama donatur maksimal 255 karakter.',
        ],
        'book_title' => [
            'required'   => 'Judul buku wajib diisi.',
            'max_length' => 'Judul buku maksimal 255 karakter.',
        ],
        'quantity' => [
            'required' => 'Jumlah buku wajib diisi.',
            'integer'  => 'Jumlah buku harus berupa angka.',
        ],
        'status' => [
            'required' => 'Status wajib diisi.',
            'in_list'  => 'Status harus salah satu dari: pending, accepted, rejected.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDonationsWithUser()
    {
        return $this->select('donations.*, users.name as user_name')
            ->join('users', 'users.id = donations.user_id', 'left')
            ->findAll();
    }
}
