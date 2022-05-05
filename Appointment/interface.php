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
    <style>
    .ps {
        font-family: 'Prompt', sans-serif;
    }

    button {
        font-family: 'Prompt', sans-serif;
    }
    </style>
    <div class="container" align="center">
        <div class="card bg-light mb-3">
            <img src="image/oop2.jpg">
            <div class="container">
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


                <form action="interface.php?id=ค้นหา" action="index.php?id=update" method="post">
                    <div class="mb-3" align="center">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="phonenumber"
                                    placeholder="กรุณากรอกเบอร์โทรศัพท์ของท่าน">
                            </div>
                            <?php  ?>
                            <input type="hidden" name="number" value="<?php echo $row['number']; ?>">
                            <input type="hidden" name="time_card" value="<?php echo $row['time_crad']; ?>">
                            <input type="hidden" name="date" value="<?php echo $row['date']; ?>">
                            <button type="submit" name="search" name="update" class="btn btn-success">ตกลง</button>
                        </div>
                    </div>
                </form>

                <?php 
        
        include_once('function.php');

        $updatedata = new DB_con();
    
        if (isset($_POST['search'])  && $_GET['id']=="ค้นหา") {
            $phone = $_POST['phonenumber'];
    
    
            $sql = $updatedata->searchphonenumber($phone);
            if ($sql != 0) {
                echo "<br>ผู้ป่วยเบอร์โทรศัพท์หมายเลข : ".$phone."<br>ท่านได้รับบัตรนัดแล้วเมื่อเวลา ".$sql." กรุณาติดต่อเจ้าหน้าที่";
            } else {
                echo "<br>ยังไม่ได้รับบัตรนัดหมาย กรุณารอซักครู่";
            }
                
        }


        ?>
                </tbody>
                </table>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
                integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
                crossorigin="anonymous">
            </script>
            </body>

            </html>