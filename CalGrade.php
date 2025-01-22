<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Calculate</title>
    <style>
        table {
            width: 90%; /* ขนาดตารางที่เล็กลง */
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            border: 1px solid black;
            text-align: center;
        }

        

      
    </style>
</head>
<body>
    <center>
        <h1>ผลลัพธ์จากการคำนวณเกรด</h1>

        <?php
        if (isset($_POST['submit'])) {
            $filename = $_POST['filename']; // รับชื่อไฟล์จากฟอร์ม
            if (file_exists($filename)) {
                $text = file($filename); // อ่านไฟล์

                // สร้างตาราง
                echo '<table>';
                echo '<tr><th>นักศึกษา</th><th>ทดสอบย่อย</th><th>สอบกลางภาค</th><th>สอบปลายภาค</th><th>รวม 100 คะแนน</th><th>เกรด</th></tr>';

                foreach ($text as $line) {
                    $data = explode(",", $line); // แยกข้อมูลจากคอมม่า
                    if (count($data) == 4) {
                        $name = trim($data[0]);
                        $quiz = trim($data[1]);
                        $midterm = trim($data[2]);
                        $final = trim($data[3]);

                        // คำนวณคะแนนรวม
                        $total_score = $quiz + $midterm + $final;

                        // คำนวณเกรด
                        if ($total_score >= 80) {
                            $grade = 'A';
                        } elseif ($total_score >= 65) {
                            $grade = 'B';
                        } elseif ($total_score >= 50) {
                            $grade = 'C';
                        } elseif ($total_score >= 35) {
                            $grade = 'D';
                        } else {
                            $grade = 'F';
                        }

                        // แสดงข้อมูลในตาราง
                        echo "<tr>
                                <td>$name</td>
                                <td>$quiz</td>
                                <td>$midterm</td>
                                <td>$final</td>
                                <td>$total_score</td>
                                <td>$grade</td>
                              </tr>";
                    }
                }

                echo '</table>'; // ปิดตาราง
            } else {
                echo '<p>ไฟล์ไม่พบหรือไม่สามารถอ่านได้</p>';
            }
        } else {
        ?>
            <!-- ฟอร์มกรอกชื่อไฟล์ -->
            <form method="post">
                <input type="text" name="filename" placeholder="Enter CSV filename" required>
                <input type="submit" name="submit" value="SUBMIT">
            </form>
        <?php } ?>
    </center>
</body>
</html>