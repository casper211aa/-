<?php
session_start();
require 'connect.php';  // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        // ตรวจสอบข้อมูลให้ครบถ้วน
        if (empty($username) || empty($password) || empty($confirm_password)) {
            echo "❌ กรุณากรอกข้อมูลให้ครบถ้วน!";
            exit();
        }

        // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
        if ($password !== $confirm_password) {
            echo "❌ รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน!";
            exit();
        }

        // ตรวจสอบชื่อผู้ใช้ในฐานข้อมูล
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            echo "❌ Error in SQL query: " . $conn->error;  // เพิ่มการแสดงข้อผิดพลาดจาก SQL
            exit();
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        // ถ้าพบชื่อผู้ใช้นี้ในฐานข้อมูล
        if ($stmt->num_rows > 0) {
            echo "❌ ชื่อผู้ใช้นี้มีผู้ใช้งานแล้ว!";
        } else {
            // แฮชรหัสผ่าน
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // เพิ่มข้อมูลผู้ใช้ใหม่ลงในฐานข้อมูล
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                echo "❌ Error in SQL query: " . $conn->error;  // เพิ่มการแสดงข้อผิดพลาดจาก SQL
                exit();
            }

            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                echo "✅ สมัครสมาชิกสำเร็จ! กรุณาเข้าสู่ระบบ.";
                header("Location: login.html");
            } else {
                echo "❌ เกิดข้อผิดพลาด! ไม่สามารถสมัครสมาชิกได้.";
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>
