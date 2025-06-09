<?php
$conn = new mysqli("localhost", "root", "", "web_project");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $skills = implode(", ", $_POST['skill']);
    $total_skor = 0;
    foreach ($_POST['skill'] as $skill) {
        $total_skor += $skill === "HTML" ? 10 : ($skill === "CSS" ? 10 : ($skill === "JavaScript" ? 20 : 30));
    }
    $kategori = ($total_skor > 100) ? 'Sangat Baik' : (($total_skor > 60) ? 'Baik' : (($total_skor > 40) ? 'Cukup' : 'Kurang'));

    $stmt = $conn->prepare("INSERT INTO registrasi (nim, nama, prodi, skill, skor_skill, kategori) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $nim, $nama, $prodi, $skills, $total_skor, $kategori);
    $stmt->execute();
    header("Location: index.html");
}
?>
