<?php
session_start();

$aksi = $_REQUEST['aksi'] ?? '';

function validasiTelepon($nomor) {
    $nomor = preg_replace('/[\s\-\+\(\)]/', '', $nomor);
    return preg_match('/^(0|\+62)[0-9]{9,12}$/', $nomor);
}

switch ($aksi) {

    // CREATE / TAMBAH
    case 'create':
        $nama    = trim($_POST['nama'] ?? '');
        $telepon = trim($_POST['telepon'] ?? '');

        if ($nama === '' || $telepon === '') {
            $_SESSION['error'] = "Semua field wajib diisi!";
        } elseif (strlen($nama) < 3) {
            $_SESSION['error'] = "Nama minimal 3 karakter!";
        } elseif (!validasiTelepon($telepon)) {
            $_SESSION['error'] = "Nomor telepon tidak valid!";
        } else {
            $_SESSION['kontak_list'][] = [
                'nama' => $nama,
                'telepon' => $telepon
            ];
        }

        header("Location: index.php");
        exit;


    // DELETE
    case 'delete':
        $id = $_GET['id'] ?? null;

        if ($id !== null && isset($_SESSION['kontak_list'][$id])) {
            unset($_SESSION['kontak_list'][$id]);
        }

        header("Location: index.php");
        exit;


    // UPDATE / EDIT
    case 'update':
        $id      = intval($_POST['id']);
        $nama    = trim($_POST['nama']);
        $telepon = trim($_POST['telepon']);

        if ($nama === '' || $telepon === '') {
            $_SESSION['edit_error'] = "Nama dan telepon wajib diisi!";
            header("Location: edit.php?id=$id");
            exit;
        } elseif (strlen($nama) < 3) {
            $_SESSION['edit_error'] = "Nama minimal 3 karakter!";
            header("Location: edit.php?id=$id");
            exit;
        } elseif (!validasiTelepon($telepon)) {
            $_SESSION['edit_error'] = "Format nomor telepon tidak valid!";
            header("Location: edit.php?id=$id");
            exit;
        }

        if (isset($_SESSION['kontak_list'][$id])) {
            $_SESSION['kontak_list'][$id] = [
                'nama' => $nama,
                'telepon' => $telepon
            ];
        }

        header("Location: index.php");
        exit;

    default:
        header("Location: index.php");
        exit;
}
?>
