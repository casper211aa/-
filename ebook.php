<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก | ยืม/คืน หนังสือออนไลน์</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* พื้นหลัง */
        .background {
            position: relative;
            overflow: hidden;
            height: 100vh;
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* เพิ่มวิดีโอพื้นหลัง */
        .background video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* ให้วิดีโอเติมเต็มพื้นที่ */
            z-index: -1; /* ทำให้วิดีโออยู่ด้านหลังเนื้อหา */
        }

        /* กล่องเนื้อหา */
        .content {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 1200px;
            position: relative; /* ทำให้เนื้อหานี้อยู่ข้างหน้า */
            z-index: 1; /* ให้เนื้อหานี้อยู่ด้านหน้า */
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        /* ป๊อปอัพ */
        #popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 2; /* ให้ป๊อปอัพอยู่ข้างหน้าทุกอย่าง */
        }

        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
        }

        .popup-content input {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .popup-content button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            width: 100%;
            margin-bottom: 10px; /* ให้ปุ่มยืนยันมีช่องว่างด้านล่าง */
        }

        /* ปุ่มปิด */
        .close-btn {
            padding: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
        }

        .close-btn:hover {
            background-color: #e53935; /* เปลี่ยนสีเมื่อ hover */
        }

        /* สไตล์รายการหนังสือ */
        .book-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));  /* กำหนดให้แสดงเป็น Grid */
            gap: 20px;
            list-style-type: none;
            padding: 0;
        }

        .book-list li {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .book-list li:hover {
            transform: scale(1.05);  /* ขยายเล็กน้อยเมื่อ hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);  /* เพิ่มเงาเมื่อ hover */
        }

        .book-list img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 5px; /* เพิ่มมุมโค้งให้กับภาพ */
        }

        .book-list .book-title {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- พื้นหลัง -->
    <div class="background">
        <!-- วิดีโอพื้นหลัง -->
        <video autoplay loop muted>
            <source src="images/10.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="content">
            <h1>หนังสือที่มีให้ยืม</h1>

            <!-- แสดงรายชื่อหนังสือ -->
            <ul class="book-list">
                <li onclick="openPopup('Python สำหรับผู้เริ่มต้น')">
                    <img src="images/6.jpg" alt="Python สำหรับผู้เริ่มต้น">
                    <div class="book-title">Python สำหรับผู้เริ่มต้น</div>
                </li>
                <li onclick="openPopup('การพัฒนาเว็บไซต์ด้วย HTML และ CSS')">
                    <img src="images/7.jpg" alt="การพัฒนาเว็บไซต์ด้วย HTML และ CSS">
                    <div class="book-title">การพัฒนาเว็บไซต์ด้วย HTML และ CSS</div>
                </li>
                <li onclick="openPopup('พื้นฐานการเขียนโปรแกรมใน Java')">
                    <img src="images/8.jpg" alt="พื้นฐานการเขียนโปรแกรมใน Java">
                    <div class="book-title">พื้นฐานการเขียนโปรแกรมใน Java</div>
                </li>
                <li onclick="openPopup('เรียนรู้ JavaScript จากศูนย์')">
                    <img src="images/9.jpg" alt="เรียนรู้ JavaScript จากศูนย์">
                    <div class="book-title">เรียนรู้ JavaScript จากศูนย์</div>
                </li>
                <li onclick="openPopup('การวิเคราะห์ข้อมูลด้วย Excel')">
                    <img src="images/100.jpg" alt="การวิเคราะห์ข้อมูลด้วย Excel">
                    <div class="book-title">การวิเคราะห์ข้อมูลด้วย Excel</div>
                </li>
            </ul>
        </div>
    </div>

    <!-- ป๊อปอัพ -->
    <div id="popup" style="display: none;">
        <div class="popup-content">
            <h3>ยืม/คืน หนังสือ</h3>
            <form id="borrow-form">
                <input type="text" id="username" placeholder="ชื่อผู้ยืม" required><br>
                <input type="date" id="borrow_date" placeholder="วันที่ยืม" required><br>
                <input type="date" id="return_date" placeholder="วันที่คืน" required><br>
                <button type="submit">ยืนยันการยืม/คืน</button>
            </form>
            <button class="close-btn" onclick="closePopup()">ปิด</button> <!-- ปุ่มปิดที่แยกออกมา -->
        </div>
    </div>

    <script>
        // ฟังก์ชันเปิดป๊อปอัพ
        function openPopup(bookTitle) {
            document.getElementById('popup').style.display = 'flex';
            document.getElementById('borrow-form').onsubmit = function(event) {
                event.preventDefault();
                submitForm(bookTitle);
            }
        }

        // ฟังก์ชันปิดป๊อปอัพ
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        // ฟังก์ชันส่งข้อมูล
        function submitForm(bookTitle) {
            const username = document.getElementById('username').value;
            const borrowDate = document.getElementById('borrow_date').value;
            const returnDate = document.getElementById('return_date').value;

            // ส่งข้อมูลไปยัง PHP ผ่าน AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'borrow_return.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert('ยืมหนังสือสำเร็จ: ' + bookTitle);
                    closePopup(); // ปิดป๊อปอัพ
                }
            };

            // ส่งข้อมูลเป็น string ในรูปแบบ URL encoded
            const data = 'username=' + encodeURIComponent(username) + 
                         '&book=' + encodeURIComponent(bookTitle) + 
                         '&borrow_date=' + encodeURIComponent(borrowDate) + 
                         '&return_date=' + encodeURIComponent(returnDate);

            xhr.send(data);
        }
    </script>

</body>
</html>
