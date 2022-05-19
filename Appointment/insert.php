<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหารับบัตรนัดหมาย</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
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

<body class="container">
    <div class="container">
        <h1 class="mt-5">ค้นหาบัตรนัดหมาย</h1>
        <a href="index.php" class="btn btn-success">ย้อนกลับ</a>
        <hr>

        <body>
            <form method="get" action="">
                ค้นหาจากวันที่<br>
                <div class="input-group mb-3">
                    <input type="date" name="mydate">
                </div>
                <span>ถึงวันที่</span>
                <div class="input-group mb-3">
                    <input type="date" name="mydate">
                </div>
                </td><button type="submit" class="btn btn-primary">ค้นหา</button>
            </form>
        </body>
        <hr>
        <table id="example" class="table table-bordered table-striped">
            <thead>
                <th>ลำดับที่</th>
                <th>เวลาที่ผู้มาติดต่อยื่น</th>
                <th>หมายเลขโทรศัพท์</th>
                <th>เวลาที่ออกบัตรนัด</th>
                <th>รวมระยะเวลาที่ใช้ในการออกบัตร</th>
                <th>สถานะการรับทราบของผู้มาติดต่อ</th>
                <th>เวลาที่คนไข้รับทราบ</th>
                <th>รวมระยะเวลาในการรับทราบ</th>
            </thead>

            <tbody>
                <?php

                include_once('includes/function.php');
                $fetchdata = new DB_con();
                $sql = $fetchdata->fetchdata();
                while ($row = mysqli_fetch_array($sql)) {

                ?>

                    <tr>
                        <td><?php echo $row['number']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['phonenumber']; ?></td>
                        <td><?php echo $row['nf_time']; ?></td>
                        <td><?php echo $row['ag_time']; ?></td>
                        <td><?php echo $row['total_time']; ?></td>
                        <td><?php echo $row['time_card']; ?> นาที</td>
                        <td><?php echo $row['patient_status']; ?> นาที</td>
                    </tr>

                <?php

                }

                ?>
            </tbody>
        </table>
    </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.jqueryui.min.js"></script>
<script type="text/javascript">
    $('#example').DataTable();
</script>

</body>

</html>