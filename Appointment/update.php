<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบเรียกรับบัตรนัดหมาย</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<style>
.ps {
    font-family: 'Prompt', sans-serif;
}

button,
table {
    font-family: 'Prompt', sans-serif;
}
</style>
<?php
   include_once('function.php');

   //ตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
   $number = $_POST['number'];
   $phonenumber = $_POST['phonenumber'];
   $total_time = $_POST['total_time'];
   
   //ปรับปรุงข้อมูลที่จะแก้ไขลงใน database 
   $sql = "UPDATE csadmin SET  
            phonenumber='$phonenumber' ,
            total_time='$total_time'  
            WHERE number='$number'";

   $result = mysqli_query($db, $sql) or die ("Error in query: $sql " . mysqli_error($conn). "<br>$sql");
    mysqli_close($db); ////ปิดการเชื่อมต่อ database 

    if($result){
    echo "<script type='text/javascript'>";
    echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว!!');";
    echo "window.location = 'index.php'; ";
    echo "</script>";
    }
    else{
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาดในการอัปเดตv');";
        echo "window.location = 'index.php'; ";
    echo "</script>";
}
?>




</body>

</html>