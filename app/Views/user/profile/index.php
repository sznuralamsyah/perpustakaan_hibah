<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Profile<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    
    <div class="card">
        <div class="card-body">
            <h1>Profil Pengguna</h1>
            <?php if (isset($user) && !empty($user)): ?>
                <p><strong>Nama:</strong> <?= esc($user['username']) ?></p>
                <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
            <?php else: ?>
                <p>Data pengguna tidak ditemukan. Pastikan Anda sudah login.</p>
            <?php endif; ?>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profil</button>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('/user/profile/update') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= esc($user['username']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>