<?php
    include "connection.php";
    session_start();

    if(isset($_SESSION['isLoggedIn']))
    {
    if ($_SESSION['isLoggedIn']) 
    {
        header("location: home.php");
    }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $judul = isset($_POST['judul']) ? trim($_POST['judul']) : null;
        $tahun = isset($_POST['tahun']) ? trim($_POST['tahun']) : null;
    
        if (empty($judul) || empty($tahun)) {
            die("Judul dan Tahun tidak boleh kosong!");
        }
    
        try {
            $dbh = $koneksi->prepare("INSERT INTO buku (judul, tahun, created_by, create_at) VALUES (?,?,?,?)");
            $dbh->execute([
                $judul,
                $tahun,
                $_SESSION['userid'],
                date("Y-m-d H:i:s")
            ]);

            header("Location: home.php");
            exit();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    ?>