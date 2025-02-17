<?php
// เชื่อมต่อกับฐานข้อมูล MySQL
$servername = "localhost"; // ชื่อโฮสต์
$username = "root";        // ชื่อผู้ใช้ฐานข้อมูล
$password = "";            // รหัสผ่านฐานข้อมูล
$dbname = "library";       // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$username = $_POST['username'];
$book = $_POST['book'];
$borrow_date = $_POST['borrow_date'];
$return_date = $_POST['return_date'];
$status = 'ยืม'; // กำหนดสถานะเป็น 'ยืม' สำหรับการยืม

// คำสั่ง SQL สำหรับการบันทึกข้อมูลลงในฐานข้อมูล
$sql = "INSERT INTO borrow_return (username, book, borrow_date, return_date, status, created_at) 
        VALUES ('$username', '$book', '$borrow_date', '$return_date', '$status', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "บันทึกข้อมูลสำเร็จ";
} else {
    echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
