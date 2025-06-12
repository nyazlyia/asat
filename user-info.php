<?php
session_start();
include "lat_conn.php";

if (isset($_SESSION['no'])) {
    $user_id = $_SESSION['no'];
    $query = "SELECT nama FROM users WHERE no = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($nama);
    if ($stmt->fetch()) {
        echo "<strong>" . htmlspecialchars($nama) . "</strong>";
    } else {
        echo "<strong>User</strong>";
    }
    $stmt->close();
} else {
    echo "<strong>Guest</strong>"; 
}
?>