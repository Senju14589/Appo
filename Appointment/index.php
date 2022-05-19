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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.jqueryui.min.css">
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
date_default_timezone_set("Asia/Bangkok");
include_once('includes/function.php');

$updatedata = new DB_con();
$deletedata = new DB_con();

if (isset($_POST['insert'])  && $_GET['id'] == "insert") {
    $date = date('Y-m-d');
    $phone = $_POST['phonenumber'];
    $ag_time = date("H:i:s");
    $cf_time = date("H:i:s");

    $total_time = date("ยังไม่รับทราบ");



    $sql = $updatedata->abc($date, $phone, $ag_time, $cf_time, $total_time);
    if ($sql) {
        echo "<script>alert('ข้อมูลบันทึกสำเร็จ!');</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('มีบางอย่างผิดพลาด กรุณาลองใหม่');</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}
if (isset($_POST['update'])  && $_GET['id'] == "update") {
    $number = $_POST['number'];
    $t2 = $_POST['date'] . ' ' . date('H:i:s');
    $t1 = $_POST['date'] . ' ' . $_POST['cf_time'];
    //$t1="2022-05-02 13:20:00";
    $nf_time = date('H:i:s');


    $sql = $updatedata->cis($number, $t2, $t1);
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

if (isset($_POST['action']) && $_POST['action'] == "exampleModal") {
    $_error_msg = null;
    $_success_msg = null;
    // อัพเดทข้อมูลโดยอ้างอิงจาก primary ในที่นี้ส่ง number 
    if (isset($_POST['number']) && $_POST['number'] != "") {
        $sql = "
            UPDATE tbl_members SET 
            phonenumber='" . $_POST['phonenumber'] . "',
            total_time='" . $_POST['total_time'] . "',
            WHERE number=" . $_POST['number'] . "		
            ";
        $result = $mysqli->query($sql);
        if ($result) {
            if ($mysqli->affected_rows > 0) {
                $_success_msg = "Change user data successful!";
            } else {
                $_success_msg = "Update user successful!";
            }
        } else {
            $_error_msg = "Eror, please try again!";
        }
    }
    $json_data[] = array(
        "success" => $_success_msg,
        "error" => $_error_msg
    );
    // จะได้ตัวแปร $json_data  สำหรับสร้างเป็น json data					
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

                    <label for="phonenumber" class="ps">ระบุหมายเลขโทรศัพท์ของผู้มาติดต่อ </label>
                    <input type="number" name="phonenumber" id="phone1" maxlength="10" min="1" max="9999999999"
                        oninput="this.value.length<this.maxLength?this.min=Math.pow(10, this.value.length):this.min=0"
                        onkeypress="return (this.value.length>=this.maxLength)?false:true" required>
                    <?php } ?>
                    <button type="submit" name="insert" class="btn btn-success mb-3">ตกลง</button>
            </form>

            <div align="right" class="container">
                <a href="insert.php" class="btn btn-warning">ค้นหาบัตรนัดหมาย</a>
            </div>
            <hr>


            <table id="example" class="table table-bordered table-striped mt-3">
                <thead>
                    <th>ลำดับที่</th>
                    <th>วัน,เวลาที่ผู้มาติดต่อยื่น</th>
                    <th>หมายเลขโทรศัพท์</th>
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
                        while ($row = mysqli_fetch_array($sql)) {

                        ?>

                    <tr>
                        <td><?php echo $row['number']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['phonenumber']; ?></td>

                        <td><?php if ($row['nf_time'] != NULL) {
                                        echo $row['nf_time'];
                                    } else { ?>
                            <form action="index.php?id=update" method="post">
                                <input type="hidden" name="number" value="<?php echo $row['number']; ?>">
                                <input type="hidden" name="cf_time" value="<?php echo $row['cf_time']; ?>">
                                <input type="hidden" name="date" value="<?php echo $row['date']; ?>">
                                <button type="submit" name="update"
                                    class="btn btn-success">คลิ๊กเพื่อออกบัตรนัด</button>
                            </form>
                            <?php } ?>
                        </td>

                        <td><?php $se = explode(":", $row['ag_time']);
                                    echo $se[0] . ":" . $se[1];
                                    ":" . $se[2]; ?> นาที</td>
                        <td><?php echo $row['total_time']; ?></td>
                        <td><?php echo $row['time_card']; ?></td>
                        <td><?php echo $row['patient_status']; ?> นาที</td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                เปลี่ยนสถานะ
                            </button></td>
                        <td><a href="index.php?del=<?php echo $row['number']; ?>" class="btn btn-danger"
                                onclick="Del(this.href);return false;">ลบ</a>
                        </td>
                    </tr>

                    <?php
                        }
                        ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
</body>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนสถานะ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="update.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="text-mb-3">
                                <form action="post" id="insert_form">
                                    <label for="phonenumber" class="ps">
                                        หมายเลขโทรศัพท์ของผู้ป่วย:</label>
                                    <input type="text" name="phonenumber" class="form-control"
                                        value="<?php echo $row['phonenumber']; ?> " required>
                                </form>
                                <br>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="total_time">
                                        <option selected>สถานะของคนไข้</option>
                                        <option value="รับทราบแล้ว">รับทราบแล้ว</option>
                                        <option value="ยังไม่รับทราบ">ยังไม่รับทราบ</option>
                                    </select>
                                </div>
                                </br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="return edit_user_form();">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.jqueryui.min.js"></script>
<script type="text/javascript">
$('#example').DataTable();
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