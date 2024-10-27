<?php
// MySQL configuration
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

// Check if delete request is made
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM tabelpenduduk_pgweb8 WHERE kecamatan = '$delete_id'";
    $conn->query($delete_sql);
    header("Location: index.php"); // Replace "index.php" with the actual filename if needed
    exit();
}

$sql = "SELECT * FROM tabelpenduduk_pgweb8";
$result = $conn->query($sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Data Table</title>
    <style>
        body {
            background-image: url('rainblury.jpeg'); /* Replace with your image path */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Ensures full viewport height */
            margin: 0;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Adds subtle shadow for depth */
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .delete-link {
            color: #FF5733;
            text-decoration: none;
        }
    </style>
</head>
<body>";

if ($result->num_rows > 0) {
    echo "<table>
    <tr>
        <th>Kecamatan</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Luas</th>
        <th>Jumlah Penduduk</th>
        <th>Action</th>
    </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["kecamatan"] . "</td>
        <td>" . $row["longitude"] . "</td>
        <td>" . $row["Latitude"] . "</td>
        <td>" . $row["luas"] . "</td>
        <td style='text-align: right;'>" . $row["jumlah_penduduk"] . "</td>
        <td><a href='?delete_id=" . $row["kecamatan"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\" class='delete-link'>Delete</a></td>
    </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center; color:white;'>0 results</p>";
}

$conn->close();

echo "</body>
</html>";
?>
