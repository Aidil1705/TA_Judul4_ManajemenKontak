<?php
session_start();

$id = $_GET['id'] ?? null;

if ($id === null || !isset($_SESSION['kontak_list'][$id])) {
    header("Location: index.php");
    exit;
}

$kontak = $_SESSION['kontak_list'][$id];

$error = $_SESSION['edit_error'] ?? '';
unset($_SESSION['edit_error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kontak</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #bfdbfe, #60a5fa);
            min-height: 100vh;
        }
        .border-primary-custom {
            border-color: #3b82f6 !important;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center py-5 px-3">

    <div class="card shadow-lg p-4 border-primary-custom" style="max-width: 500px; width:100%;">

        <h2 class="fw-bold text-primary text-center mb-3">Edit Kontak</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <form action="action.php" method="POST">

            <input type="hidden" name="aksi" value="update">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama:</label>
                <input type="text" name="nama" class="form-control border-primary-custom"
                       value="<?= htmlspecialchars($kontak['nama']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Telepon:</label>
                <input type="text" name="telepon" class="form-control border-primary-custom"
                       value="<?= htmlspecialchars($kontak['telepon']) ?>" required>
            </div>

            <button class="btn btn-primary w-100 fw-bold">Perbarui</button>

            <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>

        </form>

    </div>

</body>
</html>
