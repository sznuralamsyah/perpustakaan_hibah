<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Daftar Donasi<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Daftar Donasi</h4>
                <div class="d-flex flex-column-reverse gap-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDonationModal">
                        Tambah Donasi Baru
                    </button>
                    <a href="<?= base_url('templates/SampleHibah.xlsx') ?>" class="btn btn-success">Download</a>
                    <form action="/user/donations/import" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="excel_file">Upload Excel File</label>
                            <input type="file" name="excel_file" id="excel_file" class="form-control" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Donatur</th>
                                <th>Instansi</th>
                                <th>Jumlah Donasi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($donations as $index => $donation) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($donation['name']) ?></td>
                                    <td><?= esc($donation['institution']) ?></td>
                                    <td><?= number_format($donation['quantity'], 0, ',', '.') ?></td>
                                    <td><?= esc(date('d F Y', strtotime($donation['created_at']))) ?></td>
                                    <td class="text-nowrap">
                                        <div class="dropdown dropup">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editDonationModal"
                                                        onclick="editDonation(<?= htmlspecialchars(json_encode($donation), ENT_QUOTES, 'UTF-8') ?>)">
                                                        Ubah
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewDonationModal"
                                                        onclick="viewDonation(<?= htmlspecialchars(json_encode($donation), ENT_QUOTES, 'UTF-8') ?>)">
                                                        Lihat Detail
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="<?= base_url('user/donations/destroy/' . $donation['id']) ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus donasi ini?')">
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

