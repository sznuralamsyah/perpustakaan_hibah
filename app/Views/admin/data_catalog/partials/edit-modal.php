<div class="modal fade" id="editDataCatalogModal" tabindex="-1" aria-labelledby="editDataCatalogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataCatalogModalLabel">Ubah Katalog Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editDataCatalogForm" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Katalog</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_book_photo" class="form-label">Foto Buku</label>
                        <input type="file" class="form-control" id="edit_book_photo" name="book_photo">
                    </div>
                    <div class="mb-3">
                        <label for="edit_qty" class="form-label">Kuantitas</label>
                        <input type="number" class="form-control" id="edit_qty" name="qty" required>
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