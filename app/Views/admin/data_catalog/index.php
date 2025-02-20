<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Daftar Katalog Data<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Daftar Katalog Data</h4>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDataCatalogModal">
                    Tambah Katalog Data Baru
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Foto Buku</th>
                                <th>Kuantitas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($catalogs as $index => $catalog) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($catalog['name']) ?></td>
                                    <td><img src="<?= base_url('uploads/books/' . esc($catalog['book_photo'])) ?>" alt="Book Photo" width="100"></td>
                                    <td><?= esc($catalog['qty']) ?></td>
                                    <td class="text-nowrap">
                                        <div class="dropdown dropup">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="viewDataCatalogDetail(<?= htmlspecialchars(json_encode($catalog), ENT_QUOTES, 'UTF-8') ?>)">
                                                        Lihat Detail
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editDataCatalogModal"
                                                        onclick="editDataCatalog(<?= htmlspecialchars(json_encode($catalog), ENT_QUOTES, 'UTF-8') ?>)">
                                                        Ubah
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="<?= base_url('admin/data_catalog/delete/' . $catalog['id']) ?>"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus katalog data ini?')">
                                                        <button type="submit" class="dropdown-item">Hapus</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('admin/data_catalog/partials/add-modal') ?>

<?= $this->include('admin/data_catalog/partials/edit-modal') ?>

<div class="modal fade" id="viewDataCatalogDetailModal" tabindex="-1" aria-labelledby="viewDataCatalogDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDataCatalogDetailModalLabel">Detail Katalog Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama:</strong> <span id="detail_name"></span></p>
                <p><strong>Foto Buku:</strong> <img id="detail_photo" width="100"></p>
                <p><strong>Kuantitas:</strong> <span id="detail_qty"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function editDataCatalog(catalog) {
        document.getElementById('editDataCatalogForm').action = `/admin/data_catalog/update/${catalog.id}`;
        document.getElementById('edit_name').value = catalog.name;
        document.getElementById('edit_qty').value = catalog.qty;
        $('#editDataCatalogModal').modal('show');
    }

    function viewDataCatalogDetail(catalog) {
        document.getElementById('detail_name').innerText = catalog.name;
        document.getElementById('detail_qty').innerText = catalog.qty;
        document.getElementById('detail_photo').src = `<?= base_url('uploads/books/') ?>${catalog.book_photo}`;
        $('#viewDataCatalogDetailModal').modal('show');
    }
</script>
<?= $this->endSection() ?>