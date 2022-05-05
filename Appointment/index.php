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
    $deletedata = new DB_con();

    if (isset($_POST['insert'])  && $_GET['id']=="insert") {
        $date= date('Y-m-d');
        $phone = $_POST['phonenumber'];
        $ag_time = date("H:i:s");
        $cf_time = date("H:i:s");
        $total_time = date("ยังไม่รับทราบ");


        $sql = $updatedata->abc($date,$phone,$ag_time,$cf_time,$total_time);
        if ($sql) {
            echo "<script>alert('ข้อมูลบันทึกสำเร็จ!');</script>";
            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('มีบางอย่างผิดพลาด กรุณาลองใหม่');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
            
    }
    if (isset($_POST['update'])  && $_GET['id']=="update") {
        $number = $_POST['number'];
        $t2 = $_POST['date'].' '.date('H:i:s');
        $t1 = $_POST['date'].' '.$_POST['cf_time'];
        //$t1="2022-05-02 13:20:00";
        $nf_time = date('H:i:s');


        $sql = $updatedata->cis($number,$t2,$t1);
        if ($sql) {
            echo "<script>alert('ข้อมูลบันทึกสำเร็จ!');</script>";
            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('มีบางอย่างผิดพลาด กรุณาลองใหม่');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
            
    }
    if (isset($_GET['del'])) {
        $number = $_GET['del'];
        $deletedata = new DB_con();
        $sql = $deletedata->delete($number);

        if ($sql) {
            echo "<script>alert('ลบข้อมูลสำเร็จ');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }

     

?>

<body>
    <div class="center">
        <div class="card">
            <img src="image/oop2.jpg" />
        </div>
        <div class="card mb-3">
            <h1 class="mt-5">
                <div style="text-align:center;width:100%;" class="ps">
                    ระบบเรียกรับบัตรนัดหมาย
                </div>
            </h1>
            <h3 class="mt-5">
                <div style="text-align:center;width:100%;" class="ps">
                    Appointement Calling System
                </div>
            </h3>
            <?php {
        ?>

            <form action="index.php?id=insert" method="post">
                <div class="text-center mb-3">
                    <label for="phonenumber" class="ps">ระบุหมายเลขโทรศัพท์ของผู้มาติดต่อ</label>
                    <input type="number" name="phonenumber" id="phone1" required>


                    <?php } ?>
                    <button type="submit" name="insert" class="btn btn-success mb-3">ตกลง</button>
            </form>

            <table id="mytable" class="table table-bordered table-striped">
                <thead>
                    <th>ลำดับที่</th>
                    <th>วันที่</th>
                    <th>หมายเลขโทรศัพท์</th>
                    <th>เวลาที่ผู้มาติดต่อยื่น</th>
                    <th>เวลาที่ออกบัตรนัด</th>
                    <th>รวมระยะเวลาที่ใช้ในการออกบัตร</th>
                    <th>สถานะการรับทราบของผู้มาติดต่อ</th>
                    <th>เวลาที่คนไข้รับทราบ</th>
                    <th>รวมระยะเวลาในการรับทราบ</th>
                    <th>เปลี่ยนสถานะ</th>
                    <th>ลบ</th>
                </thead>

                <tbody>
                    <?php 

      
                $fetchdata = new DB_con();
                $sql = $fetchdata->fetchdata();
                while($row = mysqli_fetch_array($sql)) {

            ?>

                    <tr>
                        <td><?php echo $row['number']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['phonenumber']; ?></td>
                        <td><?php echo $row['cf_time']; ?> นาที</td>

                        <td><?php if ($row['nf_time']!= NULL){
                    echo $row['nf_time'];
                }
                else{ ?>
                            <form action="index.php?id=update" method="post">
                                <input type="hidden" name="number" value="<?php echo $row['number']; ?>">
                                <input type="hidden" name="cf_time" value="<?php echo $row['cf_time']; ?>">
                                <input type="hidden" name="date" value="<?php echo $row['date']; ?>">
                                <button type="submit" name="update"
                                    class="btn btn-success">คลิ๊กเพื่อออกบัตรนัด</button>
                            </form>
                            <?php }?> นาที
                        </td>

                        <td><?php $se = explode(":",$row['ag_time']);
                    echo $se[1].":".$se[2]; ?> นาที</td>
                        <td><?php echo $row['total_time']; ?></td>
                        <td><?php echo $row['time_card']; ?></td>
                        <td><?php echo $row['patient_status']; ?> นาที</td>
                        <td><a href="edit.php?id=<?php echo $row['number']; ?>" class="btn btn-primary">เปลี่ยนสถานะ</a>
                        <td><a href="index.php?del=<?php echo $row['number']; ?>" class="btn btn-danger"
                                onclick="Del(this.href);return false;">ลบ</a>
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

<script language="JavaScript">
function Del(mypage) {
    var agree = confirm("คุณต้องการลบข้อมูลนี้หรือไม่");
    if (agree) {
        window.location = mypage;
    }

}
</script>