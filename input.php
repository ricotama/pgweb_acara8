<?php
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$Latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];
// Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb8";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO tabelpenduduk_pgweb8 (kecamatan, longitude, Latitude, luas, jumlah_penduduk)
VALUES ('$kecamatan', $longitude, $Latitude, $luas, $jumlah_penduduk)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
//header("Location: index.html");
//exit;
