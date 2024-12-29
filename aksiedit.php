<?php
include "connection.php";

session_start();
if (!$_SESSION['isLoggedIn']) {
    header("Location: login.php");
    exit();
}

$id = $_POST['id'];
$judul = $_POST['judul'];
$tahun = $_POST['tahun'];

try {
    $stmt = $koneksi -> prepare ("UPDATE buku SET judul = ?, tahun = ?, updated_by = ?, updated_at = ? WHERE id = ?");
        $result = $stmt->execute([
            $judul,
            $tahun,
            $_SESSION['userid'],
            date("Y-m-d H:i:s"),
            $id
        ]);


    if ($result) {
        echo "Data berhasil diperbarui!";
    } else {
        print_r($dbh->errorInfo());
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

header("Location: home.php");
exit();
?>