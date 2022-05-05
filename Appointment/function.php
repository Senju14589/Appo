<?php 
     include_once('date.php');


    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'appoin');
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    
    class DB_con {

        function __construct() {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $this->dbcon = $conn;
            
            
        }
        //หน้าเพิ่มข้อมูล
        public function insert($number, $date, $phonenumber, $cf_time, $nf_time, $ag_time, $total_time, $time_card, $patient_status) {
            $result = mysqli_query($this->dbcon, "INSERT INTO csadmin(number, date, phonenumber, nf_time, ag_time, total_time, time_card, patient_status) 
            VALUES('$number', '$date', '$phonenumber', '$cf_time', '$nf_time', '$ag_time','$total_time', '$time_card', ' $patient_status')");
            return $result;
        }
        
        public function fetchdata() {
            $result = mysqli_query($this->dbcon, "SELECT * FROM csadmin");
            return $result;
        }

        public function searchphonenumber($phone){
            $day1 = date('Y-m-d');
            $result2 = mysqli_query($this->dbcon, "UPDATE `csadmin` SET `total_time`='รับทราบแล้ว',`time_card`= now()
            WHERE `phonenumber`='$phone' AND date = '$day1' ");
            $result = mysqli_query($this->dbcon, "SELECT * FROM `csadmin` WHERE `phonenumber` LIKE '$phone' AND `nf_time` IS NOT NULL AND date = '$day1'");
            $row = mysqli_fetch_array($result);
            $t1 = $row['date'].' '.$row['nf_time'];
            $t2 = $row['date'].' '.$row['time_card'];
            $time=dateDiv($t1,$t2);
            $result3 = mysqli_query($this->dbcon, "UPDATE `csadmin` SET `patient_status`= '$time' WHERE `number`= '".$row['number']."' ");
            return $row["nf_time"];
              
        }

        public function fetchonerecord($number) {
            $result = mysqli_query($this->dbcon, "SELECT * FROM csadmin WHERE id = '$number'");
            return $result;
        }
        //อัพเดตข้อมูล
        public function update($number, $date, $phonenumber, $cf_time, $nf_time, $ag_time, $total_time, $time_card, $patient_status) {
            $result = mysqli_query($this->dbcon, "UPDATE csadmin SET 
                date = '$date',
                phonenumber = '$phonenumber',
                cf_time = '$cf_time',
                nf_time = '$nf_time',
                ag_time = '$ag_time',
                total_time = '$total_time'
                time_card = '$time_card'
                patient_status = '$patient_status'
                WHERE number = '$number'
            ");
            return $result;
        }
        public function abc($date,$phone,$ag_time,$cf_time,$total_time){
            $result = mysqli_query($this->dbcon, "INSERT INTO `csadmin`(`number`, `date`, `phonenumber`, `cf_time`, `ag_time`, `total_time`) 
            VALUES (null,'".$date."','".$phone."','".$ag_time."','".$cf_time."','".$total_time."')");
            return $result;
        }
        public function cis($number,$t2,$t1){
            $time=dateDiv($t1,$t2);
            $result = mysqli_query($this->dbcon, "UPDATE `csadmin` SET `nf_time`= '$t2',`ag_time`= '$time' WHERE number = '$number'");
            return $result;
        }
        
        public function delete($number) {
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM csadmin WHERE number = '$number'");
            return $deleterecord;
        }

        public function edit($number,$phonenumber,$total_time) {
            $result = mysqli_query($this->dbcon, "UPDATE csadmin set phonenumber='$phonenumber', total_time='$total_time' WHERE number='$number'");
            return $result;
        }
        
        /*$sql="INSERT INTO `csadmin`(`number`, `date`, `phonenumber`) 
            VALUES (null,'".$date."','".$_POST['phonenumber']."')";
            $dtt = mysqli_connect($db,$sql);*/
    }

?>