<?php
include_once('includes/function.php');

//ตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
if (isset($_POST['show_number'])) {

  $edit_user = $process->get_user($_POST['show_number']);

  echo '<form id="edit_user_form">
          <div class="form-group">
            <label >ชื่อ - สกุล</label>
            <input type="text" class="form-control" name="edit_name" value="' . $edit_user['phonenumber'] . '">
          </div>
          <div class="form-group">
            <label >เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" name="edit_tel" value="' . $edit_user['total_time'] . '">
          </div>
          <input type="hidden" name="edit_user_id" value="' . $edit_user['id'] . '" >
        </form>';
}
