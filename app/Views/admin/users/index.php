<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Daftar Pengguna<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Daftar Pengguna</h4>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    Tambah Pengguna Baru
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $index => $user) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= esc($user['role_name']) ?></td>
                                    <td class="text-nowrap">
                                        <div class="dropdown dropup">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="viewUserDetail(<?= htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8') ?>)">
                                                        Lihat Detail
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal"
                                                        onclick="editUser(<?= htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8') ?>)">
                                                        Ubah
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="<?= base_url('admin/users/delete/' . $user['id']) ?>"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
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

<?= $this->include('admin/users/partials/add-modal') ?>

<?= $this->include('admin/users/partials/edit-modal') ?>

<div class="modal fade" id="viewUserDetailModal" tabindex="-1" aria-labelledby="viewUserDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserDetailModalLabel">Detail Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama:</strong> <span id="detail_name"></span></p>
                <p><strong>Email:</strong> <span id="detail_email"></span></p>
                <p><strong>Role:</strong> <span id="detail_role"></span></p>
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
    function editUser(user) {
        // document.getElementById('editUserForm').action = `/add-users/update/${user.id}`;
        document.getElementById('editUserForm').action = `/admin/users/update/${user.id}`;
        document.getElementById('edit_user_id').value = user.id;
        document.getElementById('edit_name').value = user.username;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role_id').value = user.role_id;
        $('#editUserModal').modal('show');
    }

    function viewUserDetail(user) {
        document.getElementById('detail_name').innerText = user.username;
        document.getElementById('detail_email').innerText = user.email;
        document.getElementById('detail_role').innerText = user.role_name;
        $('#viewUserDetailModal').modal('show');
    }
</script>
<?= $this->endSection() ?>