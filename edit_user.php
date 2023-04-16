<?php
if(isset($_REQUEST['edituser'])) {
	$idUser = (int)$_REQUEST['uid'];
	$tenUser = $_REQUEST['uname'];
    $emailUser = $_REQUEST['uemail'];
    $phoneUser = $_REQUEST['uphone'];
	$roleUser = $_REQUEST['urole'];

	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb21s6";


	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	//chưa có các đk kiểm tra đầu vào
    //chưa xử lý phần role
	$sql = sprintf("UPDATE `nguoidung` SET `Hoten` = '%s', `email` = '%s', `SoDienThoai` = '%s', `updated_at` = CURRENT_TIMESTAMP(), `role` = '%s'  WHERE `nguoidung`.`MaNguoiDung` = %d", $tenUser, $emailUser, $phoneUser, $roleUser, $idUser);
	if ($conn->query($sql) === TRUE) {
	  header("Location: admin_user.php");
	  exit();
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	mysqli_close($conn);
}