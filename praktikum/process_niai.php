<?php
$conn = new mysqli("localhost", "root", "", "web_project");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $matkul = $_POST['matkul'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];
    $nilai_tugas = $_POST['nilai_tugas'];

    $nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);
    $kelulusan = $nilai_akhir > 55 ? 'Lulus' : 'Tidak Lulus';
    $grade = ($nilai_akhir >= 85) ? 'A' : (($nilai_akhir >= 70) ? 'B' : (($nilai_akhir >= 56) ? 'C' : (($nilai_akhir >= 36) ? 'D' : 'E')));

    $stmt = $conn->prepare("INSERT INTO siswa (nama, matkul, nilai_uts, nilai_uas, nilai_tugas, nilai_akhir, kelulusan, grade) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiisss", $nama, $matkul, $nilai_uts, $nilai_uas, $nilai_tugas, $nilai_akhir, $kelulusan, $grade);
    $stmt->execute();
    header("Location: index.html#arrayData");
}
?>
