<?php
session_start();
require 'connect.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // ตรวจสอบข้อมูลให้ครบถ้วน
        if (empty($username) || empty($password)) {
            echo "❌ กรุณากรอกข้อมูลให้ครบถ้วน!";
            exit();
        }

        // ตรวจสอบชื่อผู้ใช้ในฐานข้อมูล
        $sql = "SELECT username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        // ถ้าพบผู้ใช้ในฐานข้อมูล
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($username_from_db, $hashed_password_from_db);
            $stmt->fetch();

            // ตรวจสอบรหัสผ่าน
            if (password_verify($password, $hashed_password_from_db)) {
                // เก็บข้อมูลผู้ใช้ใน session
                $_SESSION['username'] = $username_from_db;
                header("Location: ebook.php"); // เปลี่ยนเส้นทางไปยังหน้า ebook.html
                exit();
            } else {
                echo "❌ รหัสผ่านไม่ถูกต้อง!";
            }
        } else {
            echo "❌ ไม่พบผู้ใช้นี้ในฐานข้อมูล!";
        }
        $stmt->close();
    }
}

$conn->close();
?>
