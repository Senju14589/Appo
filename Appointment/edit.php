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


    $updatedata = new DB_con();

    if (isset($_POST['update'])) {
        $phonenumber = $_GET['phonenumber'];
        $total_time = $_GET['total_time'];
        if($total_time == "รองาน") $color="#FF6600"; // สีส้ม
        echo "<font color=\"red\">ยังไม่รับทราบ</font>";

        //query ข้อมูลจากตาราง: 
        $sql = "SELECT * FROM csadmin WHERE number = '$number' ";
        $result = mysqli_query($db, $sql) or die ("Error in query: $sql " . mysqli_error($conn). "<br>$sql");
        $row = mysqli_fetch_array($result);
        extract($row);
    }      
?>

<body>
    <div class="card">
        <img src="image/oop2.jpg" />
    </div>
    <div class="container">
        <h1 class="mt-5">
            <div style="text-align:center;width:100%;" class="ps">
                เปลี่ยนสถานะข้อมูล
            </div>
        </h1>
        <?php
        {
        ?>
        <form action="update.php?id=insert" method="post">
            <div class="text-mb-3">
                <label for="phonenumber" class="ps">หมายเลขโทรศัพท์ของผู้ป่วย:</label>
                <input type="text" name="phonenumber" class="form-control" required>
                <br>
                <div class="input-group mb-3">
                    <select class="form-select" name="total_time">
                        <option selected>สถานะของคนไข้</option>
                        <option value="รับทราบแล้ว">รับทราบแล้ว</option>
                        <option value="ยังไม่รับทราบ">ยังไม่รับทราบ</option>
                    </select>
                </div>
                <?php } ?>
        </form>

        <tbody>
            <?php 
 {

            ?>

            <tr>
                <td><input type="submit" class="btn btn-primary" name="Update" id="Update" value="เปลี่ยนสถานะข้อมูล" />
                </td>
                <a href="index.php" class="btn btn-danger">ยกเลิก</a>
                </td>
                </td>
            </tr>

            <?php 

                }
            ?>
        </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
</script>
</body>

</html>