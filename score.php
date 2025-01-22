<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Calculate</title>
</head>
<body>
    <center>
        <h1>ผลลัพธ์จากการคำนวณเกรด</h1>

        <?php
            if (isset($_POST['submit'])) 
            {
                $filename = $_POST['filename']; // รับชื่อไฟล์จากฟอร์ม
                if (file_exists($filename)) {
                    $text = file($filename); // อ่านไฟล์

                    // สร้างตาราง
                    echo '<table>';
                    echo '<tr><th>นักศึกษา</th><th>ทดสอบย่อย</th><th>สอบกลางภาค</th><th>สอบปลายภาค</th><th>รวม 100 คะแนน</th><th>เกรด</th></tr>';

                    foreach ($text as $line) 
                    {
                        $data = explode(",", $line); // แยกข้อมูลจากคอมม่า
                        if (count($data) == 4) 
                        {
                            $name = trim($data[0]);
                            $quiz = trim($data[1]);
                            $midterm = trim($data[2]);
                            $final = trim($data[3]);

                            // คำนวณคะแนนรวม
                            $total_score = $quiz + $midterm + $final;

                            // คำนวณเกรด
                            if ($total_score >= 80)
                                $grade = 'A';
                            elseif ($total_score >= 65)
                                $grade = 'B';
                            elseif ($total_score >= 50)
                                $grade = 'C';
                            elseif ($total_score >= 35)
                                $grade = 'D';
                            else 
                                $grade = 'F';


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
            } 
            else 
            {
                ?>
                    <!-- ฟอร์มกรอกชื่อไฟล์ -->
                    <form method="post">
                        <input class="input-name" type="text" name="filename" placeholder="Enter filename" required>
                        <input type="submit" name="submit" value="SUBMIT">
                    </form>
                <?php 
            } 
        ?>
    </center>
</body>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    
    * {
        font-family: "Kanit", serif;
    }

    table {
        width: 90%; /* ขนาดตารางที่เล็กลง */
        border-collapse: collapse;
        margin-top: 30px;
    }

    th, td {
        border: 0;
        text-align: center;
        font-size: 20px;

    }

    .input-name {
        width: 300px;
    }
</style>
</html>