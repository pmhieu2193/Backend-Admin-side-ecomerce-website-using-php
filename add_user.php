<?php
if(isset($_REQUEST['adduser'])) {

	$accountUser = $_REQUEST['uaccount'];
	$tenUser = $_REQUEST['uname'];
    $emailUser = $_REQUEST['uemail'];
    $phoneUser = $_REQUEST['uphone'];
    $addressUser = $_REQUEST['uaddress'];
    $roleUser = $_REQUEST['urole'];
    $passUser = $_REQUEST['upass'];

	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb21s6";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	//can lam them 1 hàm kiểm tra tên tài khoản hoặc tên người dùng đã được hiển thị chưa
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	//chưa có các đk kiểm tra đầu vào
  //xử lý các vấn đề tương tự với edit_user
	$sql = sprintf("INSERT INTO `nguoidung` (`Hoten`,`TenDangNhap`, `MatKhau`, `email`, `SoDienThoai`, `DiaChi`,`role`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s','%s')", $tenUser, $accountUser, $passUser, $emailUser, $phoneUser, $addressUser, $roleUser);
	if ($conn->query($sql) === TRUE) {
	  echo "The record editted successfully";
	  header("Location: admin_user.php");
	  exit();
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

	mysqli_close($conn);
}