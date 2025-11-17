<?php
session_start();

if (!isset($_SESSION['kontak_list'])) {
    $_SESSION['kontak_list'] = [];
}

$daftar_kontak = array_values($_SESSION['kontak_list']);

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kontak</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #bfdbfe, #60a5fa);
            min-height: 100vh;
        }
        .border-primary-custom {
            border-color: #3b82f6 !important;
        }
        .text-primary-custom {
            color: #1d4ed8 !important;
        }
    </style>
</head>

<body class="d-flex justify-content-center py-5 px-3">

    <div class="container" style="max-width: 800px;">

        <h1 class="text-center fw-bold text-primary-custom mb-4 shadow">
            Manajemen Kontak
        </h1>

        <?php if ($error): ?>
            <div class="alert alert-danger shadow-sm">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <!-- Form Tambah Kontak -->
        <div class="card shadow-lg border-primary-custom mb-4">
            <div class="card-body">
                <h2 class="h5 fw-bold text-primary-custom mb-3">Tambah Kontak</h2>

                <form action="action.php" method="POST">
                    <input type="hidden" name="aksi" value="create">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">👤</span>
                            <input 
                                type="text" 
                                name="nama"
                                class="form-control border-primary-custom"
                                placeholder="Masukkan nama"
                                required
                            >
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Telepon:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">📞</span>
                            <input 
                                type="text" 
                                name="telepon"
                                class="form-control border-primary-custom"
                                placeholder="Contoh: 08123456789"
                                required
                            >
                        </div>
                    </div>

                    <button 
                        type="submit"
                        class="btn btn-primary w-100 fw-bold shadow-sm"
                    >
                        Tambah Kontak
                    </button>
                </form>
            </div>
        </div>

        <!-- Daftar Kontak -->
        <div class="card shadow-lg border-primary-custom">
            <div class="card-body">
                <h2 class="h5 fw-bold text-primary-custom mb-3">Daftar Kontak</h2>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (empty($daftar_kontak)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted fst-italic">
                                        Belum ada data kontak.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($daftar_kontak as $id => $kontak): ?>
                                    <tr>
                                        <td><?= $id + 1; ?></td>
                                        <td><?= htmlspecialchars($kontak['nama']); ?></td>
                                        <td><?= htmlspecialchars($kontak['telepon']); ?></td>
                                        <td>
                                            <a href="edit.php?id=<?= $id; ?>" 
                                               class="btn btn-warning btn-sm fw-bold text-dark">
                                                Edit
                                            </a>

                                            <a href="action.php?aksi=delete&id=<?= $id; ?>"
                                               onclick="return confirm('Yakin ingin menghapus kontak ini?');"
                                               class="btn btn-danger btn-sm fw-bold">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