<div class="modal fade" id="addDonationModal" tabindex="-1" aria-labelledby="addDonationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDonationModalLabel">Tambah Donasi Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('user/donations/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Donatur</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institusi</label>
                        <input type="text" class="form-control" id="institution" name="institution" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="book_title" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" id="book_title" name="book_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="publisher" name="publisher" required>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <div class="mb-3">
                        <label for="publication_year" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="publication_year" name="publication_year" required>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn">
                    </div>
                    <div class="mb-3">
                        <label for="issn" class="form-label">ISSN</label>
                        <input type="text" class="form-control" id="issn" name="issn">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                    </div>
                    <div class="mb-3 d-none">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="pending">Pending</option>
                            <!-- <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option> -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="book_photo" class="form-label">Foto Buku</label>
                        <input type="file" class="form-control" id="book_photo" name="book_photo" accept="image/*">
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

<div class="modal fade" id="editDonationModal" tabindex="-1" aria-labelledby="editDonationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDonationModalLabel">Edit Donasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editDonationForm" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" id="edit_donation_id" name="id">

                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Donatur</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_institution" class="form-label">Institusi</label>
                        <input type="text" class="form-control" id="edit_institution" name="institution" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="edit_address" name="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_book_title" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" id="edit_book_title" name="book_title" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_publisher" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="edit_publisher" name="publisher" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_author" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="edit_author" name="author" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_publication_year" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="edit_publication_year" name="publication_year" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="edit_isbn" name="isbn">
                    </div>

                    <div class="mb-3">
                        <label for="edit_issn" class="form-label">ISSN</label>
                        <input type="text" class="form-control" id="edit_issn" name="issn">
                    </div>

                    <div class="mb-3">
                        <label for="edit_quantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="edit_quantity" name="quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_phone_number" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="edit_phone_number" name="phone_number" required>
                    </div>

                    <div class="mb-3 d-none">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="pending">Pending</option>
                            <!-- <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option> -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_book_photo" class="form-label">Foto Buku (Opsional)</label>
                        <input type="file" class="form-control" id="edit_book_photo" name="book_photo">
                        <img id="current_book_photo" src="" alt="Book Photo" class="img-thumbnail mt-2" width="100">
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

<div class="modal fade" id="viewDonationModal" tabindex="-1" aria-labelledby="viewDonationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDonationModalLabel">Detail Donasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="view_donation_id"></span></p>
                <p><strong>Nama:</strong> <span id="view_name"></span></p>
                <p><strong>Institusi:</strong> <span id="view_institution"></span></p>
                <p><strong>Alamat:</strong> <span id="view_address"></span></p>
                <p><strong>Judul Buku:</strong> <span id="view_book_title"></span></p>
                <p><strong>Penerbit:</strong> <span id="view_publisher"></span></p>
                <p><strong>Pengarang:</strong> <span id="view_author"></span></p>
                <p><strong>Tahun Terbit:</strong> <span id="view_publication_year"></span></p>
                <p><strong>ISBN:</strong> <span id="view_isbn"></span></p>
                <p><strong>ISSN:</strong> <span id="view_issn"></span></p>
                <p><strong>Jumlah:</strong> <span id="view_quantity"></span></p>
                <p><strong>Nomor Telepon:</strong> <span id="view_phone_number"></span></p>
                <p><strong>Status:</strong> <span id="view_status"></span></p>
                <p><strong>Foto Buku:</strong></p>
                <img id="view_book_photo" src="" alt="Book Photo" style="max-width: 100%; height: auto;">
                <span id="no_image_message" style="display: none; color: red;">Gambar tidak tersedia</span>
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
    function editDonation(donation) {
        document.getElementById('editDonationForm').action = `/user/donations/update/${donation.id}`;

        document.getElementById('edit_donation_id').value = donation.id;
        document.getElementById('edit_name').value = donation.name;
        document.getElementById('edit_institution').value = donation.institution;
        document.getElementById('edit_address').value = donation.address;
        document.getElementById('edit_book_title').value = donation.book_title;
        document.getElementById('edit_publisher').value = donation.publisher;
        document.getElementById('edit_author').value = donation.author;
        document.getElementById('edit_publication_year').value = donation.publication_year;
        document.getElementById('edit_isbn').value = donation.isbn;
        document.getElementById('edit_issn').value = donation.issn;
        document.getElementById('edit_quantity').value = donation.quantity;
        document.getElementById('edit_phone_number').value = donation.phone_number;
        document.getElementById('edit_status').value = donation.status;

        if (donation.book_photo) {
            document.getElementById('current_book_photo').src = `/uploads/books/${donation.book_photo}`;
        } else {
            document.getElementById('current_book_photo').src = '';
        }

        $('#editDonationModal').modal('show');
    }

    function viewDonation(donation) {
        document.getElementById('view_donation_id').textContent = donation.id;
        document.getElementById('view_name').textContent = donation.name;
        document.getElementById('view_institution').textContent = donation.institution;
        document.getElementById('view_address').textContent = donation.address;
        document.getElementById('view_book_title').textContent = donation.book_title;
        document.getElementById('view_publisher').textContent = donation.publisher;
        document.getElementById('view_author').textContent = donation.author;
        document.getElementById('view_publication_year').textContent = donation.publication_year;
        document.getElementById('view_isbn').textContent = donation.isbn ? donation.isbn : 'Data kosong';
        document.getElementById('view_issn').textContent = donation.issn ? donation.issn : 'Data kosong';
        document.getElementById('view_quantity').textContent = donation.quantity;
        document.getElementById('view_phone_number').textContent = donation.phone_number;
        document.getElementById('view_status').textContent = donation.status;

        if (donation.book_photo) {
            let imgElement = document.getElementById('view_book_photo');
            imgElement.src = `/uploads/books/${donation.book_photo}`;

            imgElement.onerror = function() {
                imgElement.src = '';
                document.getElementById('no_image_message').style.display = 'block';
                document.getElementById('no_image_message').textContent = 'Gambar tidak terbaca oleh database atau tidak ditemukan'; // Pesan error
            };

            document.getElementById('no_image_message').style.display = 'none';
        } else {
            document.getElementById('view_book_photo').src = '';
            document.getElementById('no_image_message').style.display = 'block';
            document.getElementById('no_image_message').textContent = 'Gambar tidak tersedia';
        }


        $('#viewDonationModal').modal('show');
    }
</script>
<?= $this->endSection() ?>