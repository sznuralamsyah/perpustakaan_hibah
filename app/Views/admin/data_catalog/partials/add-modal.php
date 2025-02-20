<div class="modal fade" id="addDataCatalogModal" tabindex="-1" aria-labelledby="addDataCatalogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataCatalogModalLabel">Tambah Katalog Data Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/data_catalog/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Katalog</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="book_photo" class="form-label">Foto Buku</label>
                        <input type="file" class="form-control" id="book_photo" name="book_photo" required>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Kuantitas</label>
                        <input type="number" class="form-control" id="qty" name="qty" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>