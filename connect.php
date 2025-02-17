<?php
$host = 'localhost';  // เซิร์ฟเวอร์ฐานข้อมูล
$username = 'root';   // ชื่อผู้ใช้ฐานข้อมูล
$password = '';       // รหัสผ่านฐานข้อมูล
$dbname = 'library';  // ชื่อฐานข้อมูลที่สร้างขึ้น

// สร้างการเชื่อมต่อ
$conn = new mysqli($host, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
