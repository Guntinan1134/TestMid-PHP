<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ตรวจสอบเกรด</h1>
    <form method="post" action="">
        <label for="name">ชื่อ:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="score">คะแนน:</label>
        <input type="number" id="score" name="score" required>
        <br><br>
        <button type="submit">submit:</button>
    </form>

    <hr>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = htmlspecialchars($_POST["name"]);
        $score = $_POST["score"];

        if (is_numeric($score) && $score >= 0 && $score <= 100){
            if ($score >= 80) {
                $grade = "A";}
            elseif ($score >= 70){
                $grade = "B";}
            elseif ($score >= 60){
                $grade = "C";}  
            elseif ($score >= 50){
                $grade = "D";}
            else{
                $grade = "F";

            }
            echo "<p>ชื่อ $name </p>";
            echo "<p>คะแนน $score </p>";
            echo "<p>เกรด $grade </p>";
            } else{
                echo "กรอกคะแนนให้ถูกต้อง (0-100)";
            }
            }
        
    
    ?>

    
</body>
</html>