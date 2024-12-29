<?php
    session_start();
    if (!$_SESSION['isLoggedIn']) 
    {
        header("location: login.php");
    }
    echo "Selamat Datang ",$_SESSION['username']," - ", $_SESSION['userid'];

        require_once 'connection.php';

        try {
            // Mengambil data dari tabel buku
            $dbh = $koneksi->query("SELECT * FROM buku WHERE isdel = 0");
        } catch (PDOException $e) {
            die("Gagal mengambil data: " . $e->getMessage());
        }
        ?>

        <table border="1">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tahun Terbit</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;
            while ($bukus = $dbh->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo htmlspecialchars($bukus['judul']); ?></td>
                    <td><?php echo htmlspecialchars($bukus['tahun']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo urlencode($bukus['id']); ?>">Edit</a> |
                        <a href="delete.php?id=<?php echo urlencode($bukus['id']); ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </table>

        <a href="logout.php">Log Out</a>
        <a href="input.php">Tambah Data</a>
