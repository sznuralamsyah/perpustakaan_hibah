<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Perpustakaan' ?></title>

    <link rel="shortcut icon" href="<?= base_url('assets/compiled/svg/favicon.svg') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoSuQmCC" type="image/png">

    <link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable-jquery.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/iconly.css') ?>">

    <?= $this->renderSection('header-styles') ?>
</head>

<body>
    <script src="<?= base_url('assets/static/js/initTheme.js') ?>"></script>
    <div id="app">
        <div id="sidebar">
            <?= $this->include('layouts/sidebar') ?>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="container mt-4">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </div>

            <?= $this->include('layouts/footer') ?>
        </div>
    </div>

    <script src="<?= base_url('assets/extensions/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/extensions/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') ?>"></script>
    <script src="<?= base_url('assets/static/js/pages/datatables.js') ?>"></script>
    <script src="<?= base_url('assets/static/js/components/dark.js') ?>"></script>
    <script src="<?= base_url('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/compiled/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/extensions/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/static/js/pages/dashboard.js') ?>"></script>
    <script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
    <script src="<?= base_url('assets/static/js/pages/simple-datatables.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah kamu yakin mau hapus data ini?')) {
                document.getElementById('deleteForm' + id).submit();
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "order": [
                    [0, "asc"]
                ],
                "lengthMenu": [5, 10, 50, 100]
            });
        });
    </script>
</body>

</html>