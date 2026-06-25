<?php

include '../koneksi.php';
$query = "SELECT * FROM tb_login";
$result = mysqli_query($koneksi, $query);
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>";
    echo "<button data-id='" . $row['user_id'] . "' class='btn btn-sm btn-warning' id='btnEdit'>Edit</button> ";
    echo "<button data-id='" . $row['user_id'] . "' class='btn btn-sm btn-danger' id='btnHapus'>Hapus</button>";
    echo "</td>";
    echo "</tr>";
}